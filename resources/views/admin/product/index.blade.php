@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>product page</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>category</th>
                        <th>Name</th>
                        <th>selling price</th>
                        <th>image</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody> @foreach ($products as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->selling_price}}</td>
                        <td><img src="{{asset('assets/uploads/products/'.$item->image)}}" class="cate-image" alt="image here"></td>
                        <td><a href="{{ url('edit-prod/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ url('delete-product/'.$item->id)}}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            </div>        
    </div>
@endsection