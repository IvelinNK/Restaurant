@extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Административен панел" class="tip-bottom"><i class="icon-home"></i> Панел</a> <a href="{{ route('admin.settings') }}">Настройки</a> </div>
        <h1>Настройки</h1>
        @if (Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block">
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
        <div class="row-fluid">
          <div class="span12">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                <h5>Смяна на паролата за Администратора</h5>
              </div>
              <div class="widget-content nopadding">
                <form class="form-horizontal" method="post" action="{{ route('admin.update-pwd') }}" name="password_validate" id="password_validate" novalidate="novalidate">
                    @csrf
                    <div class="control-group">
                    <label class="control-label">Текуща Парола</label>
                    <div class="controls">
                      <input type="password" name="current_pwd" id="current_pwd" />
                      <span id="chkPwd"></span>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Нова Парола</label>
                    <div class="controls">
                      <input type="password" name="new_pwd" id="new_pwd" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Повтори Паролата</label>
                    <div class="controls">
                      <input type="password" name="confirm_pwd" id="confirm_pwd" />
                    </div>
                  </div>
                  <div class="form-actions">
                    <input type="submit" value="Запиши промените" class="btn btn-success">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
