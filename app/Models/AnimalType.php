<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Вид животных

	Поля:
		Название
		Группа животных
    Болезнь
*/
class AnimalType extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name', 'animal_category_id'];

  public function animalCategory()
  {
    return $this->belongsTo(AnimalCategory::class);
  }

  public function diseases()
  {
    return $this->belongsToMany(Disease::class);
  }

}
