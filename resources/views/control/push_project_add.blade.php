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

                    {!! Form::open(['url'=>'control/pushproject?action=save','class'=>'form-horizontal form-bordered',
                    'id'=>'postForm','onkeydown'=>'if(event.keyCode==13){return false;}']) !!}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-1">选择演艺秀</label>

                            <div class="col-md-11">
                                <select class="form-control input-medium select2me" name="project_id"
                                        data-placeholder="选择演艺秀">
                                    <option value=""></option>

                                    <?php
                                    $rows = DB::table('tour_zone_class')
                                            ->get();
                                    foreach ($rows as $row) {
                                        echo "<optgroup label=\"" . $row->zone_name . "\">";
                                        $result_options = DB::table('tour_project_class')
                                                ->whereRaw('id not in (select project_id from tour_project_info)')
                                                ->where('zone_classid', $row->id)
                                                ->get();
                                        foreach ($result_options as $result_option) {
                                            echo "<option value=\"" . $result_option->id . "\">" . $result_option->project_name . "</option>";
                                        }

                                        echo "</optgroup>";
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">时间</label>

                            <div class="col-md-11">
                                <input name="show_time"   value="" data-role="tagsinput"
                                       placeholder="请输入回复关键字"/>
                                <span class="help-inline">每一个时间段用回车隔开</span>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">演艺秀地点</label>
                            <div class="col-md-11">
                                <input name="location_name"   value="" class="form-control  input-inline input-xlarge">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">演艺秀地理位置</label>
                            <div class="col-md-11">
                                <input name="location_url"  value="" class="form-control  input-inline input-xlarge">
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

