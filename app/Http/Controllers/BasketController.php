<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\SiteController;
use App\Repositories\CategoriesRepository;
use App\Repositories\ProductsRepository;
use Arr;
use App\Models\Category;
use App\Models\Product;
use App\Models\Card;
use App\Models\Order;
use Session;
use Auth;

class BasketController extends SiteController
{
    public function __construct(){
        parent::__construct(new \App\Repositories\MenusRepository( new \App\Models\Menu));

        $this->template = config('settings.theme').'.basket';
    }

    public function index(){
        if (!Session::has('card') || Session::get('card')->totalyQty == 0) {
            $this->remove();
            return redirect()->route('home')->with('info', 'Ваша корзина пуста');
        }
        $this->title = 'Корзина';
        $card = Session::get('card');

        $content = view(config('settings.theme').'.basket_content')->with('card', $card)->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    public function remove(){
        if (Session::get('card')) {
            Session::forget('card');
        }
        return redirect()->route('indexBasket');
    }

    public function add(Product $product){
        $oldCard = Session::has('card') ? Session::get('card') : null;
        $card = new Card($oldCard);
        $card->add($product);

        Session::put('card', $card);
        // dd(Session::get('card'));
        return redirect()->route('indexBasket')->with('status', 'Товар - '.$product->title.' добавлен в корзину');
    }

    public function substract(Product $product){
        if(!Session::has('card')){
            return route('home')->with('info', 'Ваша корзина пуста');
        }
        $oldCard = Session::has('card') ? Session::get('card') : null;
        $card = new Card($oldCard);
        $card->substract($product);

        Session::put('card', $card);
        // dd(Session::get('card'));
        return redirect()->route('indexBasket')->with('info', 'Товар - '.$product->title.' извлечен из корзину');
    }

    public function order (){
        if(!Session::has('card')){
            return redirect()->route('home')->with('info', 'Ваша корзина пуста');
        }
        $this->title = 'Оформление заказа';

        $oldCard = !empty(Session::has('card')) ? Session::get('card') : null;
        $card = new Card($oldCard);

        $content = view(config('settings.theme').'.order_content')->with('card', $card)->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    public function receive_order ( OrderRequest $request){
        if(!Session::has('card')){
            return redirect()->route('home')->with('info', 'Ваша корзина пуста');
        }
        $oldCard = !empty(Session::has('card')) ? Session::get('card') : null;
        $card = new Card($oldCard);
        // dd($request->except('_token'));
        $data = $request->except('_token');
        $data['card'] = serialize($card);

        $order = new Order;
        $order->fill($data);
        if (Auth::check()) {
            $user = Auth::user();
            $user->orders()->save($order);
            
        }
        else if($order->save()){
            
        }
        $this->remove();
        return redirect()->route('home')->with('status', 'Ваш заказ оформлен');
    }
}
