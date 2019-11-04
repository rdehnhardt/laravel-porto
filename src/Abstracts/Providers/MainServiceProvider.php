<?php

namespace Porto\Abstracts\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Porto\Loaders\AliasesLoader;
use Porto\Loaders\ProvidersLoader;

abstract class MainServiceProvider extends ServiceProvider
{
    use ProvidersLoader;
    use AliasesLoader;

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->loadServiceProviders();
        $this->loadContainerAliases();
    }

    /**
     * Register anything in the container.
     */
    public function register()
    {
    }
}