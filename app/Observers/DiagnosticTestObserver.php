<?php

namespace App\Observers;

use App\Models\DiagnosticTest;
use App\Models\PreparationReceipt;

class DiagnosticTestObserver
{
    public function created(DiagnosticTest $test)
    {
    	$preparation_receipt = PreparationReceipt::findOrFail($test->preparation_receipt_id);
    	
    	$test->preparation_used_containers = ceil($test->preparation_used_doses / $preparation_receipt->container_doses);
    	$test->preparation_destroyed_doses = ($test->preparation_used_containers * $preparation_receipt->container_doses) - $test->preparation_used_doses;
    	$preparation_receipt->used_containers += $test->preparation_used_containers;
        
        DiagnosticTest::flushEventListeners();
        $test->save();
    	$preparation_receipt->save();
    }

    public function updating(DiagnosticTest $test)
    {
        $prev_test = DiagnosticTest::findOrFail($test->id);
        $preparation_receipt = PreparationReceipt::findOrFail($test->preparation_receipt_id);
        
        $test->preparation_used_containers = ceil($test->preparation_used_doses / $preparation_receipt->container_doses);
    	$test->preparation_destroyed_doses = ($test->preparation_used_containers * $preparation_receipt->container_doses) - $test->preparation_used_doses;
    	
        $preparation_receipt->used_containers -= $prev_test->preparation_used_containers;
        $preparation_receipt->used_containers += $test->preparation_used_containers;
        $preparation_receipt->save();
    }
    
    public function deleting(DiagnosticTest $test)
    {
        $preparation_receipt = PreparationReceipt::findOrFail($test->preparation_receipt_id);
        $preparation_receipt->used_containers -= $test->preparation_used_containers;
        $preparation_receipt->save();
    }
}