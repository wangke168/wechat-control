@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－二次回复管理')
@section('page-menu-title', '添加二次回复')

@section('page-title', '二次回复管理')

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
                <a href="#">二次回复</a>
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
                        <i class="fa fa-gift"></i>添加文章
                    </div>

                </div>
                <div class="portlet-body form">

                    {!! Form::open(['url'=>'control/request_se?action=save','files'=>true,
                    'class'=>'form-horizontal form-bordered','id'=>'postForm','onkeydown'=>'if(event.keyCode==13){return false;}']) !!}


                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-1">文章标题</label>

                            <div class="col-md-11">
                                <input name="title" class="form-control input-xlarge" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-1">索引图</label>

                            <div class="col-md-11">

                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 225px; height: 125px;">


                                    </div>
                                    <div>
                       <span class="btn default btn-file">
                           <span class="fileinput-new">
                               选择图片 </span>
                               <span class="fileinput-exists">
                                   更换图片 </span>
                                   <input type="file" name="pic_url">
                                   <input type="text" name="pic_url_session" hidden
                                          value="">
                               </span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                            移除 </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                            <span class="label label-danger">
                                注意! </span>
                                    微信推送的图，如果排序为1的建议900*500，之后的建议200*200.
                                </div>


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">转发朋友圈图</label>

                            <div class="col-md-11">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 100px; height: 100px;">

                                    </div>
                                    <div>
                               <span class="btn default btn-file">
                                   <span class="fileinput-new">
                                       选择图片 </span>
                                       <span class="fileinput-exists">
                                           更换图片 </span>
                                           <input type="file" name="pyq_pic">
                                           <input type="text" name="pyq_pic_session" hidden
                                                  value="">

                                       </span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                            移除 </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-danger">
                                        注意! </span>

                                    选择图片转发朋友圈时的小图，建议尺寸200*200
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">朋友圈标题</label>

                            <div class="col-md-11">
                                <input name="pyq_title" class="form-control  input-inline input-xlarge"
                                       value="">
                                <label class="help-inline">如果不填，则默认转发文章标题</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">内容</label>

                            <div class="col-md-11">
                                {{--<textarea class="input-block-level" id="summernote" name="content" rows="18">{!! $row->content !!}</textarea>--}}
                                <script id="container" name="content" type="text/plain"
                                        style="width:900px;height:500px;">

                                </script>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">链接</label>

                            <div class="col-md-11">
                                <input name="url" class="form-control  input-inline input-xlarge"
                                       value="">
                                <label class="help-inline">除非该内容是直接链接到其他网页，否则不需要填写，文章内容和链接只需要在一处填写</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">开始日期</label>

                            <div class="col-md-11">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd"
                                     data-date-start-date="+0d">
                                    <input type="text" class="form-control" readonly name="startdate"
                                           value="">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button" style="height: 34px"><i
                                                class="fa fa-calendar"></i>
                                    </button>
                                </span>
                                </div>
                                <span class="help-inline">如果不选默认马上生效</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">结束日期</label>

                            <div class="col-md-11">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd"
                                     data-date-start-date="+0d">
                                    <input type="text" class="form-control input-inline" name="enddate" readonly
                                           value="">
                            <span class="input-group-btn">
                                <button class="btn default" type="button" style="height: 34px"><i
                                            class="fa fa-calendar"></i>
                                </button>
                            </span>
                                </div>
                                <span class="help-inline">如果不选默认永久有效</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">面向对象</label>
                            <div class="col-md-11">
                                <select name="target" class="form-control input-medium select2me"
                                        data-placeholder="Select...">
                                    <option value="1">全部</option>
                                    <option value="2">含门票</option>
                                    <option value="3">含酒店</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">排序</label>
                            <div class="col-md-11">
                                <select name="priority" class="form-control input-medium select2me"
                                        data-placeholder="Select...">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">是否在底部显示二维码</label>

                            <div class="col-md-11">

                                <label class="checkbox">

                                    <input type="checkbox" name="show_qr"
                                           value="yes"/>
                                    <span class="help-inline">如果勾选，则在底部显示市场专属二维码。</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">是否属于市场</label>

                            <div class="col-md-4">

                                <input type="hidden" name="marketid" id="select2_sample5"
                                       class="form-control select2"
                                       value="全部显示">
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