<?php use App\Category; ?>
@extends('layouts.frontLayout.front_design')
@section('content')

<!-- Main container Start -->
<div class="main-container section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="heading">
                    <h1 class="section-title">МАСА {{$order->table_id}}</h1>
                    <h4 class="sub-title"><a href="{{ route('table', ['id'=>$order->table_id]) }}" >МЕНЮ</a></h4>
                    <h4 class="sub-title"><a href="{{ route('order', ['id'=>$order->id]) }}" >ТЕКУЩА ПОРЪЧКА</a></h4>
                    <h4 class="sub-title">{{$category_name}}</h4>
                </div>
            </div>

            @foreach ($products as $product)
            @php
                if(!empty($product->image)){
                    $product_image = asset('/images/backend_images/products/medium/'.$product->image);
                }else{
                    $product_image = asset('/images/backend_images/products/medium/no-image-600.png');
                }
            @endphp
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                <div class="featured-box">
                    <figure>
                        <div class="homes-tag featured"></div>
                        <span class="price-save">{{ number_format($product->price, 2, '.', '') }} лв.</span>
                        <a href="{{ route('product', ['id'=>$product->product_code]) }}"><img class="img-fluid" src="{{ $product_image }}" alt=""></a>
                    </figure>
                    <div class="content-wrapper">
                        <div class="feature-content">
                            <h4><a href="{{ route('product', ['id'=>$product->product_code]) }}">{{ $product->product_name }}</a></h4>
                            <div class="meta-tag">
                                <div class="listing-category">
                                    <a href="{{ route('products', ['category_id'=>$product->category_id]) }}"><i class="{{ Category::where(['id'=>$product->category_id])->first()->icon }}"></i>{{ Category::where(['id'=>$product->category_id])->first()->name }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="listing-bottom clearfix">
                            <a href="{{ route('product', ['id'=>$product->product_code]) }}" class="float-right">Прегледай Детайлно</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div style="padding-bottom:20px;"></div>
        </div>
    </div>
</div>
<!-- Main container End -->
@endsection
