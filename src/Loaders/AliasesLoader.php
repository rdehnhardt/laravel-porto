<?php

namespace Porto\Loaders;

use Illuminate\Foundation\AliasLoader;

trait AliasesLoader
{
    /**
     * Register alias.
     *
     * @var  array
     */
    protected $aliases = [];

    /**
     * @void
     */
    protected function loadContainerAliases()
    {
        foreach ($this->aliases as $alias => $class) {
            $this->loadAlias($alias, $class);
        }
    }

    /**
     * @param $alias
     * @param $class
     */
    protected function loadAlias($alias, $class)
    {
        AliasLoader::getInstance()->alias($alias, $class);
    }
}
