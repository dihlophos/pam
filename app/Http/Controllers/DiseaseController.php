<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\AnimalType;
use App\Models\DiseaseType;
use App\Models\Service;
use App\Http\Requests\StoreDisease;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diseases = Disease::with(['diseaseType', 'animalTypes', 'services'])->orderBy('name')->paginate(50);
        $animal_types = AnimalType::orderBy('name')->pluck('name', 'id');
        $disease_types = DiseaseType::orderBy('name')->pluck('name', 'id');
        return view(
                    'lists.diseases.index',
                    compact([ 'diseases', 'disease_types', 'animal_types'])
                );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDisease $request)
    {
        $disease = Disease::create($request->all());
        $disease->animalTypes()->attach($request->animal_types);
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('disease.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease)
    {
        $disease->load('diseaseType','animalTypes', 'services');
        $animal_types = AnimalType::orderBy('name')->pluck('name', 'id');
        $disease_types = DiseaseType::orderBy('name')->pluck('name', 'id');
        $services = Service::pluck('name', 'id');
        return view(
                    'lists.diseases.edit',
                    compact([ 'disease', 'disease_types', 'animal_types', 'services'])
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDisease $request, Disease $disease)
    {
        $disease->fill($request->all())->save();
        $disease->animalTypes()->sync($request->animal_types);
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('disease.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Disease $disease)
    {
        $disease->animalTypes()->detach();
        $disease->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('disease.index');
    }

    public function add_service($id, Request $request)
    {
        $disease = Disease::find($id);
        $disease->services()->attach($request->service_id, array('year_multiplicity' => $request->year_multiplicity));
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('disease.edit', $id);
    }

    public function destroy_service($id, $service_id, Request $request)
    {
        $disease = Disease::find($id);
        $disease->services()->detach($service_id);
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('disease.edit', $id);
    }
}
