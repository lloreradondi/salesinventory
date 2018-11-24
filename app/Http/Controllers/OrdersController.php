<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Order;
use App\Client;
use App\Item;
class OrdersController extends Controller
{

   public function list(Request $request) {
   		if (!empty($request->item_code)) {
   			$this->data['response'] = Order::select(
   				'orders.id',
   				'orders.item_name',
   				'orders.item_code', 
   				'orders.item_quantity', 
   				'orders.selling_price', 
   				'orders.created_at',
   				'orders.status',
   				'clients.first_name',
   				'clients.last_name')
   				->join('clients', 'orders.client_id', '=', 'clients.id')
	   			->where('item_code', '=', $request->item_code)
	   			->get();
    	} else {
    		$this->data['response'] = Order::select('*')
	   			->get();
    	}

    	return $this->data;
   		
   }

   public function save(Request $request) {
		$this->rule = array( 
            'item_name'=> 'required',
            'item_code'=> 'required',
            'item_quantity'=> 'required',
            'beginning_price'=> 'required',
            'selling_price'=> 'required',
        );
        $this->validate($request->all(), $this->rule);

        if (empty($this->data['error']['error_message'])) {

        	$itemRecord = DB::table('items')
        				->select('*')
        				->where('code', '=', $request->item_code);

			if (count($itemRecord->get()) > 0) {
				if ($itemRecord->get()[0]->quantity <  $request->item_quantity) {
					$this->data['response']['message'] = "Order exceeds our stock";
					$this->data['response']['quantity_left'] =$itemRecord->get()[0]->quantity;
					return  $this->data;
				} else {
					$quantityLeft = $itemRecord->get()[0]->quantity - $request->item_quantity;
					$itemRecord->update(['quantity'=> $quantityLeft]); 
				}
			} else {
				$this->data['response']['message'] = "Order not existing";
				return  $this->data;
			}

        	$clientId = "";
        	$clientRecord = DB::table('clients')
    					->select('*')
    					->where('first_name', '=', $request->first_name)
    					->where('last_name', '=', $request->last_name)
    					->get();
    		if (count($clientRecord) < 1) {
    			$clientId = Client::insertGetId(array(
        		'first_name' => $request->first_name,
        		'last_name' => $request->last_name,
        		'facebook_link' => $request->facebook_link));
    		} else {
    			$clientId = $clientRecord[0]->id;
    		} 

        	$isInserted = Order::insert(array(
        		'client_id' => $clientId,
        		'item_name' => $request->item_name,
        		'item_code' => $request->item_code,
        		'item_quantity' => $request->item_quantity,
        		'beginning_price' => $request->beginning_price,
        		'selling_price' => $request->selling_price));

        	if($isInserted) { 
        		$this->data['response']['quantity_left'] = $quantityLeft;
        		$this->data['response']['message'] = "Order successfully added";
        	} 
        }

        return $this->data;
	}
}
