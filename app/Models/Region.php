<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Регион

	Поля:
		Название
*/
class Region extends Model
{
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['name'];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
