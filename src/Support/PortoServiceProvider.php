<?php

namespace Porto\Support;

use Illuminate\Support\ServiceProvider;
use Porto\Loaders\AutoLoader;

class PortoServiceProvider extends ServiceProvider
{
    use AutoLoader;

    /**
     * Service boot
     */
    public function boot()
    {
        $this->autoload();
    }

    /**
     * @param $name
     * @param $directory
     * @param $namespace
     */
    public function container($name, $directory, $namespace)
    {
        $this->name = $name;
        $this->directory = $directory;
        $this->namespace = $namespace;
    }
}
