<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExecutorCategory;
use App\Http\Requests\StoreExecutorCategory;

class ExecutorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $executor_categories = ExecutorCategory::paginate(50);

        return view('lists.executor_categories.index', [
            'executor_categories' => $executor_categories,
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
    public function store(StoreExecutorCategory $request)
    {
        $executor_category = ExecutorCategory::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('executor_category.index');
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
    public function update(StoreExecutorCategory $request, ExecutorCategory $executor_category)
    {
        $executor_category->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('executor_category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ExecutorCategory $executor_category)
    {
        $executor_category->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('executor_category.index');
    }
}
