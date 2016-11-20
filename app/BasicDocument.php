<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Первичный документ

	Поля:
		Название
*/
class BasicDocument extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
