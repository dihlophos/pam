<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Болезни

	Поля:
		Название
		Вид болезни
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

}
