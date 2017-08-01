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
    public function index(Request $request)
    {
        $animal_type_id = intval($request->animal_type_id);
        $preparation_id = intval($request->preparation_id);
        $service_id     = intval($request->service_id);
        $diseases = Disease::orderBy('name');
        if ($animal_type_id) {
            $diseases->whereRaw('diseases.id IN (SELECT disease_id FROM animal_type_disease WHERE animal_type_id ='.$animal_type_id.')');
        }
        if ($preparation_id) {
            $diseases->whereRaw('diseases.id IN (SELECT disease_id FROM disease_preparation WHERE preparation_id ='.$preparation_id.')');
        }
        if ($service_id) {
            $diseases->whereRaw('diseases.id IN (SELECT disease_id FROM disease_service WHERE service_id ='.$service_id.')');
        }
        return $diseases->get();
    }

    public function show(Disease $disease)
    {
        return $disease;
    }
}
