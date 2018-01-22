<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fact;
use App\Models\Prevention;
use App\Models\DiagnosticTest;
use App\Models\SanitaryWork;
use App\Models\Object;
use App\Models\BasicDocument;
use App\Models\Animal;
use App\Models\Service;
use App\Models\Executor;
use App\Models\PreparationReceipt;
use App\Models\ResearchType;
use App\Http\Requests\StoreFact;

class FactController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Object $object)
    {
        $facts = $object->facts()->with(['service', 'animals', 'animals.animalType', 'animals.agesex'])->orderBy('created_at', 'DESC')->paginate(50);
        return view('facts.index', compact(['facts', 'object']));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function create(Object $object)
    {
        $basic_documents = BasicDocument::orderBy('name')->get()->pluck('name', 'id');
        $animals = $object->animals()->with('animalType')->get();
        $services = Service::orderBy('name')->get();
        $executors = Executor::where('institution_id', $object->institution->id)->orderBy('name')->get()->pluck('name', 'id');
        $research_types = ResearchType::orderBy('name')->get()->pluck('name', 'id');
        return view('facts.create',
            compact(['object', 'basic_documents', 'animals', 'services', 'executors', 'research_types'])
        );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Object $object, StoreFact $request)
    {
        //array_filter setting empty field to null; for strings only
        //$data = array_filter($request->all(), 'strlen');
        $data = $request->all();
        //TODO:
        //if (!$data['animal_id']) unset($data['animal_id']); //sanitary_work doesnt have animal_id
        $fact = Fact::create($data);
        if (isset($data['diseases']))
        {
            $fact->diseases()->attach($data['diseases']);
        }
        if (isset($data['animals']))
        {
            $fact->animals()->attach($data['animals']);
        }
        $data['fact_id'] = $fact->id;
        switch ($fact->service->tab_index)
        {
            case 1:
                $prevention = Prevention::create($data);
                break;
            case 2:
                $diagnostic_test = DiagnosticTest::create($data);
                break;
            case 3:
                $sanitary_work = SanitaryWork::create($data);
                break;
        }
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('object.fact.index', $object);
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
    public function edit(Object $object, Fact $fact)
    {
        $basic_documents = BasicDocument::orderBy('name')->get()->pluck('name', 'id');
        $animals = $object->animals()->with('animalType')->get();
        $services = Service::orderBy('name')->get();
        $executors = Executor::where('institution_id', $object->institution->id)->orderBy('name')->get()->pluck('name', 'id');
        $research_types = ResearchType::orderBy('name')->get()->pluck('name', 'id');
        $preparation_receipts = [];
         switch ($fact->service->tab_index)
        {
            case 1:
                $preparation_receipts =
                                PreparationReceipt::select(DB::raw('*, preparation_receipts.id as id'))
                                                  ->join('preparations', 'preparation_receipts.preparation_id', '=', 'preparations.id')
                                                  ->where('preparation_receipts.id', $fact->prevention->preparation_receipt->id)->get();
                break;
            case 2:
                $preparation_receipts =
                                PreparationReceipt::select(DB::raw('*, preparation_receipts.id as id'))
                                                  ->join('preparations', 'preparation_receipts.preparation_id', '=', 'preparations.id')
                                                  ->where('preparation_receipts.id', $fact->diagnostic_test->preparation_receipt->id)->get();
                break;
            case 3:
                $preparation_receipts =
                            PreparationReceipt::select(DB::raw('*, preparation_receipts.id as id'))
                                              ->join('preparations', 'preparation_receipts.preparation_id', '=', 'preparations.id')
                                              ->where('preparation_receipts.id', $fact->sanitary_work->preparation_receipt->id)->get();
                break;
        }

        return view('facts.edit',
            compact(['fact', 'object', 'basic_documents', 'animals', 'services', 'executors', 'preparation_receipts', 'research_types'])
        );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Object $object, StoreFact $request, Fact $fact)
    {
        //array_filter setting empty field to null; for strings only
        //$data = array_filter($request->all(), 'strlen');
        $data = $request->all();
        //if (!$data['animal_id']) unset($data['animal_id']); //sanitary_work doesnt have animal_id
        $fact->fill($data)->save();
        if (isset($data['diseases']))
        {
            $fact->diseases()->sync($data['diseases']);
        }
        if (isset($data['animals']))
        {
            $fact->animals()->sync($data['animals']);
        }
        $data['fact_id'] = $fact->id;
        switch ($fact->service->tab_index)
        {
            case 1:
                $fact->prevention->fill($data)->save();
                break;
            case 2:
                $fact->diagnostic_test->fill($data)->save();
                break;
            case 3:
                $fact->sanitary_work->fill($data)->save();
                break;
        }
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('object.fact.index', $object);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Object $object, Request $request, Fact $fact)
    {
        $fact->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('object.fact.index', $object);
    }
}
