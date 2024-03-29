@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－景区演艺秀推送')
@section('page-menu-title', '添加演艺秀信息')

@section('page-title', '景区演艺秀推送')

@section('css')
        <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/select2.css')}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}"/>


<link href="{{asset('lib/bootstrap-tagsinput.css')}}" rel="stylesheet">

<!--上传-->
<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet">

<!--日历-->

<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')}}"/>
@stop
@include('vendor.ueditor.assets')

@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">景区演艺秀推送</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">添加演艺秀</a>
            </li>
        </ul>

    </div>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXTRAS PORTLET-->
            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i>添加演艺秀
                    </div>

                </div>
                <div class="portlet-body form">
                    @if(Session::has('check'))
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
			                <span>该景区已经存在此演艺秀. </span>
                        </div>
                    @endif
                    {!! Form::open(['url'=>'control/showlist?action=save','class'=>'form-horizontal form-bordered',
                    'id'=>'postForm','onkeydown'=>'if(event.keyCode==13){return false;}']) !!}
                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-1">所在景区</label>

                            <div class="col-md-11"><input type="text" name="id" hidden value="{!! $row->id !!}">
                                <select class="form-control input-medium select2me" name="zone_id">
                                    <?php
                                    $Push = new \App\WeChat\Menu_Select();
                                    $Push->zone_list($row->zone_id);
                                    ?>


                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">演艺秀名称</label>

                            <div class="col-md-11">
                                <input name="show_name" value="{!! $row->show_name !!}"
                                       class="form-control  input-inline input-xlarge">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">节目地点</label>

                            <div class="col-md-11">
                                <input name="show_place" value="{!! $row->show_place !!}"
                                       class="form-control  input-inline input-xlarge">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">地理位置</label>

                            <div class="col-md-11">
                                <input name="show_place_url" value="{!! $row->show_place_url !!}"
                                       class="form-control  input-inline input-xlarge">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">备注</label>

                            <div class="col-md-11">
                                <input name="remark" value="{!! $row->remark !!}"
                                       class="form-control  input-inline input-xlarge">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">排序</label>

                            <div class="col-md-11">
                                <select name="priority" class="form-control input-medium select2me"
                                        data-placeholder="Select...">
                                    <option value="1" <?php if ($row->priority == 1) echo 'selected'?>>1</option>
                                    <option value="2" <?php if ($row->priority == 2) echo 'selected'?>>2</option>
                                    <option value="3" <?php if ($row->priority == 3) echo 'selected'?>>3</option>
                                    <option value="4" <?php if ($row->priority == 4) echo 'selected'?>>4</option>
                                    <option value="5" <?php if ($row->priority == 5) echo 'selected'?>>5</option>
                                    <option value="6" <?php if ($row->priority == 6) echo 'selected'?>>6</option>
                                    <option value="7" <?php if ($row->priority == 7) echo 'selected'?>>7</option>
                                    <option value="8" <?php if ($row->priority == 8) echo 'selected'?>>8</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green"><i class="fa fa-check"></i> 提 交</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>


    @stop

    @section('js')
            <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript"
            src="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->


    <script src="{{asset('lib/bootstrap-tagsinput.min.js')}}"
            type="text/javascript"></script>

    <!--日历-->
    <script type="text/javascript"
            src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/admin/pages/scripts/components-pickers.js')}}"></script>


    <!--上传-->
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"></script>


    <!--下拉框-->
    <script src="{{asset('assets/admin/pages/scripts/components-dropdowns.js')}}"></script>
@stop

@section('init')
    ComponentsPickers.init();
    ComponentsDropdowns.init();

@stop

