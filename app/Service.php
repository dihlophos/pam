<?php

namespace App;

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
  protected $fillable = ['name'];

  public function serviceCategory()
  {
    return $this->belongsTo(ServiceCategory::class);
  }

  public function measure()
  {
    return $this->belongsTo(Measure::class);
  }
}
