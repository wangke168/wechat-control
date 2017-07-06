@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－回复管理')
@section('page-menu-title', '修改文字回复')

@section('page-title', '回复管理')

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
                <a href="#">回复管理</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">修改文字回复</a>
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
                        <i class="fa fa-gift"></i>添加语音
                    </div>

                </div>
                <div class="portlet-body form">

                    {!! Form::open(['url'=>'control/requesttxt?action=save','class'=>'form-horizontal form-bordered',
                    'id'=>'postForm','onkeydown'=>'if(event.keyCode==13){return false;}']) !!}
                    <input type="text" name="id" hidden value="{!! $row->id !!}">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-1">内容</label>

                            <div class="col-md-4">
                                <textarea name="content"   class="form-control"  rows="3" placeholder="请输入回复内容">{!! $row->content !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">回复关键字</label>


                                <div class="col-md-11">
                                    <input name="keyword"   value="{!! $row->keyword !!}" data-role="tagsinput"
                                           placeholder="请输入回复关键字"/>
                                    <span class="help-inline">每个关键字用","隔开</span>

                                </div>


                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">是否关注显示</label>
                            <div class="col-md-11">
                                <label class="checkbox">
                                    <input type="checkbox" name="focus" value="1" <?php if ($row->focus == 1) echo 'checked' ?>/>
                                    <span class="help-inline">如果勾选，则客人关注时接收到此条信息。</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">展示对象</label>

                            <div class="col-md-3">

                                <input type="hidden" name="eventkey" id="select2_sample5"
                                       class="form-control select2"
                                       value="<?php $usage = new \App\WeChat\Usage(); echo $usage->getArticleShowQrsecne($row->eventkey)?>">
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

