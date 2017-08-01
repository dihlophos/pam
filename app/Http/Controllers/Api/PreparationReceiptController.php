<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Subdivision;
use App\Models\PreparationReceipt;
use App\Http\Requests\StoreSubdivision;
use App\Http\Controllers\Controller;

class PreparationReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Subdivision $subdivision, Request $request)
    {
        $service_id = intval($request->service_id);
        $used_doses = intval($request->preparation_used_doses);
    	//$preparation_receipts = $subdivision->preparation_receipts()->with('preparation')->get();
    	$preparation_receipts = PreparationReceipt::join('preparations', 'preparation_receipts.preparation_id', '=', 'preparations.id')->whereSubdivisionId($subdivision->id);
    	if ($service_id) {
    	    $preparation_receipts = $preparation_receipts->whereRaw('preparation_receipts.preparation_id IN (SELECT preparation_id FROM preparation_service WHERE service_id = '.$service_id.')');
    	}
    	if ($used_doses) {
            $preparation_receipts = $preparation_receipts->whereRaw('count_containers > CAST(used_containers AS SIGNED) + CEIL('.$used_doses.'/container_doses)');
    	}
        return $preparation_receipts->get();
    }
}
