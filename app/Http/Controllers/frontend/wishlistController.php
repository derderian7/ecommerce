<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class wishlistController extends Controller
{
    public function index()
    {
        $wishlist = wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlist'));
    }
    public function add(Request $request)
    {
        $prod_id = $request->input('prod_id');
        if (Auth::check()) {
            $prod_check = Product::find($prod_id);
            if ($prod_check) {
                if (wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $prod_check->name . ' Already Added to wishlist']);
                } else {
                    $wishlist = new wishlist();
                    $wishlist->prod_id = $prod_id;
                    $wishlist->user_id = Auth::id();
                    $wishlist->save();
                    return response()->json(['status' => $prod_check->name . ' Added to wishlist']);
                }
            }
        } else return response()->json(['status' => 'Login to Continue']);
    }
    public function deleteproduct(Request $request)
    {
        $prod_id = $request->input('prod_id');
        if (wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists()) {
            $cartitem = wishlist::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
            $cartitem->delete();
            return response()->json(['status' => 'Product deleted successfully']);
        }
    }
}
