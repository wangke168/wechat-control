@extends('control.blade.data')
<?php $usage=new \App\WeChat\Usage();?>
@section('title', '横店影视城微信管理平台－－－二维码管理')

@section('page-title','二维码管理')
@section('css')
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css"/>
@stop
@section('page-menu-title')
    {!! $usage->get_qr_classid_name($classid)->class_name !!}
    @stop
@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index-2.html">Home</a>
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
                    <div class="caption">
                        <i class="fa fa-globe"></i>{!! $usage->get_qr_classid_name($classid)->class_name !!}
                    </div>
                    <div class="tools">
                    </div>
                </div>

                <div class="portlet-body">
                    <form method="GET" name="myform" action="qrsearch" class="navbar-form navbar-right">
                        <input class="m-wrap" type="text" name="keyword" class="form-control" placeholder="二维码关键字"
                               id="keyword" value=""/>
                        <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr>
                            <th>
                                序号
                            </th>
                            <th>
                                名称
                            </th>
                            <th>
                                关注数
                            </th>
                            <th>
                                订单数
                            </th>
                            <th>
                                操作
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr>
                                <td>
                                    {{$row->qrscene_id}}
                                </td>
                                <td>
                                    {{$row->qrscene_name}}
                                </td>
                                <td>
                                    <?php
                                    $row_count = DB::table('wx_user_info')
                                            ->where('eventkey', $row->qrscene_id)
                                            ->where('esc', '0')
                                            ->count();
                                    echo $row_count;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $row_count = DB::table('wx_order_send')
                                            ->where('eventkey', $row->qrscene_id)
                                            ->count();
                                    echo $row_count;
                                    ?>
                                </td>
                                <td>
                                    <?php
                              //      echo "<a href='http://weix2.hengdianworld.com/control/qr_create.php?qrscene_id=" . $row->qrscene_id . "' class='label label-warning' target='_blank'><i class=\"icon-edit\"></i>获取二维码</a>&nbsp;&nbsp;&nbsp;";
                                    echo "<a class='getqrcode label label-primary' data-target=\"#long\" data-toggle=\"modal\" data-src=\"qrcode_create/" . $row->qrscene_id . "\"><i class=\"fa  fa-download\"></i>&nbsp;下载二维码</a>&nbsp;";

                                    echo "<a href='qrmodify?action=modify&id=" . $row->id . "' class='label label-success'><i class=\"fa fa-edit\"></i>&nbsp;修改</a>";

                                    ?>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $rows->appends(["classid"=>$classid])->render() !!}

                            <!--弹出层-->
                    <div id="long" class="modal fade " tabindex="-1" data-replace="true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">二维码下载</h4>
                        </div>
                        <div class="modal-body">
                            				{{--<img id='qr'  src="../../../../../../i.imgur.com/KwPYo.jpg">--}}
                            <iframe id='qr' src="http://www.baidu.com" style="border:none; width:500px; height:500px;"></iframe>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">关闭</button>
                        </div>
                    </div>
                    <!--结束弹出层-->

                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

@stop
@section('js')
    <script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/pages/scripts/ui-extended-modals.js')}}"></script>
@stop

@section('init')

    $(".getqrcode").click(function () {
    //     alert($(this).attr('data-src'));
    $("#qr").attr({"src": $(this).attr("data-src")});
    });

@stop