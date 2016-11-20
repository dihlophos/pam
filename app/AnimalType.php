<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Тип животных

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
  protected $fillable = ['name'];

  public function animalCategory()
  {
    return $this->belongsTo(AnimalCategory::class);
  }

  public function diseases()
  {
    return $this->belongsToMany(Disease::class);
  }
  
}
