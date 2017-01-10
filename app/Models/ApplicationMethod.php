<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Порядок применения

	Поля:
		Название
*/
class ApplicationMethod extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
    protected $fillable = ['name'];
}
