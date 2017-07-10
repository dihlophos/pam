<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Preparation;
use App\Models\ApplicationMethod;
use App\Http\Controllers\Controller;

class ApplicationMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Preparation $preparation)
    {
        return $preparation->applicationMethods()->orderBy('name')->get();
    }

    public function show(Preparation $preparation, ApplicationMethod $method)
    {
        return $method;
    }
}
