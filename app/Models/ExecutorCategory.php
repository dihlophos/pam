<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Категория исполнителя

	Поля:
		Название
*/
class ExecutorCategory extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];

  public function executors()
  {
    return $this->hasMany(Executor::class);
  }
}
