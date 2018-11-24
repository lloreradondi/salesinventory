<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Item;

class ItemsController extends Controller
{
    public function list(Request $request, $id) {  
       if ($id == 1) {
           $itemsList = Item::select('*') 
                ->where('quantity', '>', 0)
                ->get();
       } else {
            $itemsList = Item::select('*') 
                ->get();
       } 
       return array("data"=> $itemsList);
	}

	public function save(Request $request) {  
		$this->rule = array( 
            'name'=> 'required',
            'beginning_price'=> 'required',
            'selling_price'=> 'required',
            'quantity'=> 'required'
        );
        $this->validate($request->all(), $this->rule);

        if (empty($this->data['error']['error_message'])) {

        	$itemRecord = Item::select('*')->where('name', '=', $request->name)->get();

        	if (count($itemRecord) > 0) {
        		$this->data['response'] = 'Item already existing in database';
        		return $this->data;
        	}

 			$isItemInserted = Item::insert(array(
 				'code' => Item::generateUniqueItemCode(),
 				'name' => $request->name,
 				'beginning_price' => $request->beginning_price,
 				'selling_price' => $request->selling_price,
 				'quantity' => $request->quantity
 			));

 			if ($isItemInserted) {
 				$this->data['response'] = "Item successfully added to database";
 			}
        }

        return $this->data;
	}

    public function update(Request $request, $id) {


        // dd($request->data[]);
        $item = Item::find($id);
        // dd($request->all());
        $item->update($request->data[$id]);
        // dd($item);
        $updateArray = array("data"=> array($item)); 
        return $updateArray;
    }

	
}
