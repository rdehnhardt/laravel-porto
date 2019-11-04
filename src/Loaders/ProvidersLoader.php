<?php

namespace Porto\Loaders;

use Illuminate\Support\Facades\App;

trait ProvidersLoader
{
    /**
     * Register providers.
     *
     * @var  array
     */
    protected $providers = [];

    /**
     * @param $providerFullName
     */
    private function loadProvider($providerFullName)
    {
        App::register($providerFullName);
    }

    /**
     * Load the all the registered Service Providers on the Main Service Provider.
     *
     * @void
     */
    public function loadServiceProviders()
    {
        foreach ($this->providers as $provider) {
            $this->loadProvider($provider);
        }
    }
}