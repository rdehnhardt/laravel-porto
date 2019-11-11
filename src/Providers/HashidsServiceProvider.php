<?php

namespace Porto\Providers;

use Porto\Traits\HashIdTrait;
use Vinkla\Hashids\HashidsServiceProvider as BaseServiceProvider;

class HashidsServiceProvider extends BaseServiceProvider
{
    use HashIdTrait;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        $this->routeHashedIdsDecoder();
    }
}