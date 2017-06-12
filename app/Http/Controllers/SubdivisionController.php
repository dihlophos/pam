<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subdivision;
use App\Models\Municipality;
use App\Http\Requests\StoreSubdivision;

class SubdivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subdivisions = Subdivision::orderBy('name')->paginate(50);

        return view('lists.subdivisions.index', [
            'subdivisions' => $subdivisions,
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
    public function store(StoreSubdivision $request)
    {
        $subdivision = Subdivision::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('institution.edit', $subdivision->institution_id);
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
    public function edit(Subdivision $subdivision)
    {
        $subdivision->load('municipalities');
        $municipalities = Municipality::whereIn('district_id', $subdivision->institution->districts->pluck('id'))->orderBy('name')->pluck('name', 'id');
        return view(
                    'lists.subdivisions.edit',
                    compact(['subdivision', 'municipalities'])
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSubdivision $request, Subdivision $subdivision)
    {
        $subdivision->fill($request->all())->save();
        $subdivision->municipalities()->sync($request->municipalities);
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('institution.edit', $subdivision->institution_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Subdivision $subdivision)
    {
        $subdivision->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('institution.edit', $subdivision->institution_id);
    }
}
