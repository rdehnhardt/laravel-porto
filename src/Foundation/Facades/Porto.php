<?php

namespace Porto\Foundation\Facades;

use Illuminate\Support\Facades\Facade;

class Porto extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Porto';
    }
}
