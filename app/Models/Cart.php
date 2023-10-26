<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Cart extends Model
{
    protected $fillable=['user_id','product_id','order_id','quantity','amount','price','status'];

    // public function product(){
    //     return $this->hasOne('App\Models\Product','id','product_id');
    // }
    // public static function getAllProductFromCart(){
    //     return Cart::with('product')->where('user_id',auth()->user()->id)->get();
    // }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public static function content($cart)
    {
        if (is_null($cart->session->get($cart->instance))) {
            return new Collection([]);
        }

        return $cart->session->get($cart->instance);
    }
    public static function getAllCart(){
        return  Cart::whereNotNull('order_id')->orderBy('id','DESC')->paginate(10);
    }
}
