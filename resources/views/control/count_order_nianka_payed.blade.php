@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－数据统计')

@section('page-menu-title', '订单统计')

@section('page-title', '数据统计')

@section('css')
        <!--日历-->
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')}}"/>
        <link rel="stylesheet" type="text/css"
              href="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/select2.css')}}"/>
        <link rel="stylesheet" type="text/css"
              href="{{asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}"/>
@stop
@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">数据统计</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">订单统计</a>
            </li>
        </ul>

    </div>
@stop

@section('content')
    @@parent
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box red-intense">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>订单统计
                    </div>
                </div>
                <div class="portlet-body">
                    <form method="GET" name="myform" action="/control/niankacountsearch" class="navbar-form navbar-right">
                        <select name="eventkey" class="form-control input-medium select2me"
                                data-placeholder="Select...">
                            <option value="1019">春苑</option>
                            <option value="1024">夜福海</option>
                            <option value="1020">夏苑</option>
                            <option value="1023">火烧</option>
                            <option value="1021">秋苑</option>
                            <option value="1022">冬苑</option>
                            <option value="1025">动物</option>
                            <option value="1026">冰雪</option>
                            <option value="1027">办公室</option>
                            <option value="1028">售票</option>
                            <option value="1029">检票</option>
                            <option value="1030">车辆</option>
                            <option value="1031">高科</option>
                            <option value="1032">警卫</option>
                            <option value="1033">演艺管理部</option>
                        </select>
                    <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012"
                         data-date-format="yyyy/mm/dd">



                        <input type="text" class="form-control" name="from"
                               value="">
												<span class="input-group-addon">
												to </span>
                        <input type="text" class="form-control" name="to"
                               value="">
                    </div>

                    <button type="submit" class="btn green"><i class="fa fa-search"></i> 提 交</button>
                 </form>

                            <!-- /input-group -->


                    <table class="table table-striped table-bordered table-hover" id="sample_6">
                        <thead>
                        <tr>
                            <th>
                                订单号
                            </th>
                            <th>
                                姓名
                            </th>
                            <th>
                                票种
                            </th>
                            <th>
                                人数
                            </th>


                            <th>
                                来源
                            </th>

                            <th>
                                提交时间
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr>
                                <td>
                                    <a href="http://ydpt.hdyuanmingxianyuan.com/Admin_VisitorOrderView.aspx?SellID={!! $row->sellid !!}" target="_blank"> {!! $row->sellid !!}</a>
                                </td>


                                <td>
                                    {!! $row->k_name !!}
                                </td>
                                <td>
                                    {!! $row->ticket !!}
                                </td>
                                <td>
                                    {!! $row->numbers !!}
                                </td>

                                <td>
                                    <?php
                                    if ($row->eventkey) {
                                        $usage = new \App\WeChat\Usage();
                                        echo "<span class='label bg-grey-cascade'>".$usage->getQrsecneinfo($row->eventkey)->qrscene_name."</span>";
                                    }
                                    ?>
                                </td>

                                <td>
                                    {!! $row->adddate !!}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $rows->render() !!}
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
        <!-- END PAGE LEVEL PLUGINS -->

            <!--日历-->
    <script type="text/javascript"
            src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/admin/pages/scripts/components-pickers.js')}}"></script>

@stop


@section('init')
    ComponentsPickers.init();



@stop