<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Профилактика (Вакцинация, лечебно-профилактические обработки, дегельминтизация)

	Поля:
		Объект
        Факт
		Исполнитель
        Код записи препарата
        Порядок применения
        Вид услуги
        Количество всего
        Количество по ГЗ
        Количество окончательных обработок
        Количество заболело (осложнения)
        Количество пало, вынуж./убит
        Примечание
        Израсходовано доз (мл)
        Израсходовано контейнеров
        Уничтожено доз
*/
class Prevention extends Model
{
    /**
    * Массово присваиваемые атрибуты.
    *
    * @var array
    */
    protected $fillable = ['object_id', 'fact_id', 'executor_id',
                           'preparation_receipt_id', 'application_method_id',
                           'service_type', 'count', 'count_gz', 'count_final',
                           'count_ill', 'count_rip', 'comment',
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

    public function application_method()
    {
        return $this->belongTo(ApplicationMethod::class);
    }
}
