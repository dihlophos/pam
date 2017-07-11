<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResearchType;
use App\Models\ResearchCategory;
use App\Http\Requests\StoreResearchType;

class ResearchTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $research_types = ResearchType::orderBy('name')->paginate(50);
        $research_categories = ResearchCategory::orderBy('name')->pluck('name', 'id');
        return view(
                    'lists.research_types.index',
                    compact([ 'research_types', 'research_categories'])
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
    public function store(StoreResearchType $request)
    {
        $research_type = ResearchType::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('research_type.index');
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
    public function update(StoreResearchType $request, ResearchType $research_type)
    {
        $research_type->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('research_type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ResearchType $research_type)
    {
        $research_type->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('research_type.index');
    }
}
