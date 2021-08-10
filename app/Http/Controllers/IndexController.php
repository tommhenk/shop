<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;
use App\Repositories\ProductsRepository;
use Arr;
use App\Http\Requests\PropertiesFormRequest;
use Debugbar;
class IndexController extends SiteController
{
    public function __construct( ProductsRepository $p_rep ){
        parent::__construct(new \App\Repositories\MenusRepository( new \App\Models\Menu));
        $this->p_rep = $p_rep;
        $this->title = 'Главная страница';
        $this->template = config('settings.theme').'.index';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( PropertiesFormRequest $request )
    {
        // Debugbar::info($request);PP
        $filters_form = view(config('settings.theme').'.filters_form')->render();
        $this->vars = Arr::add($this->vars, 'filters_form', $filters_form);

        // if (!empty($request->price_from) && !empty($request->all())) {
        //     dd($request->all());
        // }
        $req = false;
        if ($request->hit == 'on' || $request->new == 'on' || $request->recommend == 'on' || !empty($request->price_from) || !empty($request->price_to)) {
            // dd($request->all());
            $req = $request;
        }
        $products = $this->getProducts($req);
        // dd($products);
        $content = view(config('settings.theme').'.index_content')->with('products', $products)->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    public function getProducts($request = false){
        $products = $this->p_rep->get('*', false, config('settings.products_on_page'), false, $request);
        if ($products) {
            $products->load('category');
        }
        return $products;
    }

    public function getFilters () {
        return true;
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
    public function show($id)
    {
        //
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
