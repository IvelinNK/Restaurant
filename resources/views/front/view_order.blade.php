<?php use App\Product; ?>
@extends('layouts.frontLayout.front_design_index')
@section('content')

<!-- Categories item Start -->
<section id="categories" class="section-padding">
    <div class="container">
        @if (Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-12 text-center">
                <div class="heading">
                    <h1 class="section-title">МАСА {{$order->table_id}}</h1>
                    <h4 class="sub-title"><a href="{{ route('table', ['id'=>$order->table_id]) }}" >МЕНЮ</a></h4>
                    <h4 class="sub-title"><a href="{{ route('order', ['id'=>$order->id]) }}" >ТЕКУЩА ПОРЪЧКА</a></h4>
                </div>
            </div>
        </div>
        <div class="row">
            @php
                $allprice = 0;
            @endphp  
            @foreach ($orders_details as $item) 
            @php
                $product = Product::where(['id' => $item->product_id])->first(); 
                $allprice += $product->price * $item->quantity; 
                switch ($item->status) {
                    case 'ordered':
                        $status_txt = "Поръчано";
                        break;
                    case 'delivered':
                        $status_txt = "Доставено";
                        break;                            
                    case 'cooked':
                        $status_txt = "Приготвя се";
                        break;                            
                    default:
                        $status_txt = "Поръчано";
                        break;
                }
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
                        <span class="price-save">{{$item->quantity}} x {{ number_format($product->price, 2, '.', '') }} лв.</span>
                        <a href="{{ route('product', ['id'=>$product->product_code]) }}"><img class="img-fluid" src="{{ $product_image }}" alt=""></a>
                    </figure>
                    <div class="content-wrapper">
                        <div class="feature-content">
                            <h4><a href="/product/{{$product->product_code}}">{{$product->product_name}}</a></h4>
                            <p class="listing-tagline">Състояние: {{$status_txt}}</p>
                            <p class="listing-tagline">Поръчано в: {{($item->created_at)->format('H:i')}} ч.</p>
                            <p class="listing-tagline">Единична цена: {{ number_format($product->price, 2, '.', '') }} лв.</p>
                            <p class="listing-tagline">Количество: {{$item->quantity}}</p>
                            <p class="listing-tagline">Обща цена: {{ number_format($product->price * $item->quantity, 2, '.', '') }} лв.</p>
                        </div>
                        <div class="listing-bottom clearfix">
                            Управление:
                            @if ($item->status == "ordered")
                                <a href="/delete-order-product/{{$item->id}}">Изтрий</a> 
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                <div class="featured-box">
                    <div class="content-wrapper">
                        <div class="feature-content">
                            <p>Обща цена на поръчката: {{ number_format($allprice, 2, '.', '') }} лв.</p>
                        </div>
                        <div class="listing-bottom clearfix">
                            <a href="/order/{{$order->id}}">ОПРЕСНИ</a>
                        </div>
                        <div class="listing-bottom clearfix">
                            <a href="#">ПОВИКАЙ СЕРВИТЬОР</a>
                        </div>
                        <div class="listing-bottom clearfix">
                            <a href="#">ПЛАТИ В БРОЙ</a>
                        </div>
                        <div class="listing-bottom clearfix">
                            <a href="#">ПЛАТИ С КАРТА</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories item End -->
@endsection
