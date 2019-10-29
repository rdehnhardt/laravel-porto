<?php

namespace Porto\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

trait CallableTrait
{
    public function call($class, $arguments = [])
    {
        $class = $this->resolveClass($class);

        return $class->handle(...array_values($arguments));
    }

    public function transactionalCall($class, $arguments = [])
    {
        return DB::transaction(function () use ($class, $arguments) {
            return $this->call($class, $arguments);
        });
    }

    private function resolveClass($class)
    {
        return App::make($class);
    }
}
