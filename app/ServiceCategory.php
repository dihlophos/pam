<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Вид услуги

	Поля:
		Название
*/
class ServiceCategory extends Model
{
   /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
