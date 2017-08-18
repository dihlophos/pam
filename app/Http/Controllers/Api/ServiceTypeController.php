<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ServiceType;
use App\Models\Service;
use App\Http\Requests\StoreService;
use App\Http\Controllers\Controller;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Service $service, Request $request)
    {
    	$service_types = $service->service_types; 
        return $service_types;
    }
}
