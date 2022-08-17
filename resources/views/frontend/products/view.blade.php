@extends('layouts.front')
@section('title', $products->name)
@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                Collection/{{ $products->category->name }}/{{ $products->name }}
            </h6>
        </div>
    </div>

    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/uploads/products/' . $products->image) }}" class="w-100" alt="image">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $products->name }}
                            @if ($products->trending == '1')
                                <label style="font-size: 16px"
                                    class="float-end badge bg-danger trending_tag">Trending</label>
                            @endif
                        </h2>
                        <hr>
                        <label class="me-3">Original price:<s> Rs {{ $products->original_price }}</s></label>
                        <label class="fw-bold">Selling price: Rs {{ $products->selling_price }}</label>
                        <p class="mt-3">
                            {!! $products->small_desc !!}
                        </p>
                        <hr>
                        @if ($products->qty > 0)
                            <label class="badge bg-success"> In stock</label>
                        @else
                            <label class="badge bg-danger"> Out of stock</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                <label for="Quantity"> Quantity</label>
                                <div class="input-group text-center mb-3 " style="width: 110px">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity " class="form-control qty_input text-center"
                                        value="1" />
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <br>
                                @if ($products->qty > 0)
                                    <button type="button" class="btn btn-success me-3 addtoCartbtn float-start"> Add to
                                        cart</button>
                                @endif
                                <button type="button" class="btn btn-success me-3  addtoWishlist float start"> Add to
                                    wishlist</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <h3>Description</h3>
                <p class="mt-3">
                    {!! $products->desc !!}
                </p>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('.addtoCartbtn').click(function(e) {
                e.preventDefault();
                var product_id = $(this).closest('.product_data').find('.prod_id').val();
                var product_qty = $(this).closest('.product_data').find('.qty_input').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '{{ url('add-to-cart') }}',
                    data: {
                        'prod_id': product_id,
                        'qty_input': product_qty,
                    },
                    success: function(response) {
                        swal(response.status);
                    }
                });
            });
            $('.addtoWishlist').click(function(e) {
                e.preventDefault();
                var product_id = $(this).closest('.product_data').find('.prod_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '{{ url('add-to-wishlist') }}',
                    data: {
                        'prod_id': product_id,
                    },
                    success: function(response) {
                        swal(response.status);
                    }
                });
            });
        });
    </script>
@endsection
