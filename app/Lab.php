<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Лаборатория

	Поля:
		Название
		Подведомственность лаборатории
*/
class Lab extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];

  public function labJurisdiction()
  {
    return $this->belongsTo(LabJurisdiction::class);
  }
}
