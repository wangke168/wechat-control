@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－二维码管理')

@section('css')
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet"
          type="text/css"/>
@stop

@section('page-title', '文章列表')

@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">文章列表</a>
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
                        <i class="fa fa-globe"></i>文章列表
                    </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body">
                    <ul class="nav nav-pills navbar-left">


                        <button type="button" class="btn btn-success"
                                onclick="javascript:window.location.href='request_se?action=add';">添加二次回复
                        </button>

                    </ul>
                    <ul class="nav nav-pills">

                        <form method="POST" name="myform" action="requesttxt" class="navbar-form navbar-right">
                            <input class="m-wrap" type="text" name="keyword" class="form-control" placeholder="关键字"
                                   id="keyword" value=""/>
                            <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </ul>

                    <div class="tab-content">


                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>
                                    序号
                                </th>
                                <th>
                                    标题
                                </th>

                                <th>
                                    顺序
                                </th>
                                <th>
                                    展示对象
                                </th>
                                <th>
                                    发送数
                                </th>
                                <th>
                                    打开数
                                </th>
                                <th>
                                    点击数
                                </th>
                                <th>
                                    状态
                                </th>
                                <th>
                                    显示时间
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
                                        {{$row->id}}
                                    </td>
                                    <td>
                                        {{$row->title}}
                                    </td>
                                    <td>
                                        {{$row->priority}}
                                    </td>
                                    <td>
                                        @if ($row->target=='1')
                                            <span class='label label-success'>全部</span>
                                        @elseif($row->target=='2')
                                            <span class='label label-success'>门票</span>
                                        @elseif($row->target=='3')
                                            <span class='label label-success'>酒店</span>
                                        @endif
                                    </td>
                                    <td>
                                        <?php
                                        $count = new \App\WeChat\Count();
                                        echo $count->se_request_count($row->id);
                                        ?>
                                    </td>
                                    <td>
                                        {!! $count->se_request_read_count($row->id) !!}
                                    </td>
                                    <td>
                                        {{$row->hits}}
                                    </td>
                                    <td>
                                        <?php
                                        if ($row->online == 1) {
                                            echo "<span class='label label-success'>显示</span>";
                                        } else {
                                            echo "<span class='label label-danger'>不显示</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <?php
                                        echo "<a class='getqrcode label label-primary' data-target='#long' data-toggle='modal' data-src='qrcreat?type=article_se&id=" . $row->id . "'><i class='fa fa-eye'></i>&nbsp;预览</a>&nbsp;";
                                        echo "<a href='request_se?action=modify&id=" . $row->id . "' class='label label-success'><i class='fa fa-edit'></i>&nbsp;修改</a>&nbsp;";
                                        if ($row->online == 1) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要下线'))return false;\"  href='requestmodify?action=se_offline&id=" . $row->id . "' class='label label-warning'><i class=\"fa  fa-arrow-circle-o-down\"></i>&nbsp;下线</a>";
                                        } elseif ($row->online == 0) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要上线'))return false;\"  href='requestmodify?action=se_online&id=" . $row->id . "' class='label label-success'><i class=\"fa  fa-arrow-circle-o-up\"></i>&nbsp;上线</a>";

                                        }
                                        ?>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {!! $rows->render() !!}

                                <!--弹出层-->
                        <div id="long" class="modal fade " tabindex="-1" data-replace="true">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">微信扫描二维码预览</h4>
                            </div>
                            <div class="modal-body">
                                <!--				<img id='qr' style="height: 500px" src="../../../../../../i.imgur.com/KwPYo.jpg">-->
                                <iframe id='qr' src="http://www.baidu.com"
                                        style="border:none; width:250px; height:250px;"></iframe>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-default">关闭</button>
                            </div>
                        </div>
                        <!--结束弹出层-->
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

    $(".getqrcode").click(function () {
    //     alert($(this).attr('data-src'));
    $("#qr").attr({"src": $(this).attr("data-src")});
    });

@stop

