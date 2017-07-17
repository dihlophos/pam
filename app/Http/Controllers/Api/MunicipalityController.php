<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Municipality;
use App\Models\Subdivision;
use App\Http\Controllers\Controller;

class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Subdivision $subdivision)
    {
        return $subdivision->municipalities()->orderBy('name')->get();
    }

    public function show(Subdivision $subdivision, Municipality $municipality)
    {
        return $municipality;
    }
}
