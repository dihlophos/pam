<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Вид исследований

	Поля:
		Название
		Категория исследований
*/
class ResearchType extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name', 'research_category_id'];

  public function researchCategory()
  {
    return $this->belongsTo(ResearchCategory::class);
  }
}
