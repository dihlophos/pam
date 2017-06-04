<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Object;
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
        $objects = Object::orderBy('name')->where('type', '=', 'organ')->paginate(50);
        //Object::withDepth()->having('depth', '=', 1)->get();

        return view('lists.objects.index', [
            'objects' => $objects,
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
     * @param  \App\Http\Requests\StoreObject   $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreObject $request)
    {
        $object = Object::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('object.edit', $object->id);
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
        $ancestors =  $object->ancestors()->get();
        $objects = $object->children()->orderBy('name')->paginate(50);
        return view(
                    'lists.objects.edit',
                    compact(['object', 'objects', 'ancestors'])
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
        return redirect()->route('object.edit', $object->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Object $object)
    {
        $parent = $object->parent_id;
        $object->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        if ($parent)
        {
            return redirect()->route('object.edit', $parent);
        } else {
            return redirect()->route('object.index');
        }

    }
}
