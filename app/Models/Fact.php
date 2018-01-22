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
        Вид услуги
        Дата
        Коментарий
*/
class Fact extends Model
{
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['object_id', 'executor_id', 'basic_document_id',
                           'service_id', 'service_type_id', 'date', 'comment'];

    public function object()
    {
        return $this->belongsTo(Object::class);
    }

    public function basic_document()
    {
        return $this->belongsTo(BasicDocument::class);
    }

    public function animals()
    {
        return $this->belongsToMany(Animal::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class);
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

    public function sanitary_work() {
        return $this->hasOne(SanitaryWork::class);
    }
}
