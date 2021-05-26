<?php use App\Product; ?>

@extends('layouts.adminLayout.admin_design')

@section('content')
<script type="text/javascript">
    function deleteOrder(url){
        swal({
            title: "Сигурни ли сте?",
            text: "Ще бъде изтрита поръчката. Операцията е невъзвратима!",
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
    function closeOrder(url){
        swal({
            title: "Сигурни ли сте?",
            text: "Ще бъде приключена поръчката!",
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
        <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Административен панел"
                class="tip-bottom"><i class="icon-home"></i> Панел</a> <a href="{{ route('admin.view-orders') }}"
                class="current">Всички поръчки</a></div>
        <h1>Поръчки</h1>
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
                        <h5>Всички поръчки</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Поръчки №</th>
                                    <th>Дата</th>
                                    <th>Маса</th>
                                    <th>Състояние</th>
                                    <th>Управление</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr class="gradeX">
                                    <td>{{ $order->id }}</td>
                                    <td>{{ date("d.m.Y H:i:s", strtotime($order->created_at)) }}</td>
                                    <td>{{ $order->table_id }}</td>
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
                                    <td>{{ $status_txt }}</td>
                                    <td class="center">
                                        <a onclick="closeOrder('{{ route('admin.close-order', ['id' => $order->id]) }}');" class="btn btn-success btn-mini">Приключи</a>
                                        <a href="{{ route('admin.edit-order', ['id' => $order->id]) }}" class="btn btn-primary btn-mini">Детайли</a>
                                        <a onclick="deleteOrder('{{ route('admin.delete-order', ['id' => $order->id]) }}');" class="btn btn-danger btn-mini">Изтрий</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
