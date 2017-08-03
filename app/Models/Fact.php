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
    protected $fillable = ['object_id', 'executor_id', 'basic_document_id', 'animal_id',
                           'service_id', 'date', 'comment'];

    public function object()
    {
        return $this->belongsTo(Object::class);
    }

    public function basic_document()
    {
        return $this->belongsTo(BasicDocument::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function diseases()
    {
        return $this->belongsToMany(Disease::class);
    }
    
    public function prevention() {
        return $this->hasOne(Prevention::class);
    }
    
    public function diagnostic_test() {
        return $this->hasOne(DiagnosticTest::class);
    }
}
