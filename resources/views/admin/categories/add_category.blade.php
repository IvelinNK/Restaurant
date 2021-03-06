@extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Административен панел" class="tip-bottom"><i class="icon-home"></i> Панел</a> <a href="{{ route('admin.view-categories') }}">Всички категории</a> <a href="{{ route('admin.add-category') }}">Добави категория</a> </div>
      <h1>Категории обяви</h1>
      @if (Session::has('flash_message_error'))
      <div class="alert alert-error alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{!! session('flash_message_error') !!}</strong>
      </div>
      @endif
    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Добави Категория</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{ route('admin.add-category') }}" name="add_category" id="add_category" novalidate="novalidate">
                @csrf
                <div class="control-group">
                  <label class="control-label">Категория</label>
                  <div class="controls">
                    <input type="text" name="category_name" id="category_name">
                  </div>
                </div>
                                <div class="control-group">
                  <label class="control-label">Описание</label>
                  <div class="controls">
                    <textarea name="category_description" id="category_description"></textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">URL</label>
                  <div class="controls">
                    <input type="text" name="category_url" id="category_url">
                  </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Икона</label>
                    <div class="controls">
                        <input type="text" name="category_icon" id="category_icon">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Подредба</label>
                    <div class="controls">
                        <input type="text" name="category_position" id="category_position" placeholder="0 по подразбиране">
                    </div>
                </div>
                <div class="form-actions">
                    <input type="submit" value="Добави категорията" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
