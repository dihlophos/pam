<?php

namespace App\Observers;

use App\Models\SanitaryWork;
use App\Models\PreparationReceipt;

class SanitaryWorkObserver
{
    public function created(SanitaryWork $sanitary_work)
    {
    	$preparation_receipt = PreparationReceipt::findOrFail($sanitary_work->preparation_receipt_id);
    	
    	$sanitary_work->preparation_used_containers = ceil($sanitary_work->preparation_used_doses / $preparation_receipt->container_doses);
    	$sanitary_work->preparation_destroyed_doses = ($sanitary_work->preparation_used_containers * $preparation_receipt->container_doses) - $sanitary_work->preparation_used_doses;
    	$preparation_receipt->used_containers += $sanitary_work->preparation_used_containers;
        
        SanitaryWork::flushEventListeners();
        $sanitary_work->save();
    	$preparation_receipt->save();
    }

    public function updating(SanitaryWork $sanitary_work)
    {
        $prev_sanitary_work = SanitaryWork::findOrFail($sanitary_work->id);
        $preparation_receipt = PreparationReceipt::findOrFail($sanitary_work->preparation_receipt_id);
        
        $sanitary_work->preparation_used_containers = ceil($sanitary_work->preparation_used_doses / $preparation_receipt->container_doses);
    	$sanitary_work->preparation_destroyed_doses = ($sanitary_work->preparation_used_containers * $preparation_receipt->container_doses) - $sanitary_work->preparation_used_doses;
    	
        $preparation_receipt->used_containers -= $prev_sanitary_work->preparation_used_containers;
        $preparation_receipt->used_containers += $sanitary_work->preparation_used_containers;
        $preparation_receipt->save();
    }
    
    public function deleting(SanitaryWork $sanitary_work)
    {
        $preparation_receipt = PreparationReceipt::findOrFail($sanitary_work->preparation_receipt_id);
        $preparation_receipt->used_containers -= $sanitary_work->preparation_used_containers;
        $preparation_receipt->save();
    }
}