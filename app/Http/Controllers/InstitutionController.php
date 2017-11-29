<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\Executor;
use App\Http\Requests\StoreInstitution;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::orderBy('name')->paginate(50);

        return view('lists.institutions.index', [
            'institutions' => $institutions,
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
    public function store(StoreInstitution $request)
    {
        $institution = Institution::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('organ.edit', $institution->organ_id);
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
    public function edit(Institution $institution)
    {
        $institution->load('districts');
        $subdivisions = $institution->subdivisions()->orderBy('name')->paginate(50);
        $districts = $institution->organ->region->districts()->orderBy('name')->pluck('name', 'id');
        return view(
                    'lists.institutions.edit',
                    compact(['subdivisions', 'institution', 'districts'])
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreInstitution $request, Institution $institution)
    {
        $institution->fill($request->all())->save();
        $institution->districts()->sync($request->districts);
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('organ.edit', $institution->organ_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Institution $institution)
    {
        $institution->subdivisions()->delete();
        $institution->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('organ.edit', $institution->organ_id);
    }
}
