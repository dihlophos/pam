<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Executor;
use App\Models\Institution;
use App\Models\ExecutorCategory;
use App\Http\Requests\StoreExecutor;

class ExecutorController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $executors = Executor::orderBy('name')->with(['executorCategory', 'institution'])->paginate(50);
        $executor_categories = ExecutorCategory::orderBy('name')->pluck('name', 'id');
        $institutions = Institution::orderBy('name')->pluck('name', 'id');
        return view(
                    'lists.executors.index',
                    compact([ 'executors', 'executor_categories', 'institutions'])
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
    public function store(StoreExecutor $request)
    {
        $executor = Executor::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('executor.index');
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
    public function edit(Executor $executor)
    {
        $executor_categories = ExecutorCategory::orderBy('name')->pluck('name', 'id');
        $institutions = Institution::orderBy('name')->pluck('name', 'id');
        return view(
                   'lists.executors.edit',
                   compact(['executor', 'executor_categories', 'institutions'])
               );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreExecutor $request, Executor $executor)
    {
        $executor->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('executor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Executor $executor)
    {
        $executor->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('executor.index');
    }
 }