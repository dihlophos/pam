<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Факт

	Поля:
		Объект
		Первичный документ
        Код записи сведений о животном
        Услуга
        Дата
*/
class Fact extends Model
{
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['object_id', 'basic_document_id', 'animal_id',
                           'service_id', 'date'];

    public function object()
    {
        return $this->belongsTo(Object::class);
    }

    public function basic_document()
    {
        return $this->belongTo(BasicDocument::class);
    }

    public function animal()
    {
        return $this->belongTo(Animal::class);
    }

    public function service()
    {
        return $this->belongTo(Service::class);
    }

    public function diseases()
    {
        return $this->belongsToMany(Disease::class);
    }
}
