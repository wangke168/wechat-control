@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－文章管理')
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

                {!! Form::open(['url'=>'control/articlesave?action=modify','files'=>true,
                'class'=>'form-horizontal form-bordered','id'=>'postForm','onkeydown'=>'if(event.keyCode==13){return false;}']) !!}
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-1">所属栏目</label>

                        <div class="col-md-11">
                            <input type="text" name="id" hidden value="{!! $id !!}">

                            @if(Session::get('eventkey')=='all')
                            <select class="form-control input-medium select2me" name="classid"
                            data-placeholder="选择显示栏目">
                            <option value=""></option>

                            <?php
                            $Article = new \App\WeChat\Article();
                            $Article->menuCheck($row->classid);
                            ?>

                        </select>
                        @else
                        <select class="form-control input-medium select2me" name="classid" readonly="readonly"
                        data-placeholder="选择显示栏目">
                        <option value="2">最新活动</option>

                    </select>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1">文章标题</label>

                <div class="col-md-11">
                    <input name="title" class="form-control input-xlarge" value="{!! $row->title !!}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1">关键字</label>

                <div class="col-md-11">
                    <input name="keyword" type="text" data-role="tagsinput"
                    value="<?php echo str_replace('，', ',', $row->keyword); ?>">
                    <span class="help-inline">每一个关键字用逗号隔开</span>
                </div>

            </div>
            <div class="form-group">
                <label class="control-label col-md-1">索引图</label>

                <div class="col-md-11">

                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                        style="width: 225px; height: 125px;">
                        <?php
                        if ($row->picurl) {
                            if (strstr($row->picurl, '/editor/attached/image/')) {
                                $picurl = str_replace("/control/editor/attached/image/", "http://weix2.hengdianworld.com/control/editor/attached/image/", $row->picurl);
                                echo '<img src=' . $picurl . '>';
                            } else {
                                echo '<img src=/' . $row->picurl . '>';
                            }
                        }
                        ?>

                    </div>
                    <div>
                       <span class="btn default btn-file">
                           <span class="fileinput-new">
                               选择图片 </span>
                               <span class="fileinput-exists">
                                   更换图片 </span>
                                   <input type="file" name="pic_url">
                                   <input type="text" name="pic_url_session" hidden
                                   value="{!! $row->picurl !!}">
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
                                <?php

                                if ($row->pyq_pic) {

                                    if (strstr($row->pyq_pic, '/editor/attached/image/')) {
                                        $pyq_pic = str_replace("/control/editor/attached/image/", "http://weix2.hengdianworld.com/control/editor/attached/image/", $row->picurl);
                                        echo '<img src=' . $pyq_pic . '>';
                                    } else {
                                        echo '<img src=/' . $row->pyq_pic . '>';
                                    }
                                }

                                ?>
                            </div>
                            <div>
                               <span class="btn default btn-file">
                                   <span class="fileinput-new">
                                       选择图片 </span>
                                       <span class="fileinput-exists">
                                           更换图片 </span>
                                           <input type="file" name="pyq_pic">
                                           <input type="text" name="pyq_pic_session" hidden
                                           value="{!! $row->pyq_pic !!}">

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
                                    value="{!! $row->pyq_title !!}">
                                    <label class="help-inline">如果不填，则默认转发文章标题</label>
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
                        <div class="form-group">
                            <label class="control-label col-md-1">链接</label>

                            <div class="col-md-11">
                                <input name="url" class="form-control  input-inline input-xlarge"
                                value="{!! $row->url !!}">
                                <label class="help-inline">除非该内容是直接链接到其他网页，否则不需要填写，文章内容和链接只需要在一处填写</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">开始日期</label>

                            <div class="col-md-11">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd"
                                data-date-start-date="+0d">
                                <input type="text" class="form-control" readonly name="startdate"
                                value="{!! $row->startdate !!}">
                                <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i>
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
                            value="{!! $row->enddate !!}">
                            <span class="input-group-btn">
                                <button class="btn default" type="button"><i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        <span class="help-inline">如果不选默认永久有效</span>
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


            <div class="form-group">

                <label class="control-label col-md-1">是否需要审核</label>

                <div class="col-md-11">

                    <label class="checkbox">

                        <input type="checkbox" name="audit" id="audit"
                        value="yes" <?php if ($row->audit == 0) echo 'checked' ?>/>
                        <span class="help-inline">如果勾选，则需审核后发布。</span>
                    </label>


                </div>

            </div>


            <div class="form-group">
                <label class="control-label col-md-1">是否关注显示</label>

                <div class="col-md-11">

                    <label class="checkbox">

                        <input type="checkbox" name="focus" id="focus"
                        value="yes" <?php if ($row->focus == 1) echo 'checked' ?>/>
                        <span class="help-inline">如果勾选，则客人关注时接收到此条信息。</span>
                    </label>
                </div>
            </div>
            @if(Session::get('managelevel')<>'2')
            <div class="form-group">
                <label class="control-label col-md-1">是否允许复制</label>

                <div class="col-md-11">

                    <label class="checkbox">

                        <input type="checkbox" name="allow_copy"
                        value="yes" <?php if ($row->allow_copy == 1) echo 'checked' ?>/>
                        <span class="help-inline">如果勾选，则允许所有市场人员复制修改。</span>
                    </label>
                </div>
            </div>
            @endif
            <div class="form-group">
                <label class="control-label col-md-1">是否在底部显示二维码</label>

                <div class="col-md-11">

                    <label class="checkbox">

                        <input type="checkbox" name="show_qr"
                        value="yes" <?php if ($row->show_qr == 1) echo 'checked' ?>/>
                        <span class="help-inline">如果勾选，则在底部显示市场专属二维码。</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1">是否属于市场</label>

                <div class="col-md-4">
                    @if(Session::get('eventkey')=='all')
                    <input type="hidden" name="marketid" id="select2_sample5"
                    class="form-control select2"
                    value="<?php $usage = new \App\WeChat\Usage(); echo $usage->getArticleShowQrsecne($row->eventkey)?>">
                    @else
                    <input type="hidden" name="marketid" id="select2_sample5" readonly="readonly"
                    class="form-control select2"  value="<?php $usage = new \App\WeChat\Usage(); echo $usage->getArticleShowQrsecne(Session::get('eventkey'))?>">
                    @endif

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