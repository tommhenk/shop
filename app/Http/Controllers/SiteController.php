<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Arr;
use App\Repositories\MenusRepository;
use Menu;
class SiteController extends Controller
{
    protected $keywords;
    protected $meta_desc;
    protected $title;

     protected $m_rep;
     protected $c_rep;
     protected $p_rep;


    protected $template;

    protected $vars = [];

    public function __construct(MenusRepository $m_rep){
        $this->m_rep = $m_rep;
    }

    public function renderOutput(){

        $this->vars = Arr::add($this->vars, 'keywords', $this->keywords);
        $this->vars = Arr::add($this->vars, 'meta_desc', $this->meta_desc);
        $this->vars = Arr::add($this->vars, 'title', $this->title);

        $menus = $this->getMenu();
        $navigation = view(config('settings.theme').'.navigation')->with('menus', $menus)->render();
        $this->vars = Arr::add($this->vars, 'navigation', $navigation);
                // dd($this->vars);

        return view($this->template)->with($this->vars);
    }

    public function getMenu(){
        $menuItems = $this->m_rep->get();

        $mBuilder = Menu::make('myNav', function ($m) use ($menuItems) {
            foreach ($menuItems as $item) {
                if ($item->parent_id == 0) {
                    $m->add($item->title, $item->url)->id($item->id);
                }else{
                    if($m->find($item->parent_id)){
                        $m->find($item->parent_id)->add($item->title, $item->url)->id($item->id);
                    }
                }
            }
        });
        // dd($mBuilder);
        return $mBuilder;
    }
}
