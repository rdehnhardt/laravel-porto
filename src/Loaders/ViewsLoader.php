<?php

namespace Skeleton\Loaders;

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
     * @var string
     */
    protected $views = '/Ui/Web/Views';

    /**
     * Load view from container path
     */
    protected function loadContainerViews()
    {
        $this->loadViewsFrom($this->directory . $this->views, $this->name);
    }
}