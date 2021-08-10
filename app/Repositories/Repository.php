<?php

namespace App\Repositories;

use App\Models\Menu;
use Config;
abstract class Repository 
{
	protected $model;

	public function get($select = '*', $take = false, $pagin = false, $where = false/*, $request = false*/){
		$builder = $this->model->select($select);
		// dd($this->model->all());
		if ($take) {
			$builder->take($take);
		}

		if ( $where ) {
			// dd($where);
			$builder->where($where[0], $where[1]);
		}

		// if($request){
		// 	$builder->filter(function($item, $key){
		// 		if($item->hasProperty('hit')){
		// 			return $item;
		// 		}
		// 	});
		// }

		if($pagin) {
			return $this->check($builder->paginate($pagin));
		}

		return $this->check($builder->get());
	}

	public function one($alias){
		$result = $this->model->where('alias', $alias)->first();

		return $result;
	}


	private function check($res){
		if ($res->isEmpty()) {
			return false;
		}
		$res->transform(function($item, $key){
			if(is_string($item->img) && is_object(json_decode($item->img)) && (json_last_error() == JSON_ERROR_NONE)){
				$item->img = json_decode($item->img);
			}
			return $item;
		});
		return $res;
	}

	public function transliterate ( $string ) {
		$str = mb_strtolower($string, 'UTF-8');

		$letter_array = [
			'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
			'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
			'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
			'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
			'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
			'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
			'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
	 
			'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
			'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
			'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
			'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
			'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
			'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
			'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
		];
		$letter_array = array_flip($letter_array);

		foreach($letter_array as $letter => $kyr) {
			$str = str_replace($kyr, $letter, $str);
		}

		$str = preg_replace('#(\s|[^a-zA-Z\d-])+#', '-', $str);

		$str = trim($str, '-');

		return $str;
	}
}