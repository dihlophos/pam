<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Ветеринарно-санитарные работы:

	Поля:
		Объект
        Факт
        Код записи препарата
        Порядок применения
        Количество объектов
        Общ. объем кв.м. всего
        ---------------- в т.ч. по ГЗ
        В том числе кв.м. помещений всего
        --------------------------- в т.ч. по ГЗ
        В том числе кв.м. территории всего
        --------------------------- в т.ч. по ГЗ
        Израсходовано Кг, л
        ------------- единицы тары
        Уничтожено Кг, л
        Температкра
        Концентрация
        Расход на кв. м

*/
class SanitaryWork extends Model
{
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['object_id', 'fact_id', 'preparation_receipt_id',
    					   'application_method_id', 'objects_count', 'count',
    					   'count_gz', 'indoor_count', 'indoor_count_gz',
    					   'outdoor_count', 'outdoor_count_gz','preparation_used_doses',
    					   'preparation_used_containers', 'preparation_destroyed_doses',
    					   'temperature', 'concentration', 'сonsumption'];

    public function object()
    {
        return $this->belongsTo(Object::class);
    }

    public function fact()
    {
        return $this->belongsTo(Fact::class);
    }

    public function executor()
    {
        return $this->belongsTo(Executor::class);
    }

    public function preparation_receipt()
    {
        return $this->belongsTo(PreparationReceipt::class);
    }

    public function application_method()
    {
        return $this->belongsTo(ApplicationMethod::class);
    }
}
