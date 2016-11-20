<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Категория исследований

	Поля:
		Название
*/
class ResearchCategory extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
