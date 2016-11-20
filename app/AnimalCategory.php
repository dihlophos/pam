<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Группа животных

	Поля:
		Название
*/
class AnimalCategory extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
