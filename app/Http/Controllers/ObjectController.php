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
        $objects = Object::with('subdivision', 'institution', 'organ')
                            ->orderBy('organ_id')
                            ->orderBy('institution_id')
                            ->orderBy('subdivision_id')
                            ->orderBy('name');
        //TODO: Add auth filters depending on user role
        //Example:
        //$objects = $objects->where('subdivision_id', $user->subdivision_id);
        $objects = $objects->paginate(50);
        //transforming flat objects into tree structure
        $grouped_objects = $objects->groupBy('organ.name')->transform(function($item, $k) {
            return [
                'id' => $item[0]->organ_id,
                'institutions' => $item->groupBy('institution.name')->transform(function($item, $k) {
                    return [
                        'id' => $item[0]->institution_id,
                        'subdivisions' => $item->groupBy('subdivision.name')->transform(function($item, $k) {
                            return [
                                'id' => $item[0]->subdivision_id,
                                'objects' => $item
                            ];
                        })
                    ];
                })
            ];
        });
        
        return view('objects.index', [
            'organs' => $grouped_objects,
            'objects' => $objects
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
        //TODO: probably we could get subdivision_id from authenticated user
        $subdivision_id = intval($request->subdivision);
        $subdivision = Subdivision::find($subdivision_id);
        $subdivisions = [];
        $municipalities = [];
        if ($subdivision) {
            $municipalities = $subdivision->municipalities()->pluck('name', 'municipalities.id');
        }
        //TODO: other roles able to manage multiple subdivisions?
        if ($request->user()->isAdmin()) {
            $subdivisions = Subdivision::all();
        }

        return view('objects.create',
            compact(['subdivision_id', 'subdivision', 'municipalities', 'subdivisions'])
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
    public function edit(Object $object)
    {
        $municipalities = $object->subdivision->municipalities()->pluck('name', 'municipalities.id');
        $cities = $object->municipality->cities()->pluck('name', 'cities.id');
        return view('objects.edit',
            compact(['object', 'municipalities', 'cities'])
        );
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
