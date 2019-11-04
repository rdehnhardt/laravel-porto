<?php

namespace Porto\Abstracts\Repositories;

use Prettus\Repository\Contracts\CacheableInterface as PrettusCacheable;
use Prettus\Repository\Criteria\RequestCriteria as PrettusRequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository as PrettusRepository;
use Prettus\Repository\Traits\CacheableRepository as PrettusCacheableRepository;

abstract class Repository extends PrettusRepository implements PrettusCacheable
{
    use PrettusCacheableRepository;

    /**
     * Set to 0 to disable
     */
    protected $maxPaginationLimit = 0;

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(PrettusRequestCriteria::class));
    }

    /**
     * @param null $limit
     * @param array $columns
     * @param string $method
     *
     * @return  mixed
     */
    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {
        $limit = $limit ?: Request::get('limit');

        if ($limit == "0") {
            return parent::all($columns);
        }


        if (is_int($this->maxPaginationLimit) && $this->maxPaginationLimit > 0 && $limit > $this->maxPaginationLimit) {
            $limit = $this->maxPaginationLimit;
        }

        return parent::paginate($limit, $columns, $method);
    }
}