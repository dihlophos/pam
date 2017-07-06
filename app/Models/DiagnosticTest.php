<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Диагностические исследования

	Поля:
		Объект
        Факт
		Исполнитель
        Код препарата
        Вид исследований
        Кратность услуги в текущем году
        Характеристики услуги
        Количество всего
        Количество по ГЗ
        Количество положительно
        Примечание
        Дата и номер заклчения
        Израсходовано доз (мл)
        Израсходовано контейнеров
        Уничтожено доз
*/
class DiagnosticTest extends Model
{
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['object_id', 'fact_id', 'executor_id', 'preparation_receipt_id',
                           'research_type_id', 'year_multiplicity',
                           'service_characteristics', 'count', 'count_gz',
                           'count_positive', 'comment', 'conclusion_num',
                           'preparation_used_doses', 'preparation_used_containers',
                           'preparation_destroyed_doses'];

    public function object()
    {
        return $this->belongsTo(Object::class);
    }

    public function fact()
    {
        return $this->belongTo(Fact::class);
    }

    public function executor()
    {
        return $this->belongTo(Executor::class);
    }

    public function preparation_receipt()
    {
        return $this->belongTo(PreparationReceipt::class);
    }

    public function research_type()
    {
        return $this->belongTo(ResearchType::class);
    }
}
