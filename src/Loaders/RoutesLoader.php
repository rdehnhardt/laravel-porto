<?php

namespace Porto\Loaders;

use File;
use Illuminate\Console\Application as Artisan;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;
use Porto\Foundation\Facades\Porto;

trait RoutesLoader
{
    /**
     * @var string|null
     */
    protected $name = null;

    /**
     * @var string|null
     */
    protected $prefix = true;

    /**
     * @var string|null
     */
    protected $directory = null;

    /**
     * @var string|null
     */
    protected $namespace = null;

    /**
     * @var boolean
     */
    protected $private = false;


    /**
     * @return void
     */
    protected function loadContainerRoutes()
    {
        $this->loadHttpRoutes("{$this->directory}/Ui/Api/Routes", "{$this->namespace}\\Ui\\Api\\Controllers", 'api');
        $this->loadHttpRoutes("{$this->directory}/Ui/Web/Routes", "{$this->namespace}\\Ui\\Web\\Controllers", 'web');
        $this->loadConsoleRoutes("{$this->directory}/Ui/Cli/Routes");
    }

    /**
     * @param $directory
     * @param $namespace
     * @param $middleware
     * @return void
     */
    private function loadHttpRoutes($directory, $namespace, $middleware)
    {
        if (File::isDirectory($directory)) {
            $middleware = $this->private ? "auth:$middleware" : $middleware;

            Route::group(['namespace' => $namespace, 'middleware' => $middleware, 'as' => $this->getContainerName(), 'prefix' => $this->getContainerPrefix()], function (Registrar $router) use ($directory) {
                $files = File::allFiles($directory);

                foreach ($files as $file) {
                    $classFromFile = Porto::getClassFromFile($file);
                    $this->app->make($classFromFile)->map($router);
                }
            });
        }
    }

    /**
     * @param $directory
     * @return void
     */
    private function loadConsoleRoutes($directory)
    {
        if (File::isDirectory($directory)) {
            $files = File::allFiles($directory);

            foreach ($files as $file) {
                $router = $this->app->make(Porto::getClassFromFile($file));

                Artisan::starting(function ($artisan) use ($router) {
                    $router->map($artisan);
                });

                $this->app->booted(function () use ($router) {
                    $router->schedule($this->app->make(Schedule::class));
                });
            }
        }
    }

    /**
     * @return string
     */
    private function getContainerName()
    {
        if ($this->prefix) {
            return "{$this->name}::";
        }

        return '';
    }

    /**
     * @return string
     */
    private function getContainerPrefix()
    {
        if ($this->prefix) {
            return $this->name;
        }

        return '';
    }
}
