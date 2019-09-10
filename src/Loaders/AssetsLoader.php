<?php

namespace Porto\Loaders;

trait AssetsLoader
{
    /**
     * @var string|null
     */
    protected $name = null;

    /**
     * @var string|null
     */
    protected $directory = null;

    /**
     * @var array
     */
    protected $assets = [];

    /**
     * Set assets files
     */
    protected function loadContainerAssets()
    {
        $this->loadAssetsToPublish("{$this->directory}/Resources/Assets", $this->name);
    }

    /**
     * @param $directory
     * @param $name
     */
    protected function loadAssetsToPublish($directory, $name)
    {
        foreach ($this->assets as $source => $destination) {
            $this->publishes([$directory . $source => public_path($destination)], $name);
        }
    }
}