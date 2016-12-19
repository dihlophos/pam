<?php

namespace App\Models;

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

  public function labs()
  {
    return $this->hasMany(Lab::class);
  }
}
