<?php use App\Product; ?>
<?php use App\Category; ?>
<?php use App\Order; ?>
@extends('layouts.adminLayout.admin_design')
@section('content')
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="{{ route('admin.dashboard') }}" title="Панел управление" class="tip-bottom"><i class="icon-home"></i> Панел управление</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="quick-actions_homepage">
            <ul class="quick-actions">
                <li class="bg_lb"><a href="{{ route('admin.dashboard') }}"><i class="icon-dashboard"></i>Панел управление</a></li>
                <li class="bg_lg"><a href="{{ route('admin.view-products') }}"><i class="icon-th"></i><span class="label label-success">{{ Product::count() }}</span> Продукти</a>                    </li>
                <li class="bg_lo"><a href="{{ route('admin.view-categories') }}"><i class="icon-th"></i><span class="label label-success">{{ Category::count() }}</span> Категории</a></li>
                <li class="bg_lb"><a href="{{ route('admin.view-orders') }}"><i class="icon-th"></i><span class="label label-success">{{ Order::count() }}</span> Поръчки</a></li>
                <li class="bg_lg"><a href="{{ route('admin.edit-landing-page') }}"><i class="icon-pencil"></i> Настройки</a></li>
            </ul>
        </div>
        <!--End-Action boxes-->

        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="icon-chevron-down"></i></span>
                    <h5>Последни поръчки</h5>
                </div>
                <div class="widget-content nopadding collapse in" id="collapseG2">
                    <ul class="recent-posts">
                        @php
                            $orders = Order::all()->take(6);
                        @endphp
                        @foreach ($orders as $order)
                        <li>
                            <div class="user-thumb"> <img width="40" height="40" alt="User" src="{{ asset('images/backend_images/demo/av1.jpg') }}">                                </div>
                            <div class="article-post"> <span class="user-info"> Дата: {{ date("d.m.Y H:i:s", strtotime($order->created_at)) }} </span>
                                <p>Маса: {!! $order->table_id !!}</p>
                                @php
                                    switch ($order->status) {
                                        case 'work':
                                            $status_txt = "Текуща";
                                            break;
                                        case 'closed':
                                            $status_txt = "Приключена";
                                            break;
                                        default:
                                            $status_txt = "Приключена";
                                            break;
                                    }
                                @endphp
                                <p>Състояние: {{$status_txt}}</p>
                            </div>
                        </li>
                        @endforeach
                        <li>
                            <a href="{{ route('admin.view-orders') }}" class="btn btn-warning btn-mini">Виж всички</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end-main-container-part-->
@endsection
