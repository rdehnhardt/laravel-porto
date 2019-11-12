<?php

namespace Porto\Abstracts\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\CriteriaInterface;
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
    protected function getCriterias(): Collection
    {
        if (!$this->criterias instanceof Collection) {
            $this->criterias = collect();
        }

        return $this->criterias;
    }

    /**
     * @param CriteriaInterface $criteria
     * @return void
     */
    public function addCriteria(CriteriaInterface $criteria): void
    {
        $this->getCriterias()->push($criteria);
    }

    /**
     * @param array $criterias
     * @return void
     */
    public function setCriterias(array $criterias = []): void
    {
        foreach ($criterias as $criteria => $parameter) {
            $method = $this->parseCriteria($criteria);

            if (!method_exists($this, $method)) {
                $this->getCriterias()->push(new KeyValueCriteria($criteria, $parameter));
            } else {
                $this->getCriterias()->push($this->{$method}($parameter));
            }
        }
    }

    /**
     * Set Request Criteria
     * @return void
     */
    public function useRequestCriteria(): void
    {
        $this->getCriterias()->push(app(RequestCriteria::class));
    }

    /**
     * @param $criteria
     * @return string
     */
    private function parseCriteria($criteria): string
    {
        return "{$criteria}Criteria";
    }
}