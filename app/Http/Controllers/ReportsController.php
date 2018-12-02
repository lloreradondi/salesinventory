<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order; 
use App\Item;
use DB;
class ReportsController extends Controller
{
    public function list(Request $request) { 
	    $data = $this->data['response'] = Order::select(
	      'orders.id',
	      'orders.item_name',
	      'orders.item_code', 
	      'orders.item_quantity', 
	      'orders.selling_price', 
	      'orders.created_at',
	      'orders.status',
	      'clients.facebook_link',
	      DB::raw("(orders.item_quantity * orders.selling_price) as total_price"),
	      DB::raw("DATEDIFF(NOW(), orders.created_at) as 'date_difference'"),
	      DB::raw('CASE
					   WHEN orders.status = 1 THEN "PENDING"
					   WHEN orders.status = 2 THEN "CANCELLED" 
					   ELSE "COMPLETED"
				   END as final_status'),
	      DB::raw("CONCAT(clients.first_name,' ',clients.last_name) as client_name"))
	      ->join('clients', 'orders.client_id', '=', 'clients.id')  
	      ->orderBy('orders.created_at', 'DESC')
	      ->get();  
	    return array("data"=> $data); 
   }

   public function dashboard(Request $request) { 
	    $data = $this->data['response'] = Order::select(
	      DB::raw("COUNT(id) as total"),
	      DB::raw("SUM(beginning_price * item_quantity) as capital"),
	      DB::raw("SUM(selling_price * item_quantity) as earnings"),
	      DB::raw('CASE
					   WHEN orders.status = 1 THEN "PENDING"
					   WHEN orders.status = 2 THEN "CANCELLED" 
					   ELSE "COMPLETED"
				   END as final_status'))
	      ->groupBy('status') 
	      ->get();  
	    return array("data"=> $data); 
   }

   public function remainingItems(Request $request) { 
	    $data = $this->data['response'] = Item::select(
	      'items.name',
	      'item_types.name as item_type',
	      'items.selling_price',
	      'items.beginning_price',
	      'items.quantity'
	    )
	      ->join('item_types', 'items.item_type_id', '=', 'item_types.id')
	      ->get();  
	    return array("data"=> $data); 
   }
}
