<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Половозрастная группа

	Поля:
		Название
    Болезнь
*/
class Agesex extends Model
{
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['name'];

    const AGE_LESS_THEN_6 = 'животные < 6 месяцев';
    const AGE_6_TO_12 = 'животные 6-12 месяцев';
    const AGE_GREATER_THEN_12 = 'животные > 1 года';

	public function animal_types()
	{
	    return $this->belongsToMany(AnimalType::class);
	}

    /**
    * Scope to get default agesex for the specified age.
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @param mixed $age
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeDefaultForAge($query, $age) {
        if ($age < 6) {
            return $query->where('name', Agesex::AGE_LESS_THEN_6);
        }
        if ($age >= 6 && $age <= 12) {
            return $query->where('name', Agesex::AGE_6_TO_12);
        }
        if ($age > 12) {
            return $query->where('name', Agesex::AGE_GREATER_THEN_12);
        }
    }

}
