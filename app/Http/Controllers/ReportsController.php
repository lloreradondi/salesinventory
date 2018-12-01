<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order; 
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
	      DB::raw('CASE
					   WHEN orders.status = 1 THEN "PENDING"
					   WHEN orders.status = 2 THEN "CANCELLED" 
					   ELSE "COMPLETED"
				   END as final_status'),
	      DB::raw("CONCAT(clients.first_name,' ',clients.last_name) as client_name"))
	      ->join('clients', 'orders.client_id', '=', 'clients.id')  
	      ->get();  
	    return array("data"=> $data);
      
   }
}
