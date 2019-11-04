<?php

namespace Porto\Abstracts\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Prettus\Repository\Criteria\RequestCriteria;
use Ship\Data\Criterias\KeyValueCriteria;

abstract class Action
{
    /**
     * @var Collection
     */
    protected $criterias;

    /**
     * @return Collection
     */
    protected function getCriterias()
    {
        return $this->criterias;
    }

    /**
     * @param array $criterias
     */
    public function setCriterias(array $criterias = [])
    {
        $this->criterias = collect();

        foreach ($criterias as $criteria => $parameter) {
            $method = $this->parseCriteria($criteria);

            if (method_exists($this, $method)) {
                $this->criterias->push($this->{$method}($parameter));
            }

            $this->criterias->push(new KeyValueCriteria($criteria, $parameter));
        }
    }

    /**
     * @param Request $request
     */
    public function useRequestCriteria(Request $request)
    {
        if (!$this->criterias instanceof Collection) {
            $this->criterias = collect();
        }

        $this->criterias->push(new RequestCriteria($request));
    }

    /**
     * @param $criteria
     * @return string
     */
    private function parseCriteria($criteria)
    {
        return "{$criteria}Criteria";
    }
}