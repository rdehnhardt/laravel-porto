<?php

namespace Porto\Providers;

use Illuminate\Support\ServiceProvider;
use Porto\Foundation\Porto;
use Porto\Loaders\AliasesLoader;

class PortoServiceProvider extends ServiceProvider
{
    use AliasesLoader;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Porto::class, function () {
            return new Porto();
        });

        $this->loadAlias('Porto', \Porto\Foundation\Facades\Porto::class);
    }
}