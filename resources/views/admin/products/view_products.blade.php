<?php use App\Http\Controllers\CategoryController; ?>
@extends('layouts.adminLayout.admin_design')

@section('content')
<script type="text/javascript">
    function deleteProduct(url){
        swal({
            title: "Сигурни ли сте?",
            text: "Ще бъде изтрит записът за този продукт. Операцията е невъзвратима!",
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
      <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Административен панел" class="tip-bottom"><i class="icon-home"></i> Панел</a> <a href="{{ route('admin.view-products') }}" class="current">Всички продукти</a> <a href="{{ route('admin.add-product') }}">Добави продукт</a></div>
      <h1>Продукти</h1>
      @if (Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
        @endif
    </div>
    <div class="container-fluid">
      <hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5>Всички продукти</h5>
            </div>
            <div class="widget-content nopadding">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>Продукт №</th>
                    <th>Код</th>
                    <th>Продукт</th>
                    <th>Категория</th>
                    <th>Цена</th>
                    <th>Снимка</th>
                    <th>Състояние</th>
                    <th>Управление</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="gradeX">
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_code }}</td>
                            <td>{{ $product->product_name }}</td>
                            @if (CategoryController::getCategoryById($product->category_id) != null)
                            <td>{{ CategoryController::getCategoryById($product->category_id)->name }}</td>                                
                            @else
                            <td></td>                                
                            @endif
                            <td>{{ $product->price }}</td>
                            <td>
                                @if (!empty($product->image))
                                <a href="#imageModal{{ $product->id }}" data-toggle="modal" title="Покажи снимката в голям размер."><img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" style="width:50px;"></a>
                                @endif
                            </td>
                            @php
                            switch ($product->status) {
                                case 'active':
                                    $status = 'Активен';
                                    break;
                                case 'notactive':
                                    $status = 'Неактивен';
                                    break;
                                }
                            @endphp
                            <td>{{ $status }}</td>
                            <td class="center">
                                <a href="#modalPregled{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini">Преглед</a>
                                <a href="{{ route('admin.edit-product', ['id' => $product->id]) }}" class="btn btn-primary btn-mini">Редактирай</a>
                                <a href="{{ route('admin.add-images', ['id' => $product->id]) }}" class="btn btn-info btn-mini">Снимки</a>
                                <a onclick="deleteProduct('{{ route('admin.delete-product', ['id' => $product->id]) }}');" class="btn btn-danger btn-mini">Изтрий</a>
                            </td>
                        </tr>
                        <div id="modalPregled{{ $product->id }}" class="modal hide">
                            <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button">×</button>
                                <h3>{{ $product->product_name }} - Подробен преглед</h3>
                            </div>
                            <div class="modal-body">
                                <div class="controls controls-row">
                                    <div class="span6 m-wrap">
                                        <p><strong>Продукт №:</strong> {{ $product->id }}</p>
                                        <p><strong>Код:</strong> {{ $product->product_code }}</p>
                                        <p><strong>Наименование:</strong> {{ $product->product_name }}</p>
                                        @if (CategoryController::getCategoryById($product->category_id) != null)
                                        <p><strong>Категория:</strong> {{ CategoryController::getCategoryById($product->category_id)->name }}</p>                                            
                                        @else
                                        <p><strong>Категория:</strong></p>                                            
                                        @endif
                                        <p><strong>Количество:</strong> {{ $product->quantity }}</p>
                                        <p><strong>Цена:</strong> {{ $product->price }}</p>
                                    </div>
                                </div>
                                <div class="controls controls-row">
                                    <div class="span12 m-wrap">
                                        <p><strong>Описание:</strong> {!! $product->description !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer"><a data-dismiss="modal" class="btn btn-inverse" href="#">Затвори</a> </div>
                        </div>
                        <div id="imageModal{{ $product->id }}" class="modal hide" aria-hidden="true" style="display: none;">
                            <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button">×</button>
                                <h3>Снимка на продукта: {{ $product->product_name }}</h3>
                            </div>
                            <div class="modal-body">
                                <p><img src="{{ asset('/images/backend_images/products/large/'.$product->image) }}"></p>
                            </div>
                            <div class="modal-footer"><a data-dismiss="modal" class="btn btn-inverse" href="#">Затвори</a> </div>
                        </div>
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
