<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subdivision extends Model
{
    /*
    	Тип:
    		Подразделение

    	Поля:
    		Название
    */
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['name', 'institution_id'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function objects()
    {
        return $this->hasMany(Objects::class);
    }

    public function municipalities()
	{
	    return $this->belongsToMany(Municipality::class)->withTimestamps();
	}

    public function preparations()
	{
	    return $this->belongsToMany(Preparation::class)->withTimestamps();
	}
}
