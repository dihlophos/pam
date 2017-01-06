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
  protected $fillable = ['name', 'disease_type_id'];

  public function diseaseType()
  {
    return $this->belongsTo(DiseaseType::class);
  }

  public function animalTypes()
  {
    return $this->belongsToMany(AnimalType::class);
  }

  public function Services()
  {
    return $this->belongsToMany(Service::class)->withPivot('year_multiplicity');
  }

}
