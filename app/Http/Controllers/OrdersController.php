<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Order;
use App\Client;
use App\Item;
class OrdersController extends Controller
{

   public function list(Request $request, $item_code) {
      if (!empty($item_code)) {
        $data = $this->data['response'] = Order::select(
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
          ->where('item_code', '=', $item_code)
          ->where('orders.status', '=', 1)
          ->orderBy('orders.created_at', 'DESC')
          ->get();  
        return array("data"=> $data);
      } else {
        return array("data"=> Order::select('*')->orderBy('created_at', 'DESC')->get());
      }
   }

   public function save(Request $request) {
		$this->rule = array( 
            'item_name'=> 'required',
            'item_code'=> 'required',
            'item_quantity'=> 'required',
            'beginning_price'=> 'required',
            'selling_price'=> 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        );
        $this->validate($request->all(), $this->rule); 
        if (count(($this->data['error']['error_message'])) < 1) {

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
          if (!empty($request->facebook_link)) {
            $clientRecord = DB::table('clients')
              ->select('*')
              ->where('first_name', '=', $request->first_name)
              ->where('last_name', '=', $request->last_name)
              ->orWhere('facebook_link', '=', $request->facebook_link)
              ->get();
          } else {
             $clientRecord = DB::table('clients')
              ->select('*')
              ->where('first_name', '=', $request->first_name)
              ->where('last_name', '=', $request->last_name) 
              ->get();
          }
        	
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
            'item_id' => $request->item_id,
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

  public function approveOrder(Request $request) {
    $this->rule = array( 
        'id'=> 'required'
    );
    $this->validate($request->all(), $this->rule);

    if (empty($this->data['error']['error_message'])) {
      $order = Order::select('*')->where('id', '=', $request->id)->get();
      if ($order[0]->status == 2) {
        $this->data['response'] = "This item is already disapproved, try ordering it again.";
        return $this->data;
      }

      $order = Order::find($request->id);
      $order->status = 3;
      $order->save();
      $this->data['response'] = "Order approved";
    } 
    return $this->data;
  }

  public function disapproveOrder(Request $request) {
    $this->rule = array( 
        'id'=> 'required'
    );
    $this->validate($request->all(), $this->rule);

    if (empty($this->data['error']['error_message'])) {
      $order = Order::select('*')->where('id', '=', $request->id)->get();
      // $order = Order::find($request->id)->get();
      // return $order;
      if ($order[0]->status == 2) {
        $this->data['response']['quantity_left'] = 100;
        $this->data['response']['message'] = "Order already disapproved";
        return $this->data;
      }

      $orderQuantity = $order[0]->item_quantity;
      $item = Item::select('*')
        ->where('id', '=', $order[0]->item_id);
      $itemQuantity = $item->get()[0]->quantity;
      $item->update([
        'quantity' => $orderQuantity + $itemQuantity
      ]);

      $orderToUpdate = Order::find($request->id);
      $orderToUpdate->status = 2;
      $orderToUpdate->save();
      $this->data['response']['quantity_left'] = $orderQuantity + $itemQuantity;
      $this->data['response']['message'] = "Order successfully disapproved";
    } 
    return $this->data;
  }

}
