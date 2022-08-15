@extends('layouts.front')
@section('title')
  My Wishlist
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0"> 
            <a href="{{url('/')}}"> Home
            </a>/
            <a href="{{url('wishlist')}}"> Wishlist
            </a>
        </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow ">
        <div class="card-body">
        @if ($wishlist->count() > 0)
            @foreach ($wishlist as $item)
            <div class="row product_data">
                <div class="col-md-2 my-auto">
                     <img src="{{asset('assets/uploads/products/'. $item->products->image)}}" height="70px" width="70px" alt="image here">
                </div>
                <div class="col-md-2 my-auto">
                    <h6> {{$item->products->name}}</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <h6>Price: {{$item->products->selling_price}}</h6>
                </div>
                <div class="col-md-2">
                    <input type="hidden" class="prod_id" value="{{$item->prod_id}}">
                </div>
                    @endforeach
                    <div class="col-md-2 my-auto">
                        <button class="btn btn-success addtoCartbtn"> <i class="fa fa-shopping-cart"> Add to cart </i></button>
                    </div>
                    <div class="col-md-2 my-auto">
                        <button class="btn btn-danger delete-wishlist-item"> <i class="fa fa-trash"> Remove </i></button>
                    </div>
        @else
            <h4>There is no products in your wishlist</h4>
        @endif
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script>
$(document).ready(function () {

$('.addtoCartbtn').click(function (e) {
    e.preventDefault();
    var product_id = $(this).closest('.product_data').find('.prod_id').val();
    var product_qty = '1';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: '{{url("add-to-cart")}}',
        data: {
            'prod_id': product_id,
            'qty_input': product_qty,
        },
        success: function (response) {
            swal(response.status);
        }
    });
});
});

</script>
@endsection
