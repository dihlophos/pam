<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Вид услуги

	Поля:
		Название
*/
class ServiceType extends Model
{
	/**
	* Массово присваиваемые атрибуты.
	*
	* @var array
	*/
  	protected $fillable = ['name'];

	public function services()
	{
	    return $this->belongsToMany(Service::class);
	}
}
