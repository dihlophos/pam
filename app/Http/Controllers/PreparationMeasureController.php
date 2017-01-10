<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreparationMeasure;
use App\Http\Requests\StorePreparationMeasure;

class PreparationMeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        $preparation_measures = PreparationMeasure::orderBy('name')->paginate(50);

         return view('lists.preparation_measures.index', [
             'preparation_measures' => $preparation_measures,
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
     public function store(StorePreparationMeasure $request)
     {
         $preparation_measure = PreparationMeasure::create($request->all());
         $request->session()->flash('alert-success', 'Запись успешно добавлена!');
         return redirect()->route('preparation_measure.index');
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
     public function update(StorePreparationMeasure $request, PreparationMeasure $preparation_measure)
     {
         $preparation_measure->fill($request->all())->save();
         $request->session()->flash('alert-success', 'Запись успешно обновлена!');
         return redirect()->route('preparation_measure.index');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy(Request $request, PreparationMeasure $preparation_measure)
     {
         $preparation_measure->delete();
         $request->session()->flash('alert-success', 'Запись успешно удалена!');
         return redirect()->route('preparation_measure.index');
     }
 }
