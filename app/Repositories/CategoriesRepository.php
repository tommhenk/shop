<?php

namespace App\Repositories;

use App\Models\Category;
use Gate;
use Auth;
use Illuminate\Support\Facades\Storage;

class CategoriesRepository extends Repository {
	public function __construct(Category $category){
		$this->model = $category;
	}

	public function destroyCategory($category){
		if (\Gate::denies('moderator', new Category)) {
			abort(403);
		}
		Storage::delete($category->img);
		$category->products()->delete();

		if($category->delete()){
			return ['status'=>'Категория удалена'];
		}
	}

	public function updateCategory($request, $category) {
		if (\Gate::denies('moderator', new Category)) {
			abort(403);
		}
		// dd($request->all());
		$data = $request->except('_token', 'img', '_method');

		if (empty($data)) {
			return ['error'=>'Нет данных'];
		}

		if (empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title']);

			$res = $this->one($data['alias']);
			if(isset($res->id) && $res->id != $category->id ){
				$request->merge(['alias'=>$data['alias']]);
				$request->flash();
				return ['error'=>'Псевдоним уже используеться'];
			}
		}

		if ($request->hasFile('img')) {
			// $file = $request->file('img');
			// $data['img'] = $file->getClientOriginalName();

			// $file->move(public_path().'/'.config('settings.theme').'/img/categories', $data['img']);
			Storage::delete($data['old_img']);
			$file = $request->file('img');
			$path = $file->store('categories');
			$data['img'] = $path;

		}else{
			$data['img'] = $data['old_img'];
		}
		unset($data['old_img']);
		// dd($data);
		$category->fill($data);

		if($category->update()){
			return ['status'=> 'Категория отредактирована'];
		}


	}

	public function addCategory($request) {
		if (\Gate::denies('moderator', new Category)) {
			abort(403);
		}
		// dd($request->all());
		$data = $request->except('_token', 'img');

		if (empty($data)) {
			return ['error'=>'Нет данных'];
		}

		if (empty($data['alias'])) {
			$data['alias'] = $this->transliterate($data['title']);

			if($this->one($data['alias'])){
				$request->merge(['alias'=>$data['alias']]);
				$request->flash();
				return ['error'=>'Псевдоним уже используеться'];
			}
		}

		if ($request->hasFile('img')) {
			// $file = $request->file('img');
			// $data['img'] = $file->getClientOriginalName();

			// $file->move(public_path().'/'.config('settings.theme').'/img/categories', $data['img']);
			// dd($request->file('img'));
			$file = $request->file('img');
			$path = $file->store('categories');
			$data['img'] = $path;
		}
		// dd($data);
		$this->model->fill($data);

		if($this->model->save()){
			return ['status' => 'Категория добавлена'];
		}


	}
}