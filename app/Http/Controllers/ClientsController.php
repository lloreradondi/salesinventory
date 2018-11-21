<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Client;


class ClientsController extends Controller
{

	public function list(Request $request) {  
        
        $clientsList = Client::select(
            DB::Raw("IFNULL(first_name, 'Not Available') as first_name"),
            DB::Raw("IFNULL(middle_name, 'Not Available') as middle_name"),
            DB::Raw("IFNULL(last_name, 'Not Available') as last_name"),
            DB::Raw("IFNULL(cellphone_number, 'Not Available') as cellphone_number"),
            DB::Raw("IFNULL(telephone_number, 'Not Available') as telephone_number"),
            DB::Raw("IFNULL(facebook_link, 'Not Available') as facebook_link")
        )->get();
 		$this->data['response'] = $clientsList;

        return $this->data;
	}


	public function save(Request $request) {
		$this->rule = array(
            'first_name'=> 'required',
            'last_name'=> 'required'
        );
        $this->validate($request->all(), $this->rule);

        if (empty($this->data['error']['error_message'])) {
        	$isInserted = Client::insert(array(
        		'first_name' => $request->first_name,
        		'last_name' => $request->last_name));

        	if($isInserted) {
        		$this->data['response'] = "Client successfully added";
        	} 
        }

        return $this->data;
	}

	private function isExisting(Request $request) {

	}
}
