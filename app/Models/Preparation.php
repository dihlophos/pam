<?php

namespace App\Models;

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

	public function diseases()
	{
	    return $this->belongsToMany(Disease::class);
	}
}
