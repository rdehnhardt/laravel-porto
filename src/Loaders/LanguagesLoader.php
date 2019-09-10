<?php

namespace Skeleton\Loaders;

use File;

trait LanguagesLoader
{
    /**
     * @var string|null
     */
    protected $directory = null;

    /**
     * @var string|null
     */
    protected $name = null;

    /**
     * @return void
     */
    protected function loadContainerLanguages()
    {
        $this->loadLanguages("{$this->directory}/Resources/Languages", strtolower($this->name));
    }

    /**
     * @param $directory
     * @param $name
     * @return void
     */
    protected function loadLanguages($directory, $name)
    {
        if (File::isDirectory($directory)) {
            $this->loadTranslationsFrom($directory, strtolower($name));
        }
    }
}