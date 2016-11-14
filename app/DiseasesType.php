<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Виды болезней

	Поля:
		Название
*/
class DiseasesType extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
