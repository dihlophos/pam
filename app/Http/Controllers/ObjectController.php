<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Object;
use App\Models\Subdivision;
use App\Models\Institution;
use App\Models\Organ;
use App\Models\Municipality;
use App\Http\Requests\StoreObject;

class ObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objects = Object::orderBy('name')->paginate(50);

        return view('objects.index', [
            'objects' => $objects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $subdivision_id = intval($request->subdivision);
        $subdivision = Subdivision::find($subdivision_id);
        //$institution = $subdivision->institution();
        //$organ = $institution->organ();

        $municipalities = $subdivision->municipalities()->pluck('name', 'municipalities.id');
        return view('objects.create',
            compact(['subdivision_id', 'subdivision', 'municipalities'])
        );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(StoreObject $request)
    {
        $data = $request->all();
        $subdivision = Subdivision::find($data['subdivision_id']);
        $municipality = Municipality::find($data['municipality_id']);
        $institution = $subdivision->institution;
        $organ = $institution->organ;
        $data['institution_id'] = $institution->id;
        $data['organ_id'] = $organ->id;
        $data['district_id'] = $municipality->district_id;
        $data['region_id'] = $organ->region_id;
        $object = Object::create($data);
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('object.index');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreObject $request, Object $object)
    {
        $object->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('object.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, Object $object)
    {
        $object->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('object.index');
    }
}
