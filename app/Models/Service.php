<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Услуга

	Поля:
		Название
		Вид услуги
		Единица учета
*/
class Service extends Model
{
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['name', 'measure_id', 'tab_index', 'service_category_id'];

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function measure()
    {
        return $this->belongsTo(Measure::class);
    }

    public function preparations()
    {
        return $this->belongsToMany(Preparation::class);
    }

    public function service_types()
    {
        return $this->belongsToMany(ServiceType::class);
    }

    public static function tabs()
    {
        return collect([
            1=>'обработки',
            2=>'исследования',
            3=>'ВС работы'
        ]);
    }
}
