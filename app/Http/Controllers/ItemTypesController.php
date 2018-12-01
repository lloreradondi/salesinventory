<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemType;
class ItemTypesController extends Controller
{
    public function list(Request $request) {  
       $itemsTypesList = ItemType::select('*') 
                ->get();
       return array("data"=> $itemsTypesList);
	}

	public function save(Request $request) {  
		$this->rule = array( 
            'name'=> 'required',
            'code'=> 'required', 
        );
        $this->validate($request->all(), $this->rule);

        if (empty($this->data['error']['error_message'])) {

        	$itemRecord = ItemType::select('*')
        					->where('code', '=', $request->code)->get();

        	if (count($itemRecord) > 0) {
        		$this->data['response'] = 'Item already existing in database';
        		return $this->data;
        	}

 			$isItemInserted = ItemType::insert(array(
 				'code' => strtoupper($request->code),
 				'name' => $request->name
 			));

 			if ($isItemInserted) {
 				$this->data['response'] = "Item Type successfully added to database";
 			}
        }

        return $this->data;
	}

	public function update(Request $request, $id) {
        $item = ItemType::find($id); 
        $item->update($request->data[$id]);
        $updateArray = array("data"=> array($item)); 
        return $updateArray;
    }
}
