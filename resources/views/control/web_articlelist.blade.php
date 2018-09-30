@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－文章管理')
@section('page-menu-title', '文章列表')

@section('page-title', '官网管理')
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
                <a href="#">文章管理</a>
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

                    @if(Session::get('eventkey')=='all')
                        <ul class="nav nav-pills">

                            <li <?php if (!$classid) echo 'class=active'; ?> ><a href="/control/web_articlelist">全部</a></li>

                            <li <?php if ($classid == 7) echo 'class=active'; ?>><a
                                        href="/control/web_articlelist?classid=7">通知公告</a>
                            </li>
                            <li <?php if ($classid == 6) echo 'class=active'; ?>><a
                                        href="/control/web_articlelist?classid=6">圆明评述</a>
                            </li>
                            <li <?php if ($classid == 5) echo 'class=active'; ?>><a
                                        href="/control/web_articlelist?classid=5">专题活动</a>
                            </li>
                            <li <?php if ($classid == 4) echo 'class=active'; ?>><a
                                        href="/control/web_articlelist?classid=4">新闻资讯</a>
                            </li>

                            <li <?php if ($classid == 3) echo 'class=active'; ?>><a
                                        href="/control/web_articlelist?classid=3">圆明园故事</a>
                            </li>
                            <li <?php if ($classid == 2) echo 'class=active'; ?>><a
                                        href="/control/web_articlelist?classid=2">悠游新乐点</a>
                            </li>


                            <form method="GET" name="myform" action="articlesearch" class="navbar-form navbar-right">
                                <input class="m-wrap" type="text" name="keyword" class="form-control" placeholder="关键字"
                                       id="keyword" value=""/>
                                <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            </form>
                        </ul>
                    @endif
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
                                    上线时间
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
                                        {{$row->created}}
                                    </td>
                                    <td>
                                        <?php
                                        echo "<a href='web_articlemodify?action=modify&id=" . $row->id . "' class='label label-success'><i class='fa fa-edit'></i>&nbsp;修改</a>&nbsp;";

                                        echo "<a OnClick=\"javascript:if (!confirm('是否真的要删除'))return false;\"  href='web_articlemodify?action=del&id=" . $row->id . "' class='label label-danger'><i class='fa fa-trash-o'></i>&nbsp;删除</a>&nbsp;";


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

