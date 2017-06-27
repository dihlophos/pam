<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Животное

	Поля:
		Объект, Вид животного, Возраст на 1 января т.г., Количество,
        Регистрационный номер, Кличка, Дата рождения, Пол, порода, окрас, особые приметы,
        № чипа татуировки
*/
class Animal extends Model
{
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['object_id', 'animal_type_id', 'age', 'count',
                           'regnum', 'name', 'birthday', 'marks', 'chipnum'];

    public function animalType()
    {
        return $this->belongsTo(AnimalType::class);
    }

    public function object()
    {
        return $this->belongsTo(Object::class);
    }


}
