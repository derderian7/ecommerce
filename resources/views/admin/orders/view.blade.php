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
                                    <th> Quantity</th>
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
                        <h4 class="px-2">Grand total :<span class="float-right">{{ $orders->price }} </span></h4>
                        <div class="mt-5 px-2">
                            <label for="">Order status</label>
                            <form action="{{ url('update_order/' . $orders->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <select class="form-select" name="order_status">
                                    <option {{ $orders->status == '0' ? 'selected' : '' }}value="0">Pending</option>
                                    <option {{ $orders->status == '1' ? 'selected' : '' }} value="1">Completed</option>
                                </select>
                                <button class="btn btn-primary mt-3 mb-1 float-right" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
