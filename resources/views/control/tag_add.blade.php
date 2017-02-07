@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－标签管理')
@section('page-menu-title', '标签管理')

@section('page-title', '标签管理')

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
                <a href="#">标签管理</a>
            </li>

        </ul>

    </div>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXTRAS PORTLET-->
            @if($type=='add')
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-comments"></i>添加标签
                    </div>

                </div>

                <div class="portlet-body form">

                    {!! Form::open(['url'=>'control/tag?action=save','class'=>'form-horizontal form-bordered',
                    'id'=>'postForm','onkeydown'=>'if(event.keyCode==13){return false;}']) !!}
                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-1">标签名称</label>
                            <div class="col-md-11">
                                <input name="tag_name"   value="" class="form-control  input-inline input-xlarge">
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
                  @elseif($type=='edit')
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-comments"></i>修改标签
                            </div>

                        </div>
                    <div class="portlet-body form">

                        {!! Form::open(['url'=>'control/tag?action=modify','class'=>'form-horizontal form-bordered',
                        'id'=>'postForm','onkeydown'=>'if(event.keyCode==13){return false;}']) !!}
                        <div class="form-body">

                            <div class="form-group">
                                <label class="control-label col-md-1">标签名称</label>
                                <div class="col-md-11">
                                    <input type="text" name="id" hidden value="{!! $id !!}">
                                    <input name="tag_name"   value="{!! $tag_name !!}" class="form-control  input-inline input-xlarge">
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
                @endif
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

