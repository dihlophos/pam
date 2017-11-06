<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Subdivision;
use App\Models\Object;
use App\Http\Controllers\Controller;

class ObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Subdivision $subdivision)
    {
        return $subdivision->objects()->orderBy('name')->get();
    }
}
