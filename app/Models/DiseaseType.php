<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Вид болезни

	Поля:
		Название
*/
class DiseaseType extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];

  public function diseases()
  {
    return $this->hasMany(Disease::class);
  }
}
