@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－代理商订单衔接')

@section('css')
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet"
          type="text/css"/>
@stop


@section('page-menu-title', '代理商订单衔接')

@section('page-title', '订单同步历史')

@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">订单同步历史</a>
            </li>
        </ul>

    </div>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box green-haze">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>同步列表
                    </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body">

                  {{--  <ul class="nav nav-pills navbar-left">


                        <button type="button" class="btn btn-success" onclick="javascript:window.location.href='agentproduct?action=addproduct';">绑 定 门 票</button>

                    </ul>--}}
                    <form method="POST" name="myform" action="agentsycnlist?action=search" class="navbar-form navbar-right">
                        <input class="m-wrap" type="text" name="keyword" class="form-control" placeholder="关键字"
                               id="keyword" value=""/><input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                    <div class="tab-content">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>
                                    序号
                                </th>
                                <th>
                                    代理商订单号
                                </th>

                                <th>
                                    官网订单号
                                </th>

                                <th>
                                    同步时间
                                </th>

                                <th>
                                    操作员
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1?>
                            @foreach($rows as $row)
                                <tr>
                                    <td>
                                        {{$i}}
                                    </td>
                                    <td>
                                        {{$row->CompanyOrderID}}
                                    </td>

                                    <td>
                                        {{$row->OrderID}}
                                    </td>
                                    <td>
                                        {{$row->AddTime}}

                                    </td>

                                    <td>
                                        {{$row->User}}
                                    </td>
                                </tr>
                                <?php $i=$i+1 ?>
                            @endforeach

                            </tbody>
                        </table>
                        {!! $rows->render() !!}


                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>




@stop

@section('js')
    <script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/admin/pages/scripts/ui-extended-modals.js')}}"></script>
@stop

@section('init')


@stop

