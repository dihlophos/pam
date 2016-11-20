<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Единица измерения СО

	Поля:
		Название
*/
class SOMeasure extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
