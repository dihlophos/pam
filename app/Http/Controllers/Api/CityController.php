<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Municipality;
use App\Models\City;
use App\Http\Requests\StoreCity;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Municipality $municipality)
    {
        return $municipality->cities()->orderBy('name')->get();
    }

    public function show(Municipality $municipality, City $city)
    {
        return $city;
    }
}
