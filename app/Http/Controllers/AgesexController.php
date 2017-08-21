<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agesex;
use App\Models\AnimalType;
use App\Http\Requests\StoreAgesex;

class AgesexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agesexes = Agesex::orderBy('name')->with('animal_types')->paginate(50);
        $animal_types = AnimalType::orderBy('name')->pluck('name', 'id');

        return view('lists.agesexes.index', [
            'agesexes' => $agesexes,
            'animal_types' => $animal_types
        ]);
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
    public function store(StoreAgesex $request)
    {
        $agesex = Agesex::create($request->all());
        $agesex->animal_types()->attach($request->animal_types);
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('agesex.index');
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
    public function edit(Agesex $agesex)
    {
        $animal_types = AnimalType::orderBy('name')->pluck('name', 'id');
        return view(
                    'lists.agesexes.edit',
                    compact([ 'agesex', 'animal_types'])
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAgesex $request, Agesex $agesex)
    {
        $agesex->fill($request->all())->save();
        $agesex->animal_types()->sync($request->animal_types?$request->animal_types:[]);
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('agesex.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Agesex $agesex)
    {
        $agesex->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('agesex.index');
    }
}
