<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Object;
use App\Models\AnimalType;
use App\Models\BasicDocument;
use App\Models\Animal;
use App\Models\Agesex;
use App\Http\Requests\StoreAnimal;

class AnimalController extends Controller
{
    public function index(Object $object)
    {
        $animal_groups = $object->animals()->with('animalType','agesex')
            ->where('individual','=', '0')->orderBy('name')->paginate(20, ['*'], 'groups_page');
        $animal_individuals = $object->animals()->with('animalType','agesex')
            ->where('individual','=', '1')->orderBy('name')->paginate(20, ['*'], 'individuals_page');
        return view('animals.index',
            compact(['animal_groups','animal_individuals','object'])
        );
    }

    public function create(Request $request, Object $object)
    {
        $animalTypes = AnimalType::orderBy('name')->get()->pluck('name', 'id');
        $view = $request->input('individual') ? 'animals.individual_create' : 'animals.group_create';
        return view($view,
            compact(['animalTypes', 'object'])
        );
    }

    public function store(Object $object, StoreAnimal $request)
    {
        $data = $request->all();
        if (!$data['agesex_id']) {
            $data['agesex_id'] = Agesex::defaultForAge($data['age'])->first()->id;
        }
        $animal = Animal::create($data);
        $request->session()->flash('alert-success', 'Запись успешно добавлена!');
        return redirect()->route('object.animal.index', $object);
    }

    public function edit(Object $object, Animal $animal)
    {
        $animalTypes = AnimalType::orderBy('name')->get()->pluck('name', 'id');
        $view =  $animal->individual ? 'animals.individual_edit' : 'animals.group_edit';
        return view($view,
            compact(['animalTypes', 'object', 'animal'])
        );
    }

    public function update(Object $object, Animal $animal, StoreAnimal $request)
    {
        $data = $request->all();
        if (!$data['agesex_id']) {
            $data['agesex_id'] = Agesex::defaultForAge($data['age'])->first()->id;
        }
        $animal->fill($data)->save();
        $request->session()->flash('alert-success', 'Запись успешно обновлена!');
        return redirect()->route('object.animal.index', $object);
    }

    public function destroy(Request $request, Object $object, Animal $animal)
    {
        $animal->delete();
        $request->session()->flash('alert-success', 'Запись успешно удалена!');
        return redirect()->route('object.animal.index', $object);
    }
}
