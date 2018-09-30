@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－文章管理')
@section('page-menu-title', '修改文章')

@section('page-title', '文章管理')

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
                <a href="#">文章管理</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">修改文章</a>
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
                        <i class="fa fa-gift"></i>文章修改
                    </div>

                </div>
                <div class="portlet-body form">

                    {!! Form::open(['url'=>'control/web_articlesave?action=modify','files'=>true,
                    'class'=>'form-horizontal form-bordered','id'=>'postForm','onkeydown'=>'if(event.keyCode==13){return false;}']) !!}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-1">所属栏目</label>

                            <div class="col-md-11">
                                <input type="text" name="id" hidden value="{!! $id !!}">


                                    <select class="form-control input-medium select2me" name="classid"
                                            data-placeholder="选择显示栏目">
                                        <option value=""></option>

                                        <?php
                                        $Article = new \App\WeChat\Article();
                                        $Article->WebMenuCheck($row->cat_id);
                                        ?>

                                    </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">文章标题</label>

                            <div class="col-md-11">
                                <input name="title" class="form-control input-xlarge" value="{!! $row->title !!}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">内容</label>

                            <div class="col-md-11">
                                {{--<textarea class="input-block-level" id="summernote" name="content" rows="18">{!! $row->content !!}</textarea>--}}
                                <script id="container" name="content" type="text/plain"
                                        style="width:900px;height:500px;">
                                    <?php
                                    $content = str_replace("http://weix2.hengdianworld.com/control/editor/attached/image/", "/control/editor/attached/image/", $row->content);
                                    $content = str_replace("/control/editor/attached/image/", "http://weix2.hengdianworld.com/control/editor/attached/image/", $content);
                                    echo $content;
                                    ?>
                                </script>
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

@section('javascript')
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@stop