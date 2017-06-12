<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organ;
use App\Models\Region;
use App\Http\Requests\StoreOrgan;

class OrganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organs = Organ::orderBy('name')->paginate(50);
        $regions = Region::orderBy('name')->pluck('name', 'id');
        return view('lists.organs.index',
            compact(['organs', 'regions'])
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
    public function store(StoreOrgan $request)
    {
        $organ = Organ::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('organ.index');
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
    public function edit(Organ $organ)
    {
        $institutions = $organ->institutions()->orderBy('name')->paginate(50);
        $regions = Region::orderBy('name')->pluck('name', 'id');
        return view(
                    'lists.organs.edit',
                    compact(['organ', 'institutions', 'regions'])
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrgan $request, Organ $organ)
    {
        $organ->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('organ.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Organ $organ)
    {
        $organ->institutions()->delete();
        $organ->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('organ.index');
    }
}
