<?php use App\Http\Controllers\CategoryController;?>

@extends('layouts.adminLayout.admin_design')

@section('content')
<script type="text/javascript">
    function deleteCategory(url){
        swal({
            title: "Сигурни ли сте?",
            text: "Ще бъде изтрита категорията. Операцията е невъзвратима!",
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
      <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Административен панел" class="tip-bottom"><i class="icon-home"></i> Панел</a> <a href="{{ route('admin.view-categories') }}" class="current">Всички категории</a> <a href="{{ route('admin.add-category') }}">Добави категория</a></div>
      <h1>Категории продукти</h1>
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
              <h5>Всички категории</h5>
            </div>
            <div class="widget-content nopadding">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>Категория №</th>
                    <th>Категория</th>
                    <th>URL</th>
                    <th>Подредба</th>
                    <th>Управление</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="gradeX">
                            <td>{{ $category->id }}</td>
                            <td><strong>{{ $category->name }}</strong></td>
                            <td>{{ $category->url }}</td>
                            <td>{{ $category->position }}</td>
                            <td class="center"><a href="{{ route('admin.edit-category', ['id' => $category->id]) }}" class="btn btn-primary btn-mini">Редактирай</a> <a onclick="deleteCategory('{{ route('admin.delete-category', ['id' => $category->id]) }}');" class="btn btn-danger btn-mini">Изтрий</a></td>
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
