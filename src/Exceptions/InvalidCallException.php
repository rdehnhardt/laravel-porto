<?php

namespace Porto\Exceptions;

use Exception;

class InvalidCallException extends Exception
{
    /**
     * @var int
     */
    protected $code = 500;

    /**
     * @var string
     */
    protected $message = 'There is a problem in your call.';
}