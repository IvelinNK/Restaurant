@extends('layouts.adminLayout.admin_design')

@section('content')
<script type="text/javascript">
    function deleteProductImages(url){
        swal({
            title: "Сигурни ли сте?",
            text: "Ще бъде изтрита снимката за този продукт. Операцията е невъзвратима!",
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
      <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Административен панел" class="tip-bottom"><i class="icon-home"></i> Панел</a> <a href="{{ route('admin.view-products') }}">Всички продукти</a> <a href="{{ route('admin.add-images', ['id'=>$product->id]) }}">Добави снимки</a> </div>
        <h1>Снимки</h1>
        @if (Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif
        @if (Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Добави снимки към продукта: <strong>{{ $product->product_name }}</strong></h5>
            </div>
            <div class="widget-content nopadding">
                <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ route('admin.add-images', ['id'=>$product->id]) }}" name="add_images" id="add_images" novalidate="novalidate">
                    @csrf
                    <div class="control-group">
                        <label class="control-label">Продукт:</label>
                        <label class="control-label"><strong>{{ $product->product_name }}</strong> {{ $product->product_code }}</label>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Снимки</label>
                        <div class="controls">
                          <input type="file" name="image[]" id="image" multiple="multiple">
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" value="Добави избраните снимки" class="btn btn-success">
                        <a href="{{ route('admin.view-products') }}" class="btn btn-primary">Обратно в продукти</a>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5>Всички снимки</h5>
            </div>
            <div class="widget-content nopadding">
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>Снимка №</th>
                    <th>Продукт</th>
                    <th>Снимка</th>
                    <th>Управление</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($product->images as $image)
                        <tr class="gradeX">
                            <td>{{ $image->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>
                                @if (!empty($image->image))
                                <a href="#imageModal{{ $image->id }}" data-toggle="modal" title="Покажи снимката в голям размер."><img src="{{ asset('/images/backend_images/products/small/'.$image->image) }}" style="width:50px;"></a>
                                @endif
                            </td>
                            <td class="center">
                                <a onclick="deleteProductImages('{{ route('admin.delete-product-images', ['id' => $image->id]) }}');" class="btn btn-danger btn-mini">Изтрий</a>
                            </td>
                        </tr>
                        <div id="imageModal{{ $image->id }}" class="modal hide" aria-hidden="true" style="display: none;">
                            <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button">×</button>
                                <h3>Снимка на продукта: {{ $product->product_name }}</h3>
                            </div>
                            <div class="modal-body">
                                <p><img src="{{ asset('/images/backend_images/products/large/'.$image->image) }}"></p>
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
