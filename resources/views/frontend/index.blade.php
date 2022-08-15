@extends('layouts.front')
@section('title')
    E-shop
@endsection

@section('content')
@include('layouts.inc.slider')
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2> Products</h2>
            <div class="owl-carousel owl-theme">
                @foreach ($products as $item)   
                <div class="item">
                    <div class="card">
                        <img src="{{ asset('assets/uploads/products/'. $item->image)}}" alt="image">
                        <div class="card-body">
                            <h5> {{$item->name}}</h5>
                            <span class="float-start"> {{$item->original_price}}</span>
                            <span class="float-end"><s> {{$item->selling_price}}</s></span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2> Trending Category</h2>
            <div class="owl-carousel owl-theme">
                @foreach ($category as $item)   
                <div class="item">
                    <a href="{{url('view-category/'.$item->slug)}}">
                    <div class="card">
                        <img src="{{ asset('assets/uploads/category/'. $item->image)}}" alt="image">
                        <div class="card-body">
                            <h5> {{$item->name}}</h5>
                            <p> {{$item->description}}</p>
                        </div>
                    </div>
                </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:2
            }
        }
    })
    </script>
@endsection
