<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Property;
use Gate;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductsRepository extends Repository {
	public function __construct(Product $product){
		$this->model = $product;
	}

	public function get($select = '*', $take = false, $pagin = false, $where = false, $request = false){
		$parent = parent::get($select, $take, config('settings.products_on_page'), $where);
		// $parent = $parent->reduce(function($returnArr, $item){
		// 	$returnArr[] = $item;
		// 	return $returnArr;
		// }, []);
		// // dd($parent->collect());
		if ($request) {
			$price_from = 0;
			// dd($request);
			if(!empty($request->price_from)){

				$price_from = $request->price_from;
			}
			$price_to = pow(10, 10);
			if(!empty($request->price_to)){
				$price_to = $request->price_to;
			}
			$products = $this->model->whereBetween('price', [$price_from, $price_to ])->get();
			// dd($products);

			$properties = Property::pluck('name')->toArray();
			$arrPropertiesRequest = [];
			foreach ($properties as $prop) {
				// dd($prop);
				if($request->$prop && $request->$prop == 'on'){
					$arrPropertiesRequest[] = $prop;
				}
			}
			if (!empty($arrPropertiesRequest)) {
				$products2 = $parent->reject(function($prod) use ($arrPropertiesRequest){
					// dd(method_exists($prod, 'hasProperty'));
					if(!$prod->hasProperty($arrPropertiesRequest, true)){
						return $prod;
					}
				});
				$products2->collect();
				$products = $products2->intersect($products);
			}
			
			
			// dd($products[12]->properties);
			// $products = Property::where('name','hit')->first()->products();
			return (new LengthAwarePaginator($products, $products->count(), config('settings.products_on_page')))->withPath('?'.$request->getQueryString());
		}
		
		return $parent;
	}

	public function destroyProduct($product){
		if (Gate::denies('edit', new Product)) {
			abort(403);
		}
		Storage::delete($product->img);
		$product->properties()->detach();
		$product->delete();
		return ['status'=>'Товар удален'];
	}

	public function updateProduct($request, $product, $properties){
		if (Gate::denies('edit', new Product)) {
			abort(403);
		}

		$data = $request->except('_token', 'img', ...array_keys($properties));
		if (empty($data)) {
			return ['error'=>'Нет данных!'];
		}

		if (empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title']);

			$res = $this->one($data['alias']);
			if (!empty($res) && ($res->id != $product->id)) {
				$request->merge(['alias'=>$data['alias']]);
				$request->flash();
				return ['error'=>'Псевдоним уже используеться!'];
			}
		}

		if ($request->hasFile('img')) {
			// $file = $request->file('img');
			// $data['img'] = $file->getClientOriginalName();
			// $file->move(public_path().'/'.config('settings.theme').'/img/products', $data['img']);
			Storage::delete($data['old_img']);
			$file = $request->file('img');
			$path = $file->store('cproducts');
			$data['img'] = $path;
		}else{
			$data['img'] = $data['old_img'];
		}
		unset($data['old_img']);
		// dd($data);
		$product->fill($data);
		foreach($properties as $prop){
			if (!empty($request->$prop)) {
				$product->properties()->attach(\App\Models\Property::where('name',$prop)->first()->id);
			}else{
				$product->properties()->detach(\App\Models\Property::where('name',$prop)->first()->id);
			}
		}
		if ($product->update()) {
			return ['status'=>'Товар отредактирован!'];
		}
	}

	public function addProduct($request, $properties){
		if (Gate::denies('edit', new Product)) {
			abort(403);
		}

		$data = $request->except('_token', 'img', ...array_keys($properties));

		if (empty($data)) {
			return ['error'=>'Нет данных!'];
		}

		if (empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title']);

			$res = $this->one($data['alias']);
			if (!empty($res)) {
				$request->merge(['alias'=>$data['alias']]);
				$request->flash();
				return ['error'=>'Псевдоним уже используеться!'];
			}
		}

		if ($request->hasFile('img')) {
			// $file = $request->file('img');
			// $data['img'] = $file->getClientOriginalName();
			// $file->move(public_path().'/'.config('settings.theme').'/img/products', $data['img']);
			$file = $request->file('img');
			$path = $file->store('cproducts');
			$data['img'] = $path;
		}
		// dd($data);
		$this->model->fill($data);

		if ($this->model->save()) {
			// dd($this->model->id);
			foreach($properties as $prop){
				if (!empty($request->$prop)) {
					// dd(\App\Models\Property::where('name',$prop)->first()->id);
					$this->model->properties()->attach(\App\Models\Property::where('name',$prop)->first()->id);
				}
			}
			return ['status'=>'Товар добавлен'];
		}
	}
}