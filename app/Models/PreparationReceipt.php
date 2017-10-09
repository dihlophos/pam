<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	Тип:
		Поступление препарата

	Поля:
		Препарат, Подразделение, Дата записи, Дата документа, Номер документа,
        Первичный документ, Серия, Количество доз (мл, г, л, кг) во флаконе (в комплекте флаконов, единице тары),
        Количество флаконов (к-тов флаконов, единиц тары), Использовано флаконов,
        Срок годности до, Вид приобретения, Стоимость флакона (к-та, единицы тары) (руб.),
        Примечание
*/
class PreparationReceipt extends Model
{
    /**
   * Массово присваиваемые атрибуты.
   *
   * @var array
   */
    protected $fillable = ['preparation_id', 'subdivision_id', 'date', 'doc_date',
                         'doc_num', 'basic_document_id', 'series', 'container_doses',
                         'count_containers', 'used_containers', 'expire_date',
                         'purchase_type', 'unit_price', 'comment', 'pack_date', 'prod_date' ];

    public function preparation()
    {
        return $this->belongsTo(Preparation::class);
    }

    public function subdivision()
    {
        return $this->belongsTo(Subdivision::class);
    }
}
