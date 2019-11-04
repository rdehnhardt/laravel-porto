<?php

namespace Porto\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait CallableTrait
{
    /**
     * @var array
     */
    protected $beforeMethods = [];

    /**
     * @param $class
     * @param array $arguments
     * @return mixed
     */
    public function call($class, $arguments = [])
    {
        $arguments = $this->parseArguments($arguments);

        $class = App::make($class);
        $this->callBeforeMethods($class);

        return $class->handle(...$arguments);
    }

    /**
     * @param $class
     * @param array $arguments
     * @return mixed
     */
    public function transactionalCall($class, $arguments = [])
    {
        return DB::transaction(function () use ($class, $arguments) {
            return $this->call($class, $arguments);
        });
    }

    /**
     * @param $class
     */
    private function callBeforeMethods($class)
    {
        foreach ($this->beforeMethods as $method => $arguments) {
            $class->{$method}(...$arguments);
        }

        $this->resetBeforeMethods();
    }

    /**
     * @param $method
     * @param $arguments
     * @return $this
     */
    public function __call($method, $arguments)
    {
        $this->beforeMethods[$method] = $arguments;

        return $this;
    }

    /**
     * Reset before methods
     */
    private function resetBeforeMethods()
    {
        $this->beforeMethods = [];
    }

    /**
     * @param $arguments
     * @return array
     */
    private function parseArguments($arguments): array
    {
        $arguments = is_array($arguments) ? $arguments : [$arguments];
        $arguments = $this->isAssociativeArray($arguments) ? array_values($arguments) : $arguments;

        return $arguments;
    }

    private function isAssociativeArray($array)
    {
        if (!is_array($array) || [] === $array) {
            return false;
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }
}
