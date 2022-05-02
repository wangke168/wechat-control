@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－代理商门票绑定')

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

@section('page-menu-title', '代理商订单衔接')
@section('page-title', '门票绑定')
@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">门票绑定</a>
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

                    <div class="caption"><i class="icon-comments"></i>门票绑定</div>

                    <div class="tools">

                        <a href="javascript:;" class="collapse"></a>

                    </div>

                </div>

                <div class="portlet-body form">

                    {!! Form::open(['url'=>'control/agentproduct?action=saveproduct','class'=>'form-horizontal form-bordered','id'=>'postForm']) !!}
                    <input type="text" name="type" hidden value="add">
                        <div class="form-body">

                            <div class="form-group">

                                <label class="control-label  col-md-1">门票ID</label>

                                <div class="col-md-11">
                                    <input type="text" placeholder="请输入门票ID" class="form-control input-large"
                                           name="product_id"/>
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="control-label  col-md-1">门票名称</label>

                                <div class="col-md-11">

                                    <input id="product_name" type="text" placeholder="请输入代理商门票名称" class="form-control input-large"
                                           name="product_name"/>

                                </div>

                            </div>

                            <div class="form-group">

                                <label class="control-label  col-md-1">所属代理商</label>

                                <div class="col-md-11">

                                    <select class="form-control input-medium select2me" name="companycode"
                                            data-placeholder="选择所属类别">
                                        {{--<option value=""></option>--}}
                                        <option value="xcddmpowurop">携程单订门票</option>;


                                    </select>

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