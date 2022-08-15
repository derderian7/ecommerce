<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_items;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {

        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cartitems'));
    }
    public function place_order(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->firstname = $request->input('firstname');
        $order->lastname = $request->input('last_name');
        $order->email = $request->input('email');
        $order->phonenumber = $request->input('phonenumber');
        $order->address = $request->input('address');
        $order->tracking_no = rand(1000, 10000);
        $total = 0;
        $cartitems_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems_total as $prod) {
            $total += $prod->products->selling_price * $prod->prod_qty;
        }
        $order->price = $total;
        $order->save();



        $cartitems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems as $item) {
            Order_items::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->products->selling_price
            ]);
            $product = Product::where('id', $item->prod_id)->first();
            $product->qty = $product->qty - $item->prod_qty;
            $product->update();
        }
        if (Auth::user()->address == Null) {
            $user = User::where('id', Auth::id())->first();
            $user->last_name = $request->input('last_name');
            $user->phone = $request->input('phonenumber');
            $user->address = $request->input('address');
            $user->update();
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartitems);
        return redirect('/')->with('status', 'Order placed successfully');
    }
}
