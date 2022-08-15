<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::where('trending', '1')->take(15)->get();
        $category = Category::where('popular', '1')->take(15)->get();
        return view('frontend.index', compact('products', 'category'));
    }
    public function category()
    {
        $category = Category::where('status', '1')->get();
        return view('frontend.category', compact('category'));
    }
    public function viewcategory($slug)
    {
        if (Category::where('slug', $slug)->exists()) {
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('cate_id', $category->id)->get();
            return view('frontend.products.index', compact('category', 'products'));
        } else {
            return redirect('/')->with('status', 'slug does not exists');
        }
    }
    public function productview($cate_slug, $prod_slug)
    {
        if (Category::where('slug', $cate_slug)->exists()) {
            if (Product::where('slug', $prod_slug)->exists()) {
                $products = Product::where('slug', $prod_slug)->first();
                return view('frontend.products.view', compact('products'));
            } else {
                return redirect('/')->with('status', 'error');
            }
        } else {
            return redirect('/')->with('status', 'no such category found');
        }
    }
    public function productlist()
    {
        $product = Product::select('name')->where('status', '1')->get();
        $data = [];
        foreach ($product as $item) {
            $data[] = $item['name'];
        }
        return $data;
    }
    public function searchproduct(Request $request)
    {
        $search = $request->product_name;
        if ($search != '') {
            $product = Product::where("name", "LIKE", "%$search%")->first();
            if ($product) {
                return redirect('view-category/' . $product->category->slug . '/' . $product->slug);
            } else return redirect()->back()->with('status', 'No products match your search');
        } else return redirect()->back();
    }
}
