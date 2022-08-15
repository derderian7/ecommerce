@extends('layouts.admin')
@section('title')
    <h4>Orders</h4>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white"> Orders History
                        <a href="{{url('orders')}}" class="btn btn-warning float-right">New Orders </a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order date</th>
                                <th>Tracking no</th>
                                <th>Total price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                
                            
                            <tr>
                                <td>{{date('d-m-y',strtotime($item->created_at))}}</td>
                                <td> {{$item->tracking_no}}</td>
                                <td> {{$item->price}}</td>
                                <td>{{$item->status == '0' ? 'pending' : 'completed'}}</td>
                                <td> 
                                    <a href="{{ url('admin/view_order/'. $item->id) }}" class="btn btn-primary">view</a>
                                <td>
                                    @endforeach
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection