<?php

namespace Skeleton\Loaders;

use File;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factory;

trait FactoriesLoader
{
    /**
     * @var string|null
     */
    protected $directory = null;

    /**
     * @return void
     */
    protected function loadContainerMigrations()
    {
        $this->loadFactories("{$this->directory}/Data/Factories");
    }

    /**
     * @param $directory
     */
    protected function loadFactories($directory)
    {
        if (File::isDirectory($directory)) {
            $this->app->singleton(Factory::class, function ($app) use ($directory) {
                return Factory::construct($this->app->make(Generator::class), $directory);
            });
        }
    }
}