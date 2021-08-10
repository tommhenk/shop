<?php

namespace App\Repositories;

use App\Models\Order;
use Gate;
use Auth;

class OrdersRepository extends Repository {
	public function __construct(Order $category){
		$this->model = $category;
	}

	public function get($select = '*', $take = false, $pagin = true, $where = false){
		$result = parent::get($select, $take, config('settings.orders_per_page'), $where);

		return $this->checkSerialise($result);
	}

	private function checkSerialise($result){
		if(!empty($result)){
			$result->transform(function( $item, $key ){
				if (is_object(unserialize($item->card))) {
					$item->card = unserialize($item->card);
					return $item;
				}
			});
			return $result;
		}
		return false;
	}

}