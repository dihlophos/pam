<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Исполнитель

	Поля:
		Название
		Категория исполнителя
*/
class Executor extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];

  public function executorCategory()
  {
    return $this->belongsTo(ExecutorCategory::class);
  }
}
