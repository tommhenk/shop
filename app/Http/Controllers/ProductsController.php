<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;
use App\Repositories\CategoriesRepository;
use App\Repositories\ProductsRepository;
use Arr;
use App\Models\Category;
use App\Models\Product;
class ProductsController extends SiteController
{
    public function __construct(CategoriesRepository $c_rep, ProductsRepository $p_rep){
        parent::__construct(new \App\Repositories\MenusRepository( new \App\Models\Menu));
        $this->c_rep = $c_rep;
        $this->p_rep = $p_rep;

        $this->template = config('settings.theme').'.products';
    }

    public function index($cat_name, Product $product){
        $this->title = $product->title;
        // dd($product->isNew());
        $content = view(config('settings.theme').'.product_content')->with('product', $product)->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }
}
