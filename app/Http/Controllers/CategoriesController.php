<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;
use App\Repositories\CategoriesRepository;
use App\Repositories\ProductsRepository;
use Arr;
use App\Models\Category;

class CategoriesController extends SiteController
{
    public function __construct(CategoriesRepository $c_rep, ProductsRepository $p_rep){
        parent::__construct(new \App\Repositories\MenusRepository( new \App\Models\Menu));
        $this->c_rep = $c_rep;
        $this->p_rep = $p_rep;

        $this->template = config('settings.theme').'.categories';
    }
    /**
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Категории';
        $categories = $this->getGategories();
        
        $content = view(config('settings.theme').'.categories_content')->with('categories', $categories)->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    public function getGategories(){
        $categories = $this->c_rep->get('*', false, config('settings.categories_on_page'));
        // dd($categories);
        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $filters = $this->getFilters();
        $filters_form = view(config('settings.theme').'.filters_form')->with('filters', $filters)->render();
        $this->vars = Arr::add($this->vars, 'filters_form', $filters_form);
                // dd($this->vars);
        $products = $this->getProducts($category->id);
        
        // dd($products);
        $content = view(config('settings.theme').'.index_content')->with(['products'=>$products, 'category'=>$category])->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        $this->title = $category->title;

        return $this->renderOutput();
    }

    public function getProducts($category_id){
        $products = $this->p_rep->get('*', false, config('settings.products_on_page'), ['category_id', $category_id]);
        return $products;
    }

    public function getFilters () {
        return true;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
