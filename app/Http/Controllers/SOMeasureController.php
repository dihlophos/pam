<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SOMeasure;
use App\Http\Requests\StoreSOMeasure;


class SOMeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $so_measures = SOMeasure::orderBy('name')->paginate(50);

        return view('lists.so_measures.index', [
            'so_measures' => $so_measures,
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
    public function store(StoreSOMeasure $request)
    {
        $so_measure = SOMeasure::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('so_measure.index');
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
    public function update(StoreSOMeasure $request, SOMeasure $so_measure)
    {
        $so_measure->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('so_measure.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SOMeasure $so_measure)
    {
        $so_measure->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('so_measure.index');
    }
}
