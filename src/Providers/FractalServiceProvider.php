<?php

namespace Porto\Providers;

use Spatie\Fractal\FractalServiceProvider as BaseServiceProvider;
use League\Fractal\Serializer\DataArraySerializer;

class FractalServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->bind(DataArraySerializer::class, function ($app) {
            return new config('porto.default_serializer');
        });

        parent::boot();
    }
}