<?php use App\Category; ?>
<?php use App\Product; ?>
@extends('layouts.frontLayout.front_design_index')
@section('content')

<section class="section-padding">
    <div class="container">
       <div class="row">
            <div class="col-12 text-center">
                <div class="heading">
                    <h1 class="section-title"><a href="{{route('index')}}">"При Иво"</a></h1>
                    <h4 class="sub-title">РЕСТОРАНТ</h4>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
            </div>
        </div>
    </div>
</section>
<!-- Categories item End -->
@endsection

@section('scripts')
@endsection
