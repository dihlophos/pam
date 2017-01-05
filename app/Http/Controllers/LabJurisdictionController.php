<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabJurisdiction;
use App\Http\Requests\StoreLabJurisdiction;

class LabJurisdictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lab_jurisdictions = LabJurisdiction::paginate(50);

        return view('lists.lab_jurisdictions.index', [
            'lab_jurisdictions' => $lab_jurisdictions,
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
    public function store(StoreLabJurisdiction $request)
    {
        $lab_jurisdiction = LabJurisdiction::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('lab_jurisdiction.index');
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
    public function update(StoreLabJurisdiction $request, LabJurisdiction $lab_jurisdiction)
    {
        $lab_jurisdiction->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('lab_jurisdiction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, LabJurisdiction $lab_jurisdiction)
    {
        $lab_jurisdiction->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('lab_jurisdiction.index');
    }
}
