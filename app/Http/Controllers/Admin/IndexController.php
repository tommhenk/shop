<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Arr;
use Gate;
class IndexController extends AdminController
{
    public function __construct(){
        parent::__construct();

        // $this->middleware(function($request, $next){

        //     if (Gate::denies('VIEW_ADMIN', Auth::user())) {
        //         abort(403);
        //     }
        //     return $next($request);
        // });


        $this->template = config('settings.theme').'.admin.admin';
    }

    public function index(){
        $this->title = 'Панель администратора';
        $this->content = 'Главная страница';
        return $this->renderOutput();
    }
}
