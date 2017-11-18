<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Subdivision;
use App\Models\Object;
use App\Http\Controllers\Controller;

class ObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Subdivision $subdivision, Request $request)
    {
        $sort = $request->sort;
        $order = $request->order;
        $object_name = $request->object_name;
        $objects = $subdivision->objects();
        if ($sort && $order) {
            $objects->orderBy($sort, $order);
        }
        if ($object_name) {
            $objects->where('name', 'LIKE', "%$object_name%");
        }
        return $objects->jsonPaginate();
    }
}
