<?php

namespace Porto\Abstracts\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Porto\Traits\CallableTrait;

abstract class WebController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, CallableTrait;
}