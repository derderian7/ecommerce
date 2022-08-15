@extends('layouts.front')
@section('title')
    My Orders
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">My Orders</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <label for="">First name</label>
                                <div class="border">{{ $orders->firstname }}</div>
                            </div>

                            <label for="">Email</label>
                            <div class="border">{{ $orders->email }}</div>
                        </div>
                        <label for="">Address</label>
                        <div class="border">{{ $orders->address }}</div>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders->orderitems as $item)
                                    <tr>
                                        <td>{{ $item->products->name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h4 class="px-2">Grand total :<span class="float-end">{{ $orders->price }} </span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
