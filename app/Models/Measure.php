<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Единица учета

	Поля:
		Название
*/
class Measure extends Model
{
   /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
  protected $fillable = ['name'];

  public function services()
  {
    return $this->hasMany(Service::class);
  }
}
