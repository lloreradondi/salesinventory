<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Item;
use App\ItemType;
class ItemsController extends Controller
{
    public function list(Request $request, $id) {  
       if ($id == 1) {
           $itemsList = Item::select('*') 
                ->where('quantity', '>', 0) 
                ->orderBy('quantity', 'DESC') 
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
            'quantity'=> 'required',
            'item_type_id'=> 'required'
        );
        $this->validate($request->all(), $this->rule);

        if (empty($this->data['error']['error_message'])) {

        	$itemRecord = Item::select('*')->where('name', '=', $request->name)->get();
            $itemType = ItemType::itemTypeRecord($request->item_type_id);
        	if (count($itemRecord) > 0) {
        		$this->data['response'] = 'Item already existing in database';
        		return $this->data;
        	}

 			$isItemInserted = Item::insert(array(
 				'code' => Item::generateUniqueItemCode($itemType[0]->code),
 				'name' => $request->name,
 				'beginning_price' => $request->beginning_price,
 				'selling_price' => $request->selling_price,
 				'quantity' => $request->quantity,
                'item_type_id' => $request->item_type_id
 			));

 			if ($isItemInserted) {
 				$this->data['response'] = "Item successfully added to database";
 			}
        }

        return $this->data;
	}

    public function regenerateItemCodes(Request $request) {
        $allItems = Item::select('*')->get();
        foreach ($allItems as $key => $value) {
            $itemType = ItemType::itemTypeRecord($value->item_type_id);
            $recordToUpdate = Item::select('*')
                            ->where('id', '=', $value->id)
                            ->update(
                                array(
                                    'code' => Item::generateUniqueItemCode($itemType[0]->code)
                                ));
        }
        if (count($allItems) > 0) {
            $this->data['response'] = "Item codes generation success";
        } else {
            $this->data['response'] = "No code to update.. please add an item.. redirecting to items...";
        }
        

        return $this->data;
    }

    public function update(Request $request, $id) {
        $item = Item::find($id);
        $item->update($request->data[$id]);
        $updateArray = array("data"=> array($item)); 
        return $updateArray;
    }



	
}
