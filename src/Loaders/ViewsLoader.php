<?php

namespace Porto\Loaders;

trait ViewsLoader
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
     * Load view from container path
     */
    protected function loadContainerViews()
    {
        $this->loadViewsFrom("{$this->directory}/Ui/Web/Views", $this->name);
    }
}