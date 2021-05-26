<?php use App\ProductsImage; ?>
<?php use App\Category; ?>
<?php use App\Http\Controllers\ProductController; ?>

@extends('layouts.frontLayout.front_design')
@section('content')
@php
if(!empty($product->image)){
    $image = asset('/images/backend_images/products/large/'.$product->image);
}else{
    $image = asset('/images/backend_images/products/large/no-image-1200.png');
}
@endphp
<div class="col-12 text-center">
    <div class="heading">
        <h1 class="section-title">МАСА {{$order->table_id}}</h1>
        <h4 class="sub-title"><a href="{{ route('table', ['id'=>$order->table_id]) }}" >МЕНЮ</a></h4>
        <h4 class="sub-title"><a href="{{ route('order', ['id'=>$order->id]) }}" >ТЕКУЩА ПОРЪЧКА</a></h4>
    </div>
</div>
<!-- Ads Details Start -->
<div class="section-padding">
    <div class="container">
        <!-- Product Info Start -->
        <div class="product-info row">
            <div class="col-lg-8 col-md-12 col-xs-12">
                <div class="ads-details-wrapper">
                    <div id="owl-demo" class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="product-img">
                                <img class="img-fluid" src="{{ $image }}" alt="">
                            </div>
                            <span class="price">{{ number_format($product->price, 2, '.', '') }} лв.</span>
                        </div>
                        @foreach (ProductsImage::where(['product_id'=>$product->id])->get() as $item)
                        <div class="item">
                            <div class="product-img">
                                <img class="img-fluid" src="{{ asset('/images/backend_images/products/large/'.$item->image) }}" alt="">
                            </div>
                            <span class="price">{{ number_format($product->price, 2, '.', '') }} лв.</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="details-box">
                    <div class="ads-details-info">
                        <h2>{{ $product->product_name }}</h2>
                        <p class="mb-4">{!! nl2br(e($product->description)) !!}</p>
                        <hr />
                        <h4 class="title-small mb-3">Цена:  {{ number_format($product->price, 2, '.', '') }} лв.</h4>
                            @php
                                $category_ids = [];
                                $category_ids[] = $product->category_id;
                            @endphp
                    </div>
                    <div class="tag-bottom">
                        <div class="float-left">
                            <ul class="advertisement">
                                <li>
                                    <p><strong><i class="lni-folder"></i> Категория:</strong> <a href="{{ route('products', ['category_id'=>$category_ids]) }}" title="Покажи всички обяви от тази категория">{{ Category::where(['id'=>$product->category_id])->first()->name }}</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12">
                <!--Sidebar-->
                <aside class="details-sidebar">
                    <div class="widget">
                        <div class="agent-inner">
                            <div style="text-align:center;padding-top:20px;padding-bottom:20px;">
                                <p style="font-size:16px;color:black;">
                                Искаш да поръчаш?
                                </p>
                            </div>
                            @if (Session::has('flash_message_success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{!! session('flash_message_success') !!}</strong>
                                </div>
                            @endif
                            <form enctype="multipart/form-data" action="{{ route('add-order-product') }}" method="post" name="order_products" id="order_products" novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <label for="quantity">Количество</label>
                                <input type="number" name="quantity" min="1" step="1" class="form-controll" style="width:100%; margin-bottom:10px;" value="1" />
                                <label for="info">Коментар</label>
                                <textarea type="text" name="info" class="form-controll" rows="3" style="width:100%;" placeholder="Пример: Без майонеза, с добавка царевица ..."></textarea>
                                <button class="btn btn-common fullwidth mt-4" type="submit">Поръчай</button>
                            </form>
                        </div>
                    </div>
                </aside>
                <!--End sidebar-->
            </div>
        </div>
        <!-- Product Info End -->

    </div>
</div>
<!-- Ads Details End -->
@endsection

@section('scripts')
@endsection
