<?php

namespace Porto\Providers;

use Porto\Abstracts\Providers\MainServiceProvider;
use Porto\Foundation\Porto;

class PortoServiceProvider extends MainServiceProvider
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
