@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－年卡')

@section('css')
        <!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/select2.css')}}"/>
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}"/>

@stop

@section('page-menu-title', '年卡')
@section('page-title', '年卡查询')
@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">年卡查询</a>
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

                    <div class="caption"><i class="icon-comments"></i>年卡查询</div>

                    <div class="tools">

                        <a href="javascript:;" class="collapse"></a>

                    </div>

                </div>

                <div class="portlet-body form">

                    {!! Form::open(['url'=>'control/employeecard?type=search','class'=>'form-horizontal form-bordered','id'=>'postForm']) !!}




                        <div class="form-body">

                            <!--  <div class="form-group">

                                 <label class="control-label  col-md-1">名称</label>

                          !--   <div class="col-md-11">
                                     <input type="text" placeholder="请输入二维码名称" class="form-control input-large"
                                            name="qrscene_name"/>
                                 </div>

                            </div>
                    -->
                            @if(Session::has('check'))
                                <div class="alert alert-danger">
                                    <button class="close" data-close="alert"></button>
                                    <span>{{Session('curlID')}} </span>
                                </div>
                            @endif
                            <div class="form-group">

                                <label class="control-label  col-md-1">姓名</label>

                                <div class="col-md-11">

                                    <input id="Modal1in" type="text" placeholder="请输入联系人" class="form-control input-large"
                                           name="Name" value="{{ old('Name') }}"/>

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="control-label  col-md-1">身份证号码</label>

                                <div class="col-md-11">

                                    <input id="Text1" type="text" placeholder="请输入身份证号码" class="form-control input-large"
                                           name="DIdNumber" value="{{ old('DIdNumber') }}"/>


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