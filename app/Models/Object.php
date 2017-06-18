<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Объект

	Поля:
		Название, адрес, телефон, площадь территории, площадь обработки помещений,
    Внешние ключи:
        регион, район, муниципальное образование, населенный пункт,
        орган, учреждение, подразделение
*/
class Object extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
   protected $fillable = ['name', 'address', 'phone', 'land_area', 'processing_area',
                          'region_id', 'district_id', 'municipality_id', 'city_id',
                          'organ_id', 'institution_id', 'subdivision_id'];

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

    public function organ()
    {
        return $this->belongsTo(Organ::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function subdivision()
    {
        return $this->belongsTo(Subdivision::class);
    }
}
