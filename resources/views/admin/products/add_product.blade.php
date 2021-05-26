<?php use App\Category; ?>
@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Административен панел"
                class="tip-bottom"><i class="icon-home"></i> Панел</a> <a
                href="{{ route('admin.view-products') }}">Всички продукти</a> <a
                href="{{ route('admin.add-product') }}">Добави продукт</a> </div>
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
            <form enctype="multipart/form-data" class="form-horizontal" method="post"
                action="{{ route('admin.add-product') }}" name="add_product" id="add_product" novalidate="novalidate">
                @csrf
                <input type="hidden" id="product_id" value="0">
                <div class="span5">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Информация за продукта</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <label class="control-label" style="color:red;">Категория *</label>
                                <div class="controls">
                                    <select name="category_id" id="category_id" style="width:314px;">
                                        <option value="0" selected>Избери категория</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" style="color:red;">Продукт *</label>
                                <div class="controls">
                                    <input type="text" name="product_name" id="product_name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" style="color:red;">Код *</label>
                                <div class="controls">
                                    <input type="text" name="product_code" id="product_code">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" style="color:red;">Цена *</label>
                                <div class="controls">
                                    <input type="number" name="price" id="price">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Заглавна снимка</label>
                                <div class="controls">
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Добави продукт" class="btn btn-success">
                                <a href="{{ route('admin.view-products') }}" class="btn btn-primary">Обратно в
                                    продукти</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Описание на продукта</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <div style="padding:10px;">
                                <textarea name="description" id="description" class="span12" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Системни настройки</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <label class="control-label">Статус</label>
                                <div class="controls">
                                    <select name="status" id="status" style="width:314px;">
                                        <option value='active' selected>Активен</option>
                                        <option value='notactive'>Неактивен</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <label class="control-label">Специален продукт</label>
                                <div class="controls">
                                    <select name="featured" id="featured" style="width:314px;">
                                        <option value=0>Не</option>
                                        <option value=1>Да</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@stop