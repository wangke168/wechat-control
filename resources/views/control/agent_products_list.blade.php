@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－代理商订单衔接')

@section('css')
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet"
          type="text/css"/>
@stop


@section('page-menu-title', '代理商订单衔接')

@section('page-title', '门票数据管理')

@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">门票数据管理</a>
            </li>
        </ul>

    </div>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>门票列表
                    </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body">

                    <ul class="nav nav-pills navbar-left">


                        <button type="button" class="btn btn-success" onclick="javascript:window.location.href='agentproduct?action=addproduct';">绑 定 门 票</button>

                    </ul>
                    <div class="tab-content">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>
                                    序号
                                </th>
                                <th>
                                    门票ID
                                </th>

                                <th>
                                    门票名称
                                </th>

                                <th>
                                    代理商名称
                                </th>

                                <th>
                                    操作
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
                                        {{$row->product_id}}
                                    </td>

                                    <td>
                                        {{$row->product_name}}
                                    </td>
                                    <td>
                                        <?php
                                            if($row->companycode=='xcddmpowurop'){echo '携程单订门票';}
                                        ?>

                                    </td>

                                    <td>
                                        <?php
                                        echo "<a href='agentproduct?action=modifyproduct&id={$row->id}' class='label label-success'><i class=\"fa fa-edit\"></i>&nbsp;修改</a>&nbsp;";
                                        echo "<a OnClick=\"javascript:if (!confirm('是否真的要删除'))return false;\"  href='agentproduct?action=del&id={$row->id}' class='label label-danger'><i class=\"fa  fa-trash-o\"></i>&nbsp;删除</a>";
                                            $i=$i+1;
                                        ?>
                                    </td>
                                </tr>
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

