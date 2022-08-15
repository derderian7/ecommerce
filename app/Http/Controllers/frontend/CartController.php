<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $qty_input = $request->input('qty_input');
        if (Auth::check()) {
            $prod_check = Product::where('id', $prod_id)->first();
            if ($prod_check) {
                if (Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $prod_check->name . ' Already Added to Cart']);
                } else {
                    $cartitem = new Cart();
                    $cartitem->prod_id = $prod_id;
                    $cartitem->user_id = Auth::id();
                    $cartitem->prod_qty = $qty_input;
                    $cartitem->save();
                    return response()->json(['status' => $prod_check->name . ' Added to Cart']);
                }
            }
        } else return response()->json(['status' => 'Login to Continue']);
    }
    public function viewcart()
    {
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart', compact('cartitems'));
    }
    public function deleteproduct(Request $request)
    {
        $prod_id = $request->input('prod_id');
        if (Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
            $cartitem = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
            $cartitem->delete();
            return response()->json(['status' => 'Product deleted successfully']);
        }
    }
    public function updatecart(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $qty = $request->input('qty');
        if (Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
            $cart = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
            $cart->prod_qty = $qty;
            $cart->update();
            return response()->json(['status' => 'Quantity updated successfully']);
        }
    }
}
