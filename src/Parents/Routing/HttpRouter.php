<?php

namespace Porto\Parents\Routing;

use Illuminate\Contracts\Routing\Registrar as Router;

abstract class HttpRouter
{
    /**
     * @param Router $router
     * @return mixed
     */
    abstract public function map(Router $router);

    /**
     * Container Breadcrumbs
     */
    public function breadcrumbs()
    {
    }
}
