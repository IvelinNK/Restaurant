@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Административен панел" class="tip-bottom"><i class="icon-home"></i> Панел</a>            <a href="{{ route('admin.edit-landing-page') }}">Редактирай Начална страница</a> </div>
        <h1>Редакция на Начална страница</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <form class="form-horizontal" method="post" action="{{ route('admin.edit-landing-page') }}" name="edit_landing_page" id="edit_landing_page"
                    novalidate="novalidate">
                    @csrf
                    <div class="widget-box">
                        <div class="widget-title">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#footer_tab">Футър част</a></li>
                            </ul>
                        </div>
                        <div class="widget-content tab-content">
                            <div id="footer_tab" class="tab-pane active">
                                <div class="control-group">
                                    <label class="control-label">Футър права</label>
                                    <div class="controls">
                                        <input type="text" name="footer_rites" id="footer_rites" maxlength="256" style="width:800px;" value="{{ $property->footer_rites }}">
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
