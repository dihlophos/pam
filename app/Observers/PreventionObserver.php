<?php

namespace App\Observers;

use App\Models\Prevention;
use App\Models\PreparationReceipt;

class PreventionObserver
{
    public function created(Prevention $prevention)
    {
    	$preparation_receipt = PreparationReceipt::findOrFail($prevention->preparation_receipt_id);
    	
    	$prevention->preparation_used_containers = ceil($prevention->preparation_used_doses / $preparation_receipt->container_doses);
    	$prevention->preparation_destroyed_doses = ($prevention->preparation_used_containers * $preparation_receipt->container_doses) - $prevention->preparation_used_doses;
    	$preparation_receipt->used_containers += $prevention->preparation_used_containers;
        
        Prevention::flushEventListeners();
        $prevention->save();
    	$preparation_receipt->save();
    }

    public function updating(Prevention $prevention)
    {
        $prev_prevention = Prevention::findOrFail($prevention->id);
        $preparation_receipt = PreparationReceipt::findOrFail($prevention->preparation_receipt_id);
        
        $prevention->preparation_used_containers = ceil($prevention->preparation_used_doses / $preparation_receipt->container_doses);
    	$prevention->preparation_destroyed_doses = ($prevention->preparation_used_containers * $preparation_receipt->container_doses) - $prevention->preparation_used_doses;
    	
        $preparation_receipt->used_containers -= $prev_prevention->preparation_used_containers;
        $preparation_receipt->used_containers += $prevention->preparation_used_containers;
        $preparation_receipt->save();
    }
    
    public function deleting(Prevention $prevention)
    {
        $preparation_receipt = PreparationReceipt::findOrFail($prevention->preparation_receipt_id);
        $preparation_receipt->used_containers -= $prevention->preparation_used_containers;
        $preparation_receipt->save();
    }
}