@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－景区演艺秀推送')

@section('css')
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet"
          type="text/css"/>
@stop


@section('page-menu-title', '景区演艺秀推送')

@section('page-title', '景区演艺秀推送')

@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">景区演艺秀推送</a>
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
                        <i class="fa fa-globe"></i>时间列表
                    </div>
                    <div class="tools">
                    </div>
                </div>
                <div class="portlet-body">

                    <ul class="nav nav-pills navbar-left">


                        <button type="button" class="btn btn-success" onclick="javascript:window.location.href='pushproject?action=add';">添加演艺秀时间</button>

                    </ul>
                    <div class="tab-content">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>
                                    序号
                                </th>
                                <th>
                                    演艺秀名称
                                </th>
                                <th>
                                    演艺秀时间
                                </th>
                                <th>
                                    开始日期
                                </th>

                                <th>
                                    结束日期
                                </th>
                                <th>
                                    所属景区
                                </th>
                                <th>
                                    状态
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

                                        <?php
                                        $zone=new \App\WeChat\Zone();
                                            echo $zone->get_project_info($row->show_id)->show_name;
                                            if($row->se_name){
                                                echo '('.$row->se_name.')';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        {{$row->show_time}}
                                    </td>
                                    <td>
                                        {{$row->startdate}}
                                    </td>
                                    <td>
                                        {{$row->enddate}}
                                    </td>
                                    <td>
                                    <?php
                                    $usage = new \App\WeChat\Usage();
                                    echo "<span class='label bg-grey-cascade'>" . $usage->getArticleShowQrsecne($row->eventkey) . "</span>";
                                    ?>

                                    <td>
                                        <?php
                                       /* if ($row->online == 1) {
                                            echo "<span class='label label-success'>显示</span>";
                                        } else {
                                            echo "<span class='label label-danger'>不显示</span>";
                                        }*/
                                        if ($row->is_top == 0) {
                                            echo "&nbsp;<span class='label label-success'>常规</span>";
                                        } else {
                                            echo "&nbsp;<span class='label label-danger'>黄金周</span>";
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <?php
                                        echo "<a href='pushproject?action=modify&id={$row->id}' class='label label-success'><i class=\"fa fa-edit\"></i>&nbsp;修改</a>&nbsp;";
                                       /* if ($row->is_push == 1) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要取消推送'))return false;\"  href='pushproject?action=notpush&id={$row->id}' class='label label-warning'><i class=\"fa  fa-chevron-circle-down\"></i>&nbsp;取消推送</a>";
                                        } elseif ($row->is_push == 0) {
                                            echo "<a OnClick=\"javascript:if (!confirm('是否真的要推送'))return false;\"  href='pushproject?action=push&id={$row->id}' class='label label-success'><i class=\"fa  fa-chevron-circle-up\"></i>&nbsp;自动推送</a>";

                                        }*/
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

