<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Organ;
use App\Http\Controllers\Controller;

class OrganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organs = Organ::orderBy('name');
        return $organs->get();
    }
}
