<?php

namespace Porto\Providers;

use Illuminate\Support\ServiceProvider;
use Porto\Foundation\Porto;

class PortoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->app->alias(Porto::class, 'Porto');
    }
}
