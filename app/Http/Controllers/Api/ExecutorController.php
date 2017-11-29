<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Executor;
use App\Http\Controllers\Controller;

class ExecutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $institution_id = $request->institution_id;
        $executor_name = $request->executor_name;
        $executors = Executor::orderBy('name');
        if ($institution_id) {
            $executors->where('institution_id', $institution_id);
        }
        if ($executor_name) {
            $executors->where('name', 'LIKE', "%$executor_name%");
        }
        return $executors->get();
    }
}
