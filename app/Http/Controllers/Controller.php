<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function SetEmptyKeysToNull($keys, &$array) 
    {
        foreach ($keys as $key)
        {
            if ( !array_key_exists($key, $array) || $array[$key] === "") 
            {
                $array[$key] = null;
            }
        }
    }
    
}
