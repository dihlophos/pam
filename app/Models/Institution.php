<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /*
    	Тип:
    		Учреждение

    	Поля:
    		Название
    */
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['name', 'organ_id'];

    public function organ()
    {
        return $this->belongsTo(Organ::class);
    }

    public function subdivisions()
    {
        return $this->hasMany(Subdivision::class);
    }

    public function districts()
	{
	    return $this->belongsToMany(District::class);
	}
}
