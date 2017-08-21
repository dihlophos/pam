<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Половозрастная группа

	Поля:
		Название
    Болезнь
*/
class Agesex extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
	
	public function animal_types()
	{
	    return $this->belongsToMany(AnimalType::class);
	}
	
}
