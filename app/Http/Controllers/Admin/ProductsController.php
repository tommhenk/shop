<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\ProductsRepository;
use App\Repositories\CategoriesRepository;
use App\Http\Requests\ProductRequest;

class ProductsController extends AdminController
{
    public function __construct(ProductsRepository $p_rep, CategoriesRepository $c_rep){
        parent::__construct();

        $this->middleware(function($request, $next){

            if (\Gate::denies('view', new \App\Models\Product)) {
                abort(403);
            }
            return $next($request);
        });

        $this->p_rep = $p_rep;
        $this->c_rep = $c_rep;
        $this->template = config('settings.theme').'.admin.categories.categories';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Товары';

        $products = $this->getProducts();
        $this->content = view(config('settings.theme').'.admin.products.products_content')->with('products', $products)->render();
        return $this->renderOutput();
    }

    public function getProducts(){
        $products = $this->p_rep->get('*', 'false', config('settings.products_on_page'));
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Gate::denies('edit', new Product)) {
            abort(403);
        }

        $this->title = 'Добавление товара';
        $properties = $this->getProperties();
        // dd($properties);
        $categories = $this->c_rep->get();
        $list = $categories->reduce(function($returnCategories, $category){
            $returnCategories[$category->id] = $category->title;
            return $returnCategories;
        }, []);
        
        $this->content = view(config('settings.theme').'.admin.products.products_form_content')->with(['categories'=> $list, 'properties'=>$properties])->render();
        return $this->renderOutput();
    }

    private function getProperties(){
        $properties = \App\Models\Property::all();
        $properties = $properties->reduce(function($returnArr, $prop){
            $returnArr[$prop->name] = $prop->name;
            return $returnArr;
        },[]);
        return $properties;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $properties = $this->getProperties();
        $result = $this->p_rep->addProduct($request, $properties);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }else{
            return redirect()->route('adminIndex')->with($result);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $this->title = $product->title;

        $this->content = view(config('settings.theme').'.admin.products.products_show_content')->with('product', $product)->render();
        return $this->renderOutput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if (\Gate::denies('edit', new Product)) {
            abort(403);
        }

        $this->title = 'Добавление товара';
        $categories = $this->c_rep->get();
        $properties = $this->getProperties();
        $list = $categories->reduce(function($returnCategories, $category){
            $returnCategories[$category->id] = $category->title;
            return $returnCategories;
        }, []);
        
        $this->content = view(config('settings.theme').'.admin.products.products_form_content')->with(['categories'=>$list, 'product'=>$product, 'properties'=>$properties])->render();
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $properties = $this->getProperties();
        $result = $this->p_rep->updateProduct($request, $product, $properties);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }else{
            return redirect()->route('adminIndex')->with($result);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $result = $this->p_rep->destroyProduct($product);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with(implode(',',$result));
        }else{
            // dd($result);   
            return redirect()->route('adminIndex')->with($result);
        }
    }
}
