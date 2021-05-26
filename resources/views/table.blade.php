<?php use App\Category; ?>
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
            @foreach ($categories as $category)
            @php
            $products = Product::where(['category_id'=>$category->id]);
            $products = $products->where(['status'=>'active']);
            @endphp
            <div class="col-lg-3 col-md-6 col-xs-12">
                <div class="category-box border-1 wow fadeInUpQuick" data-wow-delay="0.3s">
                    <div class="icon">
                        <a href="{{ route('products', ['category_id'=>$category->id]) }}"><i class="{{ $category->icon }}"></i></a>
                    </div>
                    <div class="category-content" style="height:80px;">  
                        <a href="{{ route('products', ['category_id'=>$category->id]) }}"><p>{{ $category->name }}&nbsp;({{ $products->count() }})</p></a>
                    </div> 
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Categories item End -->

<!-- Featured Section Start -->
<section class="featured section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="heading">
                    <h1 class="section-title">ДНЕВНО МЕНЮ</h1>
                </div>
            </div>
            @foreach ($featured_products as $featured_product)
            @php
                if(!empty($featured_product->image)){
                    $featured_image = asset('/images/backend_images/products/medium/'.$featured_product->image);
                }else{
                    $featured_image = asset('/images/backend_images/products/medium/no-image-600.png');
                }
            @endphp
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                <div class="featured-box">
                    <figure>
                        <div class="homes-tag featured"></div>
                        <div class="homes-tag rent"><i class="lni-heart"></i> {{ $featured_product->likes }}</div>
                        <span class="price-save">{{ number_format($featured_product->price, 2, '.', '') }}{{ Config::get('settings.currency') }}</span>
                        <a href="{{ route('product', ['id'=>$featured_product->product_code]) }}"><img class="img-fluid" src="{{ $featured_image }}" alt=""></a>
                    </figure>
                    <div class="content-wrapper">
                        <div class="feature-content">
                            <h4><a href="{{ route('product', ['id'=>$featured_product->product_code]) }}">{{ $featured_product->product_name }}</a></h4>
                            <p class="listing-tagline">{{ $featured_product->product_code }}</p>
                            <div class="meta-tag">
                                <div class="user-name">

                                </div>
                                <div class="listing-category">
                                    @php
                                        $category_ids = [];
                                        $category_ids[] = $featured_product->category_id;
                                    @endphp
                                    <a href="{{ route('products', ['category_id'=>$category_ids]) }}"><i class="{{ Category::where(['id'=>$featured_product->category_id])->first()->icon }}"></i>{{ Category::where(['id'=>$featured_product->category_id])->first()->name }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="listing-bottom clearfix">
                            <i class="lni-map-marker"></i> 
                            <a href="{{ route('product', ['id'=>$featured_product->product_code]) }}" class="float-right">Прегледай Детайлно</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Featured Section End -->

@endsection

@section('scripts')
    <script>
    function changeOther(event, id){
        event.preventDefault();
        $("#div_"+id).toggle();
    }
    </script>
@endsection
