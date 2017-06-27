<?php

namespace App\Http\Controllers;
use App\Models\Object;
use App\Models\AnimalType;
use App\Models\BasicDocument;
use App\Models\Animal;
use App\Http\Requests\StoreAnimal;

class AnimalController extends Controller
{
    public function index(Object $object)
    {
        $animals = $object->animals()->with('animalType')->orderBy('name')->paginate(50);
        return view('animals.index',
            compact(['animals','object'])
        );
    }

    public function create(Object $object)
    {
        $animalTypes = AnimalType::orderBy('name')->get()->pluck('name', 'id');
        return view('animals.create',
            compact(['animalTypes', 'object'])
        );
    }

    public function store(Object $object, StoreAnimal $request)
    {
        //array_filter setting empty field to null
        $data = array_filter($request->all(), 'strlen');
        $animal = Animal::create($data);
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('object.animal.index', $object);
    }

    public function edit(Object $object, Animal $animal)
    {
        $animalTypes = AnimalType::orderBy('name')->get()->pluck('name', 'id');
        return view('animals.edit',
            compact(['animalTypes', 'object', 'animal'])
        );
    }

    public function update(Object $object, Animal $animal, StoreAnimal $request)
    {
        //array_filter setting empty field to null
        $data = array_filter($request->all(), 'strlen');
        $animal->fill($data)->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('object.animal.index', $object);
    }
}
