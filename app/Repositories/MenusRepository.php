<?php

namespace App\Repositories;

use App\Models\Menu;
use Gate;
use Auth;

class MenusRepository extends Repository {
	public function __construct(Menu $menu){
		$this->model = $menu;
	}
}