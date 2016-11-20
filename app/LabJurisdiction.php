<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Подведомственность лаборатории

	Поля:
		Название
*/
class LabJurisdiction extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
