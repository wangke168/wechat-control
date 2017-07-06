@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－修改密码')

@section('css')
        <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/select2.css')}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}"/>

@stop

@section('page-menu-title', '修改密码')

@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">修改密码</a>
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

                    <div class="caption"><i class="icon-comments"></i>修改密码</div>

                    <div class="tools">

                        <a href="javascript:;" class="collapse"></a>

                    </div>

                </div>

                <div class="portlet-body form">

                    {!! Form::open(['url'=>'control/changpassword?action=modify','class'=>'form-horizontal form-bordered']) !!}


                    <div class="form-body">
                        @if(Session::get('changpwd')=='failed')
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <span>两次输的新密码不一致,请检查后重新输入. </span>
                            </div>
                            @elseif(Session::get('changpwd')=='zero')
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <span>密码不能为空. </span>
                            </div>
                        @elseif(Session::get('changpwd')=='old_error')
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <span>旧密码有误,请检查后重新输入. </span>
                            </div>
                        @elseif(Session::get('changpwd')=='success')
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <span>密码已成功修改. </span>
                            </div>
                        @endif

                        <div class="form-group">

                            <label class="control-label  col-md-1">原密码</label>

                            <div class="col-md-11">
                                <input type="password" placeholder="请输入原密码" class="form-control input-large"
                                       name="old_pwd"/>
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label  col-md-1">新密码</label>

                            <div class="col-md-11">

                                <input id="Modal1in" type="password" placeholder="请输入新密码"
                                       class="form-control input-large"
                                       name="new_pwd"/>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label  col-md-1">重复新密码</label>

                            <div class="col-md-11">

                                <input id="Text1" type="password" placeholder="请重复输入新密码"
                                       class="form-control input-large"
                                       name="repeat_new_pwd"/>


                            </div>

                        </div>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green"><i class="fa fa-check"></i> 确 认</button>
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
@stop