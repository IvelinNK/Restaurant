<?php use App\Product; ?>
@extends('layouts.adminLayout.admin_design')
@section('content')
<script type="text/javascript">
    function changeCooked(url){
        swal({
            title: "Сигурни ли сте?",
            text: "Ще бъде променено състоянието на продукта на Поръчан!",
            icon: "warning",
            buttons: ["Отказ!", "Съгласен съм!"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = url;
        } else {
            return false;
        }
        });
        return false;
    };
    function changeDelivered(url){
        swal({
            title: "Сигурни ли сте?",
            text: "Ще бъде променено състоянието на продукта на Доставен!",
            icon: "warning",
            buttons: ["Отказ!", "Съгласен съм!"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = url;
        } else {
            return false;
        }
        });
        return false;
    };
    function deleteProduct(url){
        swal({
            title: "Сигурни ли сте?",
            text: "Ще бъде изтрит продукта!",
            icon: "warning",
            buttons: ["Отказ!", "Съгласен съм!"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = url;
        } else {
            return false;
        }
        });
        return false;
    };
</script>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="{{ route('admin.dashboard') }}" title="Административен панел" class="tip-bottom"><i class="icon-home"></i> Панел</a>            
            <a href="{{ route('admin.view-orders') }}">Поръчки</a> 
            <a href="{{ route('admin.edit-order', ['id'=>$order->id]) }}">Детайли поръчка</a>            
        </div>
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
        <h1>Детайли на поръчка, Номер: {{$order->id}}, Маса: {{$order->table_id}}, Създадена на: {{ date("d.m.Y H:i:s", strtotime($order->created_at)) }}, Състояние: {{$status_txt}}</h1>
        @if (Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_success') !!}</strong>
        </div>
        @endif
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Продукти</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Продукт №</th>
                                    <th>Добавен на</th>
                                    <th>Продукт</th>
                                    <th>Цена</th>
                                    <th>Бр.</th>
                                    <th>Общо цена</th>
                                    <th>Състояние</th>
                                    <th>Управление</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $price_all = 0;
                                @endphp
                                @foreach ($orders_details as $item)
                                <tr class="gradeX">
                                    <td>{{$item->product_id}}</td>
                                    <td>{{ date("d.m.Y H:i:s", strtotime($item->created_at)) }}</td>
                                    @php
                                        $product = Product::where(['id'=>$item->product_id])->first();
                                    @endphp
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$product->price * $item->quantity}}</td>
                                    @php
                                    $price_all += $product->price * $item->quantity;
                                    switch ($item->status) {
                                        case 'ordered':
                                            $product_status_txt = "Поръчан";
                                            break;
                                        case 'delivered':
                                            $product_status_txt = "Доставен";
                                            break;
                                        case 'cooked':
                                            $product_status_txt = "Приготвя се";
                                            break;
                                        default:
                                            $product_status_txt = "Поръчан";
                                            break;
                                    }
                                    @endphp
                                    <td>{{$product_status_txt}}</td>
                                    <td class="center">
                                        <a onclick="changeCooked('{{ route('admin.change-product-cooked', ['id' => $item->id]) }}');" class="btn btn-success btn-mini">Приготвя се</a>
                                        <a onclick="changeDelivered('{{ route('admin.change-product-delivered', ['id' => $item->id]) }}');" class="btn btn-primary btn-mini">Доставен</a>
                                        <a onclick="deleteProduct('{{ route('admin.delete-product-order', ['id' => $item->id]) }}');" class="btn btn-danger btn-mini">Изтрий</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Обща цена на поръчката: {{$price_all}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
