@extends('layouts.front')
@section('title')
    Checkout
@endsection

@section('content')
<div class="container mt-3">
    <form action="{{url('place_order')}}" method="POST">
        {{ csrf_field() }}
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h6>Basic Details</h6>
                    <hr> 
                    <div class="row checkout-form">
                        <div class="col-md-6">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" name="firstname" value="{{Auth::user()->name }}" placeholder="enter your first name">
                        </div>
                        <div class="col-md-6">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{Auth::user()->last_name }}"  placeholder="enter your last name">
                        </div><div class="col-md-6 mt-3">
                            <label for="emal">Email</label>
                            <input type="text" class="form-control" name="email" value="{{Auth::user()->email }}"  placeholder="enter your email">
                        </div><div class="col-md-6 mt-3">
                            <label for="firstname">Phone number</label>
                            <input type="text" class="form-control" name="phonenumber" value="{{Auth::user()->phone }}"  placeholder="enter your phone number">
                        </div><div class="col-md-6">
                            <label for="firstname">Address</label>
                            <input type="text" class="form-control" name="address" value="{{Auth::user()->address }}"  placeholder="enter your address">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h6>
                        Order details
                    </h6>
                    <hr>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartitems as $item)
                                <tr>
                                    <td>{{$item->products->name}}</td>
                                    <td>{{$item->prod_qty}}</td>
                                    <td>{{$item->products->selling_price}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <button type="submit" class="btn btn-primary float-end">Place order</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection