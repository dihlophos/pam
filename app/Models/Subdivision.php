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
        return $this->hasMany(Object::class);
    }

    public function municipalities()
	{
	    return $this->belongsToMany(Municipality::class)->withTimestamps();
	}

    public function preparation_receipts()
	{
	    return $this->hasMany(PreparationReceipt::class);
    }
    
    public function users()
	{
	    return $this->hasMany(User::class);
    }
    
    public function scopeByUser($query, $user)
	{
	    if ($user->isAdmin())
        {
            return $query;
        }

        if ($user->attachedToSubdivision())
        {
           return $query->where('id', $user->subdivision->id);
        }

        if ($user->attachedToInstitution())
        {
           return $query->where('institution_id', $user->institution->id);
        }

        if ($user->attachedToOrgan())
        {
           $saved_query = clone $query;
           $institution_ids = $query
              ->join('institutions', 'institutions.id', '=', 'subdivisions.institution_id')
              ->where('organ_id', $user->organ->id)
              ->pluck('institution_id')
              ->toArray();
           return $saved_query->whereIn('institution_id', $institution_ids);
        }
	}
}
