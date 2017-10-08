<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Organ;
use App\Models\Institution;
use App\Http\Controllers\Controller;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Organ $organ)
    {
        return $organ->institutions()->orderBy('name')->get();
    }
}
