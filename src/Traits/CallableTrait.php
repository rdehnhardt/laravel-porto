<?php

namespace Porto\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

trait CallableTrait
{
    /**
     * @param $class
     * @param array $arguments
     * @return mixed
     */
    public function call($class, $arguments = [])
    {
        $class = $this->resolveClass($class);

        return $class->handle(...array_values($arguments));
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
     * @return mixed
     */
    private function resolveClass($class)
    {
        return App::make($class);
    }
}
