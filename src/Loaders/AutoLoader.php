<?php

namespace Porto\Loaders;

trait AutoLoader
{
    use AliasesLoader;
    use AssetsLoader;
    use ConfigsLoader;
    use LanguagesLoader;
    use MigrationsLoader;
    use RoutesLoader;
    use ViewsLoader;

    /**
     * @return void
     */
    public function autoload()
    {
        $this->loadContainerAliases();
        $this->loadContainerAssets();
        $this->loadContainerConfigs();
        $this->loadContainerLanguages();
        $this->loadContainerMigrations();
        $this->loadContainerRoutes();
        $this->loadContainerViews();
    }
}