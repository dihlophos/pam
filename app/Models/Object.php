<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/*
	Тип:
		Объект

	Поля:
		Название, адрес, телефон, площадь территории, площадь обработки помещений,
        тип (Орган/учреждение/подразделение/объект)
    Внешние ключи:
        регион, район, муниципальное образование, населенный пункт
*/
class Object extends Model
{
    use NodeTrait;
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['name', 'address', 'phone', 'land_area',
                          'processing_area', 'type', 'region_id',
                          'district_id', 'municipality_id', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
