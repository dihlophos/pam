<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preparation;
use App\Models\Disease;
use App\Models\Service;
use App\Models\ApplicationMethod;
use App\Http\Requests\StorePreparation;

class PreparationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $preparations = Preparation::with(['diseases', 'services', 'applicationMethods'])->orderBy('name')->paginate(50);
        $diseases = Disease::orderBy('name')->pluck('name', 'id');
        $services = Service::orderBy('name')->pluck('name', 'id');
        $applicationMethods = ApplicationMethod::orderBy('name')->pluck('name', 'id');
        return view(
                    'lists.preparations.index',
                    compact(['preparations', 'diseases', 'services', 'applicationMethods'])
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
    public function store(StorePreparation $request)
    {
        $preparation = Preparation::create($request->all());
        $preparation->diseases()->attach($request->diseases);
        $preparation->services()->attach($request->services);
        $preparation->applicationMethods()->attach($request->applicationMethods);
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('preparation.index');
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
    public function edit(Preparation $preparation)
    {
        $preparation->load('diseases', 'services', 'applicationMethods');
        $diseases = Disease::orderBy('name')->pluck('name', 'id');
        $services = Service::orderBy('name')->pluck('name', 'id');
        $applicationMethods = ApplicationMethod::orderBy('name')->pluck('name', 'id');
        return view(
                    'lists.preparations.edit',
                    compact(['preparation', 'diseases', 'services', 'applicationMethods'])
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePreparation $request, Preparation $preparation)
    {
        $preparation->fill($request->all())->save();
        $preparation->diseases()->sync($request->diseases?$request->diseases:[]);
        $preparation->services()->sync($request->services?$request->services:[]);
        $preparation->applicationMethods()->sync($request->applicationMethods?$request->applicationMethods:[]);
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('preparation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Preparation $preparation)
    {
        $preparation->diseases()->detach();
        $preparation->services()->detach();
        $preparation->applicationMethods()->detach();
        $preparation->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('preparation.index');
    }
 }
