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
        $this->mergeConfigFrom(__DIR__ . '/../../config/porto.php', 'porto');

        $this->app->alias(Porto::class, 'Porto');

        parent::register();
    }
}
