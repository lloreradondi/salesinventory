<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemType;
class ItemTypesController extends Controller
{
    public function list(Request $request, $identifier) {  
       $itemsTypesList = ItemType::select('*') 
                ->get();


        $data = [];
       foreach ($itemsTypesList as $key => $value) {
           $data[] = array(
            'id' => $value->id,
            'created_at' => date('F d, Y',strtotime($value->created_at)),
            'name' => "<p id='$value->id' onblur='updateItem($value->id, this, \"name\")' contenteditable='true'>".$value->name."</p>",
            'code' => "<p id='$value->id' onblur='updateItem($value->id, this, \"code\")' contenteditable='true'>".$value->code."</p>"
            );
       }
       return array("data"=> empty($identifier) ? $itemsTypesList : $data);
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
        $item->update($request->all());
        $updateArray = array("data"=> array($item)); 
        return $updateArray;


        // $item = ItemType::find($id); 
        // $item->update($request->data[$id]);
        // $updateArray = array("data"=> array($item)); 
        // return $updateArray;
    }
}
