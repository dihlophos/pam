<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Единица учета

	Поля:
		Название
*/
class Measure extends Model
{
   /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
