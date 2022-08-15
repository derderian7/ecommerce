@extends('layouts.front')
@section('title')
  My Orders
@endsection

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Order view</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tracking no</th>
                                <th>Total price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                
                            
                            <tr>
                                <td> {{$item->tracking_no}}</td>
                                <td> {{$item->price}}</td>
                                <td>{{$item->status == '0' ? 'pending' : 'completed'}}</td>
                                <td> 
                                    <a href="{{ url('view_order/'. $item->id) }}" class="btn btn-primary">view</a>
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
