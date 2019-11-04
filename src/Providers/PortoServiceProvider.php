<?php

namespace Porto\Providers;

use Illuminate\Support\Facades\Schema;
use Porto\Abstracts\Providers\MainServiceProvider;
use Porto\Foundation\Porto;
use Spatie\Fractal\FractalFacade;
use Spatie\Fractal\FractalServiceProvider;

class PortoServiceProvider extends MainServiceProvider
{
    /**
     * Register Service Providers
     *
     * @var array
     */
    public $providers = [
        FractalServiceProvider::class,
    ];

    /**
     * Register Aliases
     *
     * @var  array
     */
    protected $aliases = [
        'Fractal' => FractalFacade::class,
    ];

    /**
     * Provider Boot
     */
    public function boot()
    {
        // load all service providers defined in this class
        parent::boot();

        // Solves the "specified key was too long" error, introduced in L5.4
        Schema::defaultStringLength(191);
    }

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
