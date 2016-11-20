<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Вид материала

	Поля:
		Название
*/
class MaterialType extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
