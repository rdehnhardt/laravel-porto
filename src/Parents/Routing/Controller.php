<?php

namespace Porto\Parents\Routing;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as LaravelController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends LaravelController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
