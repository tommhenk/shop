<?php

namespace App\Models;
use Session;
class Card
{
    public $items = null;
    public $totalyQty = 0;
    public $totalyPrice = 0;

    public function __construct($oldCart) {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalyQty = $oldCart->totalyQty;
            $this->totalyPrice = $oldCart->totalyPrice;
        }
    }

    public function remove(){
        $this->items = null;
        $this->totalyQty = 0;
        $this->totalyPrice = 0;
    }

    public function add($product){
        $storedItem = ['qty'=>0, 'price'=>$product->price, 'item'=>$product];
        if ($this->items) {
            if (array_key_exists($product->id, $this->items)) {
                $storedItem = $this->items[$product->id];
            }
        }

        $storedItem['qty']++;
        $storedItem['price'] = $storedItem['qty'] * $product->price;
        $this->items[$product->id] = $storedItem;

        $this->totalyQty++;
        $this->totalyPrice += $product->price;
    }

    public function substract($product){
        if ($this->items) {
            if (array_key_exists($product->id, $this->items)) {
                $storedItem = $this->items[$product->id];
                // dd($storedItem);
                if($storedItem['qty'] > 0) {
                    $storedItem['qty']--;
                    // dd($storedItem['qty']);
                    
                    $this->totalyQty--;
                    $this->totalyPrice -= $product->price;
                    $storedItem['price'] = $storedItem['qty'] * $product->price;
                    if ($storedItem['qty'] <= 0) {
                        unset($this->items[$product->id]);
                        if ($this->totalyQty == 0) {
                            
                            Session::forget('card');
                        }
                        return;
                    }
                    $this->items[$product->id] = $storedItem;
                    
                }else{
                    
                }
            }
        }
    }
}
