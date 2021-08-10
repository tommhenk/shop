<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Order;
use Auth;
use Gate;
class OrdersController extends AdminController
{
    public function __construct( \App\Repositories\OrdersRepository $o_rep){
        parent::__construct();

        // $this->middleware(function($request, $next){

        //     if (Gate::denies('view', new \App\Models\Order)) {
        //         abort(403);
        //     }
        //     return $next($request);
        // });

        $this->o_rep = $o_rep;
        $this->template = config('settings.theme').'.admin.orders.orders';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Заказы';
        $where = false;
        if (Auth::user()->hasRole('guest')) {
            $where = ['user_id', Auth::user()->id];
        }
        $orders = $this->getOrders($where);
        // dd($orders[1]->user);
        $this->content = view(config('settings.theme').'.admin.orders.orders_content')->with('orders', $orders)->render();

        return $this->renderOutput();
    }

    protected function getOrders($where = false){
        $orders = $this->o_rep->get('*', false, true, $where);
        return $orders;
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
    public function show(Order $order)
    {
          
        if (Gate::allows('view', new Order) || ($order->user_id == Auth::id())) {
            // dd($order);
            $this->title = 'Заказ - '.$order->id;
            if(!empty($order->card) && is_object(unserialize($order->card))){
                $order->card = unserialize($order->card);
            }
            // dd($order);
            $this->content = view(config('settings.theme').'.admin.orders.orders_show_one')->with('order', $order)->render();

            return $this->renderOutput();
        }
        abort(403);
        
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
