@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－二维码管理')

@section('css')
        <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/select2.css')}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}"/>
<!--上传-->
<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet">
@stop

@section('page-menu-title', '登记二维码')
@section('page-title', '二维码管理')
@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">二维码管理</a>
            </li>
        </ul>

    </div>
@stop

@section('content')
    @@parent
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box green-haze">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-comments"></i>修改临时二维码信息</div>

                    <div class="tools">

                        <a href="javascript:;" class="collapse"></a>

                    </div>

                </div>

                <div class="portlet-body form">

                    {!! Form::open(['url'=>'control/qrtemp?action=modifysave','files'=>true,'class'=>'form-horizontal form-bordered','id'=>'postForm']) !!}

                    @if(Session::has('qr_id_repeat'))
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span>该编号的临时二维码已经存在 </span>
                        </div>
                    @endif

                    <div class="form-body">

                        <div class="form-group">

                            <label class="control-label  col-md-1">名称</label>

                            <div class="col-md-11">
                                <input type="text" placeholder="请输入二维码名称" class="form-control input-large"
                                       name="qrscene_name" value="{!! $row->qrscene_name !!}"/>
                                <input type="text" name="id" hidden value="{!! $row->id !!}">
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label  col-md-1">编号</label>

                            <div class="col-md-11">

                                <input id="Modal1in" type="text" placeholder="请输入编号" class="form-control input-small"
                                       name="qrscene_id" onkeyup="value=this.value.replace(/\D+/g,'')"
                                       value="{!! $row->qrscene_id !!}"/>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label  col-md-1">有效期</label>

                            <div class="col-md-11">

                                <input id="Text1" type="text" placeholder="请输入有效期"
                                       class="form-control input-inline input-small"
                                       name="qrscene_expire" onkeyup="value=this.value.replace(/\D+/g,'')"
                                       value="{!! $row->expireseconds !!}"/>
                                <span class="help-inline">分钟</span>最大不超过43200（即30天）
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">Logo</label>

                            <div class="col-md-11">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 100px; height: 100px;">
                                        <?php
                                        if ($row->qrscene_logo) {
                                            echo '<img src=/' . $row->qrscene_logo . '>';
                                        }
                                        ?>
                                    </div>
                                    <div>
                               <span class="btn default btn-file">
                                   <span class="fileinput-new">
                                       选择图片 </span>
                                       <span class="fileinput-exists">
                                           更换图片 </span>
                                           <input type="file" name="qrscene_logo">
                                   <input type="text" name="qrscene_logo_session" hidden value="{!! $row->qrscene_logo !!}">
                                       </span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                            移除 </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-danger">
                                        注意! </span> 尺寸为98*98
                                </div>

                            </div>
                        </div>
                        <div class="form-group">

                            <label class="control-label  col-md-1">UID</label>

                            <div class="col-md-11">

                                <input id="Text2" type="text" placeholder="请输入UID" class="form-control input-large"
                                       name="qrscene_uid" value="{!! $row->uid !!}"/>

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

                        <!--END TABS-->
                    </div>
                    {!! Form::close() !!}

                </div>

            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
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
    <!--上传-->
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"></script>
@stop