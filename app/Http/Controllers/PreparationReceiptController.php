<?php

namespace App\Http\Controllers;
use App\Models\Subdivision;
use App\Models\Preparation;
use App\Models\BasicDocument;
use App\Models\PreparationReceipt;
use App\Http\Requests\StorePreparationReceipt;

class PreparationReceiptController extends Controller
{
    public function index(Subdivision $subdivision)
    {
        $preparationReceipts = $subdivision->preparation_receipts()->with('preparation')->orderBy('date', 'desc')->paginate(50);
        return view('preparation_receipts.index',
            compact(['preparationReceipts','subdivision'])
        );
    }

    public function create(Subdivision $subdivision)
    {
        $preparations = Preparation::orderBy('name')->get()->pluck('name', 'id');
        $basicDocuments = BasicDocument::orderBy('name')->get()->pluck('name', 'id');
        return view('preparation_receipts.create',
            compact(['preparations', 'basicDocuments', 'subdivision'])
        );
    }

    public function store(Subdivision $subdivision, StorePreparationReceipt $request)
    {
        $preparationReceipt = PreparationReceipt::create($request->all());
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('subdivision.preparation_receipt.index', $subdivision);
    }

    public function edit(Subdivision $subdivision, PreparationReceipt $preparationReceipt)
    {
        $preparations = Preparation::orderBy('name')->get()->pluck('name', 'id');
        $basicDocuments = BasicDocument::orderBy('name')->get()->pluck('name', 'id');
        return view('preparation_receipts.edit',
            compact(['preparations', 'basicDocuments', 'subdivision', 'preparationReceipt'])
        );
    }

    public function update(Subdivision $subdivision, PreparationReceipt $preparationReceipt, StorePreparationReceipt $request)
    {
        $preparationReceipt->fill($request->all())->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('subdivision.preparation_receipt.index', $subdivision);
    }
}
