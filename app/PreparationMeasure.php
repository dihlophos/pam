<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Елиница измерения ветеринарного препарата

	Поля:
		Название
*/
class PreparationMeasure extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
