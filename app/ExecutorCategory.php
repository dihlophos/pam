<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Категория исполнителя

	Поля:
		Название
*/
class ExecutorCategory extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
