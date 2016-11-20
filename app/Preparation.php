<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Препарат

	Поля:
		Название
*/
class Preparation extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];
}
