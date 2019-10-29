<?php

namespace Porto\Parents\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;

abstract class Exception extends SymfonyHttpException
{
}
