<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Agesex;
use App\Models\AnimalType;
use App\Http\Controllers\Controller;

class AgesexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AnimalType $animal_type)
    {
        $agesexes = Agesex::orderBy('name');
        //selecting anymal_type specific agesex groups and all nonspecific
        $agesexes->whereRaw('agesexes.id IN (SELECT agesex_id FROM agesex_animal_type WHERE animal_type_id ='.$animal_type->id.')
                             OR NOT EXISTS (SELECT * FROM agesex_animal_type WHERE agesex_id = agesexes.id)');
        return $agesexes->get();
    }

    public function show(AnimalType $animal_type, Agesex $agesex)
    {
        return $agesex;
    }
}
