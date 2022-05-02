@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－数据统计')

@section('page-menu-title', '订单统计')

@section('page-title', '数据统计')

@section('css')
        <!--日历-->
<link rel="stylesheet" type="text/css"
      href="{{asset('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')}}"/>
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
                    <form method="GET" name="myform" action="/control/ordercountsearch" class="navbar-form navbar-right">
                    <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012"
                         data-date-format="yyyy/mm/dd">
                        <input type="text" class="form-control" name="from"
                               value="<?php if (Session::has('from')) echo Session::get('from') ?>">
												<span class="input-group-addon">
												to </span>
                        <input type="text" class="form-control" name="to"
                               value="<?php if (Session::has('to')) echo Session::get('to') ?>">
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
                                手机号
                            </th>

                            <th>
                                状态
                            </th>

                            <th>
                                来源
                            </th>
                            <th>
                                点击菜单
                            </th>
                            <th>
                                提交时间
                            </th>
                            <th>
                                支付时间
                            </th>
                            <th>
                                预达日期
                            </th>
                            <th>
                                关注时间
                            </th>
                            <th>
                                其他预订
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr>
                                <td>
                                    <a href="http://e.hengdianworld.com/Admin_VisitorOrderView.aspx?SellID={!! $row->sellid !!}" target="_blank"> {!! $row->sellid !!}</a>
                                </td>


                                <td>
                                    {!! $row->order_name !!}
                                </td>
                                <td>
                                    {!! $row->tel !!}
                                </td>

                                <td>
                                    <?php
                                    $order = new \App\WeChat\Count();
                                    if ($order->check_payed($row->sellid)) {
                                        echo "<span class='label label-success'>已付款</span>";
                                    } else {
                                        echo "<span class='label label-danger'>未付款</span>";
                                    }
                                    ?>
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
                                    {!! $order->order_menu_click($row->wx_openid) !!}
                                </td>
                                <td>
                                    {!! $row->adddate !!}
                                </td>
                                <td>
                                    @if($order->check_payed($row->sellid))
                                        {!! $order->check_payed($row->sellid)->adddate !!}
                                    @endif
                                </td>
                                <td>
                                    {!! $row->arrive_date !!}
                                </td>
                                <td>
                                    {!! $row->focusdate !!}
                                </td>
                                <td>
                                    <?php
                                    if ($row->other_order == 1) {
                                        echo "<a OnClick=\"javascript:if (!confirm('是否真的没有在其他地方预订'))return false;\"  href='orderaction?action=no&id=" . $row->id . "' class='label label-danger'><i class='fa  fa-arrow-circle-o-down'></i>&nbsp;有</a>";
                                    } elseif ($row->other_order == 0) {
                                        echo "<a OnClick=\"javascript:if (!confirm('是否真的有在其他地方预订'))return false;\"  href='orderaction?action=yes&id=" . $row->id . "' class='label label-success'><i class='fa  fa-arrow-circle-o-up'></i>&nbsp;无</a>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $rows->appends(["from"=>$from,'to'=>$to])->render() !!}
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    @stop

    @section('js')

            <!--日历-->
    <script type="text/javascript"
            src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/admin/pages/scripts/components-pickers.js')}}"></script>

@stop


@section('init')
    ComponentsPickers.init();



@stop