<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    protected $fillable = [
	    'name', 'code'
	];

	public static function itemTypeRecord($id) { 
		$itemType = ItemType::select('*')->where('id', '=', $id)->get(); 
		return $itemType;
	}
}
