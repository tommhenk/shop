<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\CategoriesRepository;
use App\Http\Requests\CategoryRequest;

class CategoryController extends AdminController
{
    public function __construct(CategoriesRepository $c_rep){
        parent::__construct();

        $this->middleware(function($request, $next){

            if (\Gate::denies('moderator', new \App\Models\Category)) {
                abort(403);
            }
            return $next($request);
        });

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
        $this->title = 'Категории';
        $categories = $this->getCategories();
        $this->content = view(config('settings.theme').'.admin.categories.categories_content')->with('categories', $categories)->render();

        return $this->renderOutput();
    }

    protected function getCategories(){
        $categories = $this->c_rep->get('*', false, config('settings.categories_on_page'));
        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Добавление категории';
        $this->content = view(config('settings.theme').'.admin.categories.categories_add_content');
        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $result = $this->c_rep->addCategory($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with(implode(',',$result));
        }else{
            return redirect()->route('adminIndex')->with(implode(',',$result));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
