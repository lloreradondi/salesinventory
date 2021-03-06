<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

	protected $fillable = [
	    'name', 'beginning_price', 'selling_price', 'quantity'
	];
    public static function generateUniqueItemCode($itemCode) {
    	$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    	$string = '';
    	$random_string_length = 4;
		 $max = strlen($characters) - 1;
		 for ($i = 0; $i < $random_string_length; $i++) {
		      $string .= $characters[mt_rand(0, $max)];
		 }
		if (!Item::isItemCodeNotExisting($itemCode.$string)) {
			Item::generateUniqueItemCode($itemCode);
		}
    	return $itemCode.$string;
    }

    public static function isItemCodeNotExisting($itemCode) {
		$isItemCodeNotExisting = true;
		$itemTable = Item::select('*')->where('code', '=', $itemCode)->get();
		if (count($itemTable) < 0) {
			$isItemCodeNotExisting = false;
		}
		return $isItemCodeNotExisting;
	}

	
}
