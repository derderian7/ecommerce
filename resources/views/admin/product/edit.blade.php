@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4> Add product</h4> </div>
        <div class="card-body">
            <form action="{{ url('update-product/'.$products->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" >
                            <option value="">{{$products->category->name}}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{$products->name}}" name="name">
                    </div>
                    <div class="col-med-6">
                        <label>Slug</label>
                        <input type="text" class="form-control" value="{{$products->slug}}" name="slug">
                    </div>
                    <div class="col-med-6">
                        <label>small_desc</label>
                        <input type="text" class="form-control" value="{{$products->small_desc}}" name="small_desc">
                    </div>
                    <div class="col-md-12">
                    <textarea name="desc"  rows="3"  class="form-control">{{$products->desc}}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>original_price</label>
                    <input type="number" class="form-control" value="{{$products->original_price}}" name="original_price">
                </div>
                <div class="col-md-6 mb-3">
                    <label>selling_price</label>
                    <input type="number" class="form-control" value="{{$products->selling_price}}" name="selling_price">
                </div>
                <div class="col-md-6 mb-3">
                    <label>tax</label>
                    <input type="number" class="form-control" value="{{$products->tax}}" name="tax">
                </div>
                <div class="col-md-6 mb-3">
                    <label>quantity</label>
                    <input type="number" class="form-control" value="{{$products->qty}}" name="qty">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <input type="checkbox" {{$products->status== '1' ? 'checked': '' }} name="status">
                </div>
                <div class="col-md-6 mb-3">
                    <label>trending</label>
                    <input type="checkbox" {{$products->trending == '1' ? 'checked': '' }} name="trending">
                </div>
                <div class="col-md-6 mb-3">
                    <label>meta_title</label>
                    <input type="text" class="form-control" value="{{$products->meta_title}}" name="meta_title">
                </div>
                <div class="col-md-6 mb-3">
                    <label>meta_desc</label>
                    <input type="text" class="form-control" value="{{$products->meta_desc}}" name="meta_desc" rows="3">
                </div>
                <div class="col-md-6 mb-3">
                    <label>meta_keywords</label>
                    <input type="text" class="form-control" value="{{$products->meta_keywords}}" name="meta_keywords" rows="3">
                </div>
                @if ($products->image)
                <img src="{{asset('assets/uploads/products/'.$products->image)}}" alt="product image">
                @endif

                <div class="col-md-12">
                    <input type="file" name="image" class="form_control">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </div>
            </form>
            </div>        
    </div>
@endsection