@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Административен панел" class="tip-bottom"><i class="icon-home"></i> Панел</a><a href="{{ route('admin.edit-maintenance-page') }}">Режим поддръжка</a> </div>
        <h1>Режим поддръжка</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <form class="form-horizontal" method="post" action="{{ route('admin.edit-maintenance-page') }}" name="edit_maintenance_page" id="edit-maintenance-page" novalidate="novalidate">
                    @csrf
                    <div class="widget-box">
                        <div class="widget-title">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#maintenance_tab">Режим поддръжка</a></li>
                            </ul>
                        </div>
                        <div class="widget-content tab-content">
                            <div id="maintenance_tab" class="tab-pane active">
                                <div class="control-group">
                                    <label class="control-label">Статус</label>
                                    <div class="controls">
                                        <select name="maintenance_status" id="maintenance_status" style="width:314px;">
                                            <option value=0 @if ($property->maintenance_status == 0) selected @endif>Не</option>
                                            <option value=1 @if ($property->maintenance_status == 1) selected @endif>Да</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">IP адреси</label>
                                    <div class="controls">
                                        <input type="text" name="maintenance_ip" id="maintenance_ip" value="{{ $property->maintenance_ip }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" value="Запиши промените" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection