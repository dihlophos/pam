<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Группа животных

	Поля:
		Название
*/
class AnimalCategory extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];

  public function animalTypes()
  {
    return $this->hasMany(AnimalType::class);
  }
}
