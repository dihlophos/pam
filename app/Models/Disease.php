<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Болезнь

	Поля:
		Название
		Вид болезни
    Тип животных
*/
class Disease extends Model
{
   /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];

  public function diseaseType()
  {
    return $this->belongsTo(DiseaseType::class);
  }

  public function animalTypes()
  {
    return $this->belongsToMany(AnimalType::class);
  }

}
