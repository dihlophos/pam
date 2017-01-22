<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipality;
use App\Http\Requests\StoreMunicipality;

class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipalities = Municipality::orderBy('name')->paginate(50);

        return view('lists.municipalities.index', [
            'municipalities' => $municipalities,
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
    public function store(StoreMunicipality $request)
    {
        $municipality = Municipality::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('district.edit', $municipality->district_id);
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
    public function edit(Municipality $municipality)
    {
        $cities = $municipality->cities()->orderBy('name')->paginate(50);
        return view(
                    'lists.municipalities.edit',
                    compact(['cities', 'municipality'])
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMunicipality $request, Municipality $municipality)
    {
        $municipality->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('district.edit', $municipality->district_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Municipality $municipality)
    {
        $municipality->cities()->delete();
        $municipality->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('district.edit', $municipality->district_id);
    }
}
