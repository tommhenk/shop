<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MenusRepository;
use Arr;
use Menu;
use Gate;
Use Auth;

class AdminController extends Controller
{
    protected $title;

     protected $c_rep;
     protected $p_rep;
     protected $o_rep;
     protected $content = false;


    protected $template;

    protected $vars = [];

    public function __construct(){
        $this->middleware(function( $request, $next ) {
            
            if(!Auth::check()){
                return abort(403);
            }
            return $next($request);
        });
    }

    public function renderOutput(){

        $this->vars = Arr::add($this->vars, 'title', $this->title);

        $menus = $this->getMenu();
        $navigation = view(config('settings.theme').'.admin.navigation')->with('menus', $menus)->render();
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);
                // dd($this->vars);
        if ($this->content) {
            $this->vars = Arr::add($this->vars, 'content', $this->content);
        }

        return view($this->template)->with($this->vars);
    }

    public function getMenu(){

        $mBuilder = Menu::make('myNav', function ($m) {
            if (\Gate::allows('moderator', new \App\Models\Category)) {
                $m->add('Категории', ['route'=>'admin_index_categories']);
            }
            
            if (\Gate::allows('view', new \App\Models\Product)) {
                $m->add('Товары', ['route'=>'admin_index_products']);
            }
            
            if (\Gate::allows('view', new \App\Models\Order)) {
                $m->add('Заказы', ['route'=>'admin_index_orders']);
            }

            if (Auth::user()->hasRole('guest')) {
                $m->add('Мои заказы', ['route'=>'admin_index_orders']);
            }
            
            // dd(Auth::user()->canDo('USER_VIEW_ADMIN'));
            if (\Gate::allows('USER_VIEW_ADMIN', Auth::user())) {
                $m->add('Пользователи', ['route'=>'admin_index_users']);
                $m->add('Привелегии', ['route'=>'admin_index_permissions']);
            }
        });
        // dd($mBuilder);
        return $mBuilder;
    }
}
