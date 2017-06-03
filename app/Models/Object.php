<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Объект

	Поля:
		Название, населенный пункт
*/
class Object extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
   protected $fillable = ['name', 'city_id'];

   public function city()
   {
     return $this->belongsTo(City::class);
   }
}
