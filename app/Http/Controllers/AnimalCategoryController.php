<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnimalCategory;
use App\Http\Requests\StoreAnimalCategory;

class AnimalCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animal_categories = AnimalCategory::orderBy('name')->paginate(50);

        return view('lists.animal_categories.index', [
            'animal_categories' => $animal_categories,
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
    public function store(StoreAnimalCategory $request)
    {
        $animal_category = AnimalCategory::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('animal_category.index');
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
    public function update(StoreAnimalCategory $request, AnimalCategory $animal_category)
    {
        $animal_category->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('animal_category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, AnimalCategory $animal_category)
    {
        $animal_category->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('animal_category.index');
    }
}
