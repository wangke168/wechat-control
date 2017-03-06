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



<!--日历-->

<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')}}"/>
@stop


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
                            <span>该演艺秀时间段和已有记录重合,请检查后重新提交. </span>
                        </div>
                    @endif
                    {!! Form::open(['url'=>'control/pushproject?action=save','class'=>'form-horizontal form-bordered',
                    'id'=>'postForm','onkeydown'=>'if(event.keyCode==13){return false;}']) !!}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-1">演艺秀名称</label>

                            <div class="col-md-11"><input type="text" name="id" hidden value="{!! $row->id !!}">
                                <select class="form-control input-medium select2me" name="show_id" >
                                    <option value=""></option>

                                    <?php
                                    $Push = new \App\WeChat\Menu_Select();
                                    $Push->show_list($row->show_id);
                                    ?>


                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">时间</label>

                            <div class="col-md-11">
                                <input name="show_time" value="{!! $row->show_time !!}" data-role="tagsinput"
                                       placeholder="请输入回复关键字"/>
                                <span class="help-inline">每一个时间段用","隔开</span>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">开始日期</label>

                            <div class="col-md-11">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd"
                                     data-date-start-date="+0d">
                                    <input type="text" class="form-control" readonly name="startdate" value="{!! $row->startdate !!}">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">结束日期</label>

                            <div class="col-md-11">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd"
                                     data-date-start-date="+0d">
                                    <input type="text" class="form-control input-inline" name="enddate" readonly value="{!! $row->enddate !!}">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i>
                                    </button>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">黄金周</label>
                            <div class="col-md-11">
                                <label class="checkbox">
                                    <input type="checkbox" name="is_top" value="1" <?php if ($row->is_top == 1) echo 'checked' ?>/>
                                    <span class="help-inline">如果勾选，则在该时间段优先显示。</span>
                                </label>
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
                            <label class="control-label col-md-1">街头秀名称</label>
                            <div class="col-md-11">
                                <input name="se_name"  value="{!! $row->se_name !!}" data-placeholder="街头秀名称"  class="form-control  input-inline input-large">
                                <span class="help-inline">只有街头秀需要输入</span>
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


    <!--下拉框-->
    <script src="{{asset('assets/admin/pages/scripts/components-dropdowns.js')}}"></script>
@stop

@section('init')
    ComponentsPickers.init();
    ComponentsDropdowns.init();

@stop

