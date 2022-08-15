@extends('layouts.front')
@section('title')
  My Cart
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0"> 
            <a href="{{url('/')}}"> Home
            </a>/
            <a href="{{url('cart')}}"> Cart
            </a>
        </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow">
        @if ($cartitems->count() > 0)   
        <div class="card-body">
            @php
             $total=0;   
            @endphp
            @foreach ($cartitems as $item)
            <div class="row product_data">
                <div class="col-md-2">
                     <img src="{{asset('assets/uploads/products/'. $item->products->image)}}" height="70px" width="70px" alt="image here">
                </div>
                <div class="col-md-5">
                    <h6> {{$item->products->name}}</h6>
                </div>
                <div class="col-md-3">
                    <input type="hidden" class="prod_id" value="{{$item->prod_id}}">
                    @if ($item->products->qty >= $item->prod_qty)
                    <label for="Quantity"> Quantity</label>
                    <div class="input-group text-center mb-3 " style="width: 110px">
                        <button class="input-group-text change_qty decrement-btn">-</button>
                        <input type="text" name="quantity " class="form-control qty_input text-center" value="{{$item->prod_qty}}"/>
                        <button class="input-group-text change_qty increment-btn">+</button>
                    </div>
                    @php
                    $total+=$item->products->selling_price*$item->prod_qty;   
                   @endphp
                   @else <h6>Out of stock</h6>
                    @endif
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger delete-cart-item">Remove</button>
                </div>
            </div>
            @php
            $total+=$item->products->selling_price*$item->prod_qty;   
           @endphp
            @endforeach
        </div>
        <div class="card-footer">
            <h6>
                Total Price: {{$total}}
                <a href="{{url('checkout')}}" class="btn btn-outline-success float-end"> Checkout</a>
                    
                @else
                <div class="card-body text-center">
                    <h2> Your <i class="fa fa-shopping-cart"></i> Cart is empty</h2>
                </div>
            </h6>
        </div>
        @endif
    </div>
</div>

@endsection