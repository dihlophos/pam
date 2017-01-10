<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicationMethod;
use App\Http\Requests\StoreApplicationMethod;

class ApplicationMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        $application_methods = ApplicationMethod::orderBy('name')->paginate(50);

        return view('lists.application_methods.index', [
            'application_methods' => $application_methods,
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
     public function store(StoreApplicationMethod $request)
     {
        $application_method = ApplicationMethod::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('application_method.index');
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
     public function update(StoreApplicationMethod $request, ApplicationMethod $application_method)
     {
        $application_method->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('application_method.index');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy(Request $request, ApplicationMethod $application_method)
     {
        $application_method->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('application_method.index');
     }
 }
