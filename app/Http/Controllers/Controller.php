<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = array(
    	'response'=> array(),
        'error' => array(
            'error_message' => array()
        )
    ); 
 
    

    protected function validate($request, $rule) {
    	$validator = Validator::make($request, $rule);
    	if ($validator->fails()) {
    		$this->data['error']['error_message'] = $validator->messages()->all(); 
    	} 
    }
}
