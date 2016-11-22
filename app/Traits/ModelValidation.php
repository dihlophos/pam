<?php
namespace App\Traits\ModelValidation;

use Illuminate\Contracts\Validation\Validator;

trait ModelValidation
{
    protected $rules = array();

    public function validate($data, &$errors)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $errors = $v->errors;
            return false;
        }

        // validation pass
        return true;
    }
}
