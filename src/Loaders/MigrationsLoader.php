<?php

namespace Skeleton\Loaders;

use File;

trait MigrationsLoader
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
        $this->loadMigrations("{$this->directory}/Data/Migrations");
    }

    /**
     * @param $directory
     */
    protected function loadMigrations($directory)
    {
        if (File::isDirectory($directory)) {
            $this->loadMigrationsFrom($directory);
        }
    }
}