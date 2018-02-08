@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－数据统计')

@section('page-menu-title', '年卡数据')

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
                <a href="#">年卡数据</a>
            </li>
        </ul>

    </div>
@stop

@section('content')
    @@parent
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <form method="GET" name="myform" action="/control/cardcountsearch" class="navbar-form navbar-right">

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
        </div>

        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>春苑
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $Usage = new \App\WeChat\Usage();
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1019')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1019')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$k+$j}}
                                </td>
                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
        <div class="col-md-6">
            <!-- BEGIN BORDERED TABLE PORTLET-->
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>夏苑
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1020')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1020')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>
                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END BORDERED TABLE PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>秋苑
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1021')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1021')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>
                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
        <div class="col-md-6">
            <!-- BEGIN CONDENSED TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>冬苑
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1022')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1022')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>
                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END CONDENSED TABLE PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>火烧
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1023')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1023')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>
                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>夜福海
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1024')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1024')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>
                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>动物
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1025')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1025')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>
                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>冰雪
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1026')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1026')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>
                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>景区办公室
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1027')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1027')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>
                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
        <div class="col-md-6">
            <!-- BEGIN BORDERED TABLE PORTLET-->
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>售票
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1028')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1028')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>
                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END BORDERED TABLE PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>检票
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1029')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1029')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>
                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
        <div class="col-md-6">
            <!-- BEGIN CONDENSED TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>景交
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1030')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1030')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>

                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END CONDENSED TABLE PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>高科水景
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1031')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1031')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>

                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>警卫
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1032')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1032')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>

                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-coffee"></i>演艺管理部
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <?php
                        $rows = \DB::table('wx_order_detail')
                            ->where('eventkey', '1033')
                            ->whereDate('adddate', '>=', $from)
                            ->whereDate('adddate', '<=', $to)
                            ->groupBy('ticket')
                            ->get();
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    年卡种类
                                </th>
                                <th>
                                    成人
                                </th>
                                <th>
                                    老人
                                </th>
                                <th>
                                    学生
                                </th>
                                <th>
                                    合计
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $a = 0;
                            $b = 0;
                            $c = 0;
                            foreach ($rows as $row) {
                            $result = \DB::table('wx_order_detail')
                                ->where('ticket', $row->ticket)
                                ->where('eventkey', '1033')
                                ->whereDate('adddate', '>=', $from)
                                ->whereDate('adddate', '<=', $to)
                                ->get();
                            $i = 0;
                            $j = 0;
                            $k = 0;
                            foreach ($result as $aaa) {
                                $bbb = $Usage->GetCardInfo($aaa->numbers);
                                $i = $i + $bbb[0];
                                $j = $j + $bbb[1];
                                $k = $k + $bbb[2];
                            }
                            ?>
                            <tr>

                                <td>
                                    {{$row->ticket}}
                                </td>
                                <td>
                                    {{$i}}
                                </td>
                                <td>
                                    {{$j}}
                                </td>
                                <td>
                                    {{$k}}
                                </td>
                                <td>
                                    {{$i+$j+$k}}
                                </td>

                            </tr>
                            <?php
                            $a = $a + $i;
                            $b = $b + $j;
                            $c = $c + $k;
                            }
                            ?>
                            <tr>

                                <td>
                                    合计
                                </td>
                                <td>
                                    {{$a}}
                                </td>
                                <td>
                                    {{$b}}
                                </td>
                                <td>
                                    {{$c}}
                                </td>
                                <td>
                                    {{$a+$b+$c}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>

    </div>
    <!-- END PAGE CONTENT-->
    </div>
    </div>
    <!-- END CONTENT -->

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