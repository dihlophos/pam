<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Subdivision;
use App\Models\Institution;
use App\Http\Controllers\Controller;

class SubdivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Institution $institution)
    {
        return $institution->subdivisions()->orderBy('name')->get();
    }
}
