@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－回复管理')

@section('css')
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet"
          type="text/css"/>
@stop


@section('page-menu-title', '语音回复')

@section('page-title', '回复管理')

@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">语音回复</a>
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
                        <i class="fa fa-globe"></i>语音回复列表
                    </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body">
                    <ul class="nav nav-pills navbar-left">


                        <button type="button" class="btn btn-success"
                                onclick="javascript:window.location.href='requestvoice?action=add';">添加语音回复
                        </button>
                        <button type="button" class="btn btn-primary"
                                onclick="javascript:window.location.href='requestvoice?action=snyc';">同步
                        </button>

                    </ul>
                    <ul class="nav nav-pills">
                        {!! Form::open(['url'=>'control/requestvoice?action=search','class'=>'navbar-form navbar-right',
                                            'id'=>'postForm']) !!}

                        <input class="m-wrap" type="text" name="keyword" class="form-control" placeholder="关键字"
                               id="keyword" value=""/>

                        <button type="submit"><span class="glyphicon glyphicon-search"></span></button>

                        {!! Form::close() !!}
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
                                    展示对象
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
                            <?php $i = 1?>
                            @foreach($rows as $row)
                                <tr>
                                    <td>
                                        {{$i}}
                                    </td>
                                    <td>
                                        {{$row->remark}}
                                    </td>

                                    <td>

                                        <?php
                                        $usage = new \App\WeChat\Usage();
                                        echo "<span class='label bg-grey-cascade'>" . str_limit($usage->getArticleShowQrsecne($row->eventkey), $limit = 30, $end = '...') . "</span>";
                                        ?>
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
                                        {{$row->start_date}}--{!! $row->end_date !!}
                                    </td>
                                    <td>
                                        <?php
                                        echo "<a href='requestvoice?action=modify&id=" . $row->id . "' class='label label-success'><i class=\"fa fa-edit\"></i>&nbsp;修改</a>&nbsp;";

                                        if ($row->online == 1) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要下线'))return false;\"  href='requestvoice?action=offline&id=" . $row->id . "' class='label label-warning'><i class=\"fa  fa-arrow-circle-o-down\"></i>&nbsp;下线</a>&nbsp;";
                                        } elseif ($row->online == 0) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要上线'))return false;\"  href='requestvoice?action=online&id=" . $row->id . "' class='label label-success'><i class=\"fa  fa-arrow-circle-o-up\"></i>&nbsp;上线</a>&nbsp;";

                                        }
                                        echo "<a class='getqrcode label label-primary' data-target=\"#long\" data-toggle=\"modal\" data-src=\"qrcode_create/" . $row->eventkey . "\"><i class=\"fa  fa-edit\"></i>&nbsp;试听</a>&nbsp;";

                                        echo "<a OnClick=\"javascript:if (!confirm('是否真的要删除'))return false;\"  href='requestvoice?action=del&id=" . $row->id . "&media_id=" . $row->media_id . "' class='label label-danger'><i class='fa fa-trash-o'></i>&nbsp;删除</a>";
                                        $i = $i + 1;
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
                                <h4 class="modal-title">扫描二维码关注试听</h4>
                            </div>
                            <div class="modal-body">
                                {{--<img id='qr'  src="../../../../../../i.imgur.com/KwPYo.jpg">--}}
                                <iframe id='qr' src="http://www.baidu.com"
                                        style="border:none; width:500px; height:500px;"></iframe>
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
