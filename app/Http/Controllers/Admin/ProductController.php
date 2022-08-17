<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function add()
    {
        $category = Category::all();
        return view('admin.product.add', compact('category'));
    }
    public function insert(Request $request)
    {
        $product = new Product();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/products', $filename);
            $product->image = $filename;
        }
        $product->cate_id = $request->input('cate_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_desc = $request->input('small_desc');
        $product->desc = $request->input('desc');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->tax = $request->input('tax');
        $product->status = $request->input('status') == TRUE ? '1' : '0';
        $product->trending = $request->input('trending') == TRUE ? '1' : '0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->meta_desc = $request->input('meta_desc');
        $product->save();

        
        $user = User::get();
        $product_id = Product::latest()->first();
        Notification::send($user, new \App\Notifications\AddProduct($product_id));

        return redirect('/dashboard')->with('status', 'Products Added Successfully');
    }
    public function edit($id)
    {
        $products = Product::find($id);
        return view('admin.product.edit', compact('products'));
    }
    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/products/' . $products->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/products', $filename);
            $products->image = $filename;
        }
        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->small_desc = $request->input('small_desc');
        $products->desc = $request->input('desc');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price');
        $products->qty = $request->input('qty');
        $products->tax = $request->input('tax');
        $products->status = $request->input('status') == TRUE ? '1' : '0';
        $products->trending = $request->input('trending') == TRUE ? '1' : '0';
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');
        $products->meta_desc = $request->input('meta_desc');
        $products->update();
        return redirect('/dashboard')->with('status', 'Product updated Successfully');
    }
    public function destroy($id)
    {
        $products = Product::find($id);
        if ($products->image) {
            $path = 'assets/uploads/products/' . $products->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $products->delete();
        return redirect('/dashboard')->with('status', 'Product deleted Successfully');
    }

    public function MarkAsRead_all (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }

    }


    public function unreadNotifications_count()

    {
        return auth()->user()->unreadNotifications->count();
    }

    public function unreadNotifications()

    {
        foreach (auth()->user()->unreadNotifications as $notification){

             return $notification->data['title'];

        }

    }
}
