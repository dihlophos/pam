<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Вид работ

	Поля:
		Название
*/
class WorkType extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
