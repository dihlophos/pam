<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Preparation;
use App\Models\Disease;
use App\Http\Controllers\Controller;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Preparation $preparation)
    {
        return $preparation->diseases()->orderBy('name')->get();
    }

    public function show(Preparation $preparation, Disease $disease)
    {
        return $disease;
    }
}
