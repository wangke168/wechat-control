@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－企业号管理')

@section('css')
        <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/select2.css')}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}"/>

@stop

@section('page-menu-title', '登记')
@section('page-title', '企业号管理')
@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">企业号管理</a>
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

                    <div class="caption"><i class="icon-comments"></i>添加信息</div>

                    <div class="tools">

                        <a href="javascript:;" class="collapse"></a>

                    </div>

                </div>

                <div class="portlet-body form">

                    {!! Form::open(['url'=>'control/tglm?action=save','class'=>'form-horizontal form-bordered','id'=>'postForm']) !!}




                        <div class="form-body">

                            <!--  <div class="form-group">

                                 <label class="control-label  col-md-1">名称</label>

                          !--   <div class="col-md-11">
                                     <input type="text" placeholder="请输入二维码名称" class="form-control input-large"
                                            name="qrscene_name"/>
                                 </div>

                            </div>
                    -->
                            <div class="form-group">

                                <label class="control-label  col-md-1">联系人</label>

                                <div class="col-md-11">

                                    <input id="Modal1in" type="text" placeholder="请输入联系人" class="form-control input-large"
                                           name="name"/>

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="control-label  col-md-1">联系电话</label>

                                <div class="col-md-11">

                                    <input id="Text1" type="text" placeholder="请输入联系电话" class="form-control input-large"
                                           name="tel"/>


                                </div>

                            </div>

                            <div class="form-group">

                                <label class="control-label  col-md-1">UID</label>

                                <div class="col-md-11">

                                    <input id="Text2" type="text" placeholder="请输入UID" class="form-control input-large"
                                           name="uid"/>

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
    @stop