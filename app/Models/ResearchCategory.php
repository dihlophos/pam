<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Категория исследований

	Поля:
		Название
*/
class ResearchCategory extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];

  public function researchTypes()
  {
    return $this->belongsTo(ResearchType::class);
  }
}
