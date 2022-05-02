@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－代理商订单同步')

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
@section('page-menu-title', '代理商')
@section('page-title', '订单推送')
@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">代理商订单推送</a>
            </li>
        </ul>

    </div>
@stop

@section('content')
    @@parent
    <div class="row">
        <div class="col-md-12">
            <div class="page-title text-center">
                {{$ErrorMsg}}
            </div>
            <div class="page-title text-center">

                <p>
                    @if ($Type=='sync')
                        <a href="/control/agentinterface">继续下单 </a>
                    @elseif($Type=='cancel')
                        <a href="/control/agentordercancel">继续取消订单</a>
                    @endif



                </p>

            </div>
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