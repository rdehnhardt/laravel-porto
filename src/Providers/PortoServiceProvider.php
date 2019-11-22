<?php

namespace Porto\Providers;

use Porto\Abstracts\Providers\MainServiceProvider;
use Porto\Foundation\Porto;
use Vinkla\Hashids\Facades\Hashids;
use OwenIt\Auditing\AuditingServiceProvider;

class PortoServiceProvider extends MainServiceProvider
{
    /**
     * Register providers.
     *
     * @var  array
     */
    protected $providers = [
        AuditingServiceProvider::class,
    ];

    /**
     * Register alias.
     *
     * @var  array
     */
    protected $aliases = [
        'Hashids' => Hashids::class,
    ];

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
