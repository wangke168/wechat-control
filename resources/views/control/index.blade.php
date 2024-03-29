@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－公告牌')

@section('page-menu-title', '公告牌')

@section('css')
        <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet"
      type="text/css"/>
<link href="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="{{asset('assets/admin/pages/css/tasks.css')}}" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css"/>
@stop


@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">公告牌</a>
            </li>
        </ul>

    </div>
@stop

@section('content')
    @@parent
    @if(Session::get('managelevel')=='3')
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">

                            <?php
                            $row = DB::table('wx_user_dairy_detail')
                                    ->orderBy('id', 'desc')
                                    ->first();
                            echo $row->add;
                            ?>

                        </div>
                        <div class="desc">
                            昨日关注数
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            {!! $row->esc !!}
                        </div>
                        <div class="desc">
                            昨日取消关注数
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green-haze">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            $row_order = DB::table('wx_order_dairy_detail')
                                    ->orderBy('id', 'desc')
                                    ->first();
                            echo $row_order->confirm;
                            ?>
                        </div>
                        <div class="desc">
                            昨日订单数
                        </div>
                    </div>
                    <a class="more" href="ordercount">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            $row = DB::table('wx_article_hits')
                                    ->whereDate('adddate', '>=', date("Y-m-d", strtotime("-1 day")))
                                    ->whereDate('adddate', '<', date("Y-m-d"))
                                    ->count();
                            echo $row;
                            ?>
                        </div>
                        <div class="desc">
                            昨日总阅读数
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow-casablanca">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">

                                同步代理商订单

                        </div>
                        {{--<div class="desc">

                        </div>--}}
                    </div>
                    <a class="more" href="/control/agentinterface">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat grey-cascade">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            取消代理商订单
                        </div>
                       {{-- <div class="desc">
                            昨日取消关注数
                        </div>--}}
                    </div>
                    <a class="more" href="/control/agentordercancel">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
           {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green-haze">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">

                        </div>
                        <div class="desc">
                            同步订单
                        </div>
                    </div>
                    <a class="more" href="ordercount">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">

                        </div>
                        <div class="desc">
                            昨日总阅读数
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>--}}
        </div>
        <!-- END DASHBOARD STATS -->
        <div class="clearfix">
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
                <div class="portlet box red">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>用户数走势
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
                        <div id="chart_2" class="chart" style="height:350px;">


                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
            <div class="col-md-6 col-sm-6">
                <!-- BEGIN STACK CHART CONTROLS PORTLET-->
                <div class="portlet box yellow">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>近期订单
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
                        <div id="chart_5" style="height:350px;">
                        </div>
                        {{-- <div class="btn-toolbar">
                             <div class="btn-group stackControls">
                                 <input type="button" class="btn blue" value="With stacking"/>
                                 <input type="button" class="btn red" value="Without stacking"/>
                             </div>
                             <div class="space5">
                             </div>
                             <div class="btn-group graphControls">
                                 <input type="button" class="btn" value="Bars"/>
                                 <input type="button" class="btn" value="Lines"/>
                                 <input type="button" class="btn" value="Lines with steps"/>
                             </div>
                         </div>--}}
                    </div>
                </div>
                <!-- END STACK CHART CONTROLS PORTLET-->
            </div>
        </div>
        <div class="clearfix">
        </div>
        <div class="row ">
            <div class="col-md-6 col-sm-6">
                <div class="portlet box blue-steel">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bell-o"></i>可复制内容
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                            <ul class="feeds">
                                <?php
                                $rows = DB::table('wx_article')
                                        ->where('allow_copy', '1')
                                        ->where('del', '0')
                                        ->where('audit', '1')
                                        ->where('online', '1')
                                        ->orderBy('id', 'desc')
                                        ->skip(0)->take(9)
                                        ->get();
                                if ($rows)
                                {
                                foreach ($rows as $row){
                                ?>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info">
                                                    <i class="fa fa-copy"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    {!! $row->title !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            <a href="articlemodify?action=modify&id={!! $row->id !!}">编辑</a>
                                        </div>
                                    </div>
                                </li>
                                <?php }}?>


                            </ul>
                        </div>
                        <div class="scroller-footer">
                            <div class="btn-arrow-link pull-right">
                                <a href="#">See All Records</a>
                                <i class="icon-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="portlet box green-haze tasks-widget">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-check"></i>Tasks
                        </div>
                        <div class="tools">
                            <a href="#portlet-config" data-toggle="modal" class="config">
                            </a>
                            <a href="#" class="reload">
                            </a>
                            <a href="javascript:;" class="fullscreen">
                            </a>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class="btn btn-default btn-sm dropdown-toggle" href="#" data-toggle="dropdown"
                                   data-hover="dropdown" data-close-others="true">
                                    More <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="#">
                                            <i class="i"></i> All Project </a>
                                    </li>
                                    <li class="divider">
                                    </li>
                                    <li>
                                        <a href="#">
                                            AirAsia </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Cruise </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            HSBC </a>
                                    </li>
                                    <li class="divider">
                                    </li>
                                    <li>
                                        <a href="#">
                                            Pending <span class="badge badge-danger">
                                                                4 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Completed <span class="badge badge-success">
                                                                12 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Overdue <span class="badge badge-warning">
                                                                9 </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="task-content">
                            <div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="1">
                                <!-- START TASK LIST -->
                                <ul class="task-list">
                                    <li>
                                        <div class="task-checkbox">
                                            <input type="hidden" value="1" name="test"/>
                                            <input type="checkbox" class="liChild" value="2" name="test"/>
                                        </div>
                                        <div class="task-title">
                                                                <span class="task-title-sp">
                                                                    Present 2013 Year IPO Statistics at Board Meeting </span>
                                            <span class="label label-sm label-success">Company</span>
                                                                    <span class="task-bell">
                                                                        <i class="fa fa-bell-o"></i>
                                                                    </span>
                                        </div>
                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-xs default" href="#" data-toggle="dropdown"
                                                   data-hover="dropdown" data-close-others="true">
                                                    <i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-check"></i> Complete </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="task-checkbox">
                                            <input type="checkbox" class="liChild" value=""/>
                                        </div>
                                        <div class="task-title">
                                                                            <span class="task-title-sp">
                                                                                Hold An Interview for Marketing Manager Position </span>
                                            <span class="label label-sm label-danger">Marketing</span>
                                        </div>
                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-xs default" href="#" data-toggle="dropdown"
                                                   data-hover="dropdown" data-close-others="true">
                                                    <i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-check"></i> Complete </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="task-checkbox">
                                            <input type="checkbox" class="liChild" value=""/>
                                        </div>
                                        <div class="task-title">
                                                                                        <span class="task-title-sp">
                                                                                            AirAsia Intranet System Project Internal Meeting </span>
                                            <span class="label label-sm label-success">AirAsia</span>
                                                                                            <span class="task-bell">
                                                                                                <i class="fa fa-bell-o"></i>
                                                                                            </span>
                                        </div>
                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-xs default" href="#" data-toggle="dropdown"
                                                   data-hover="dropdown" data-close-others="true">
                                                    <i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-check"></i> Complete </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="task-checkbox">
                                            <input type="checkbox" class="liChild" value=""/>
                                        </div>
                                        <div class="task-title">
                                                                                                    <span class="task-title-sp">
                                                                                                        Technical Management Meeting </span>
                                            <span class="label label-sm label-warning">Company</span>
                                        </div>
                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-xs default" href="#" data-toggle="dropdown"
                                                   data-hover="dropdown" data-close-others="true">
                                                    <i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-check"></i> Complete </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="task-checkbox">
                                            <input type="checkbox" class="liChild" value=""/>
                                        </div>
                                        <div class="task-title">
                                                                                                                <span class="task-title-sp">
                                                                                                                    Kick-off Company CRM Mobile App Development </span>
                                            <span class="label label-sm label-info">Internal Products</span>
                                        </div>
                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-xs default" href="#" data-toggle="dropdown"
                                                   data-hover="dropdown" data-close-others="true">
                                                    <i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-check"></i> Complete </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="task-checkbox">
                                            <input type="checkbox" class="liChild" value=""/>
                                        </div>
                                        <div class="task-title">
                                                                                                                            <span class="task-title-sp">
                                                                                                                                Prepare Commercial Offer For SmartVision Website Rewamp </span>
                                            <span class="label label-sm label-danger">SmartVision</span>
                                        </div>
                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-xs default" href="#" data-toggle="dropdown"
                                                   data-hover="dropdown" data-close-others="true">
                                                    <i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-check"></i> Complete </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="task-checkbox">
                                            <input type="checkbox" class="liChild" value=""/>
                                        </div>
                                        <div class="task-title">
                                                                                                                                        <span class="task-title-sp">
                                                                                                                                            Sign-Off The Comercial Agreement With AutoSmart </span>
                                            <span class="label label-sm label-default">AutoSmart</span>
                                                                                                                                            <span class="task-bell">
                                                                                                                                                <i class="fa fa-bell-o"></i>
                                                                                                                                            </span>
                                        </div>
                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-xs default" href="#" data-toggle="dropdown"
                                                   data-hover="dropdown" data-close-others="true">
                                                    <i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-check"></i> Complete </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="task-checkbox">
                                            <input type="checkbox" class="liChild" value=""/>
                                        </div>
                                        <div class="task-title">
                                                                                                                                                    <span class="task-title-sp">
                                                                                                                                                        Company Staff Meeting </span>
                                            <span class="label label-sm label-success">Cruise</span>
                                                                                                                                                        <span class="task-bell">
                                                                                                                                                            <i class="fa fa-bell-o"></i>
                                                                                                                                                        </span>
                                        </div>
                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-xs default" href="#" data-toggle="dropdown"
                                                   data-hover="dropdown" data-close-others="true">
                                                    <i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-check"></i> Complete </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="last-line">
                                        <div class="task-checkbox">
                                            <input type="checkbox" class="liChild" value=""/>
                                        </div>
                                        <div class="task-title">
                                                                                                                                                                <span class="task-title-sp">
                                                                                                                                                                    KeenThemes Investment Discussion </span>
                                            <span class="label label-sm label-warning">KeenThemes </span>
                                        </div>
                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-xs default" href="#" data-toggle="dropdown"
                                                   data-hover="dropdown" data-close-others="true">
                                                    <i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-check"></i> Complete </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-pencil"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <!-- END START TASK LIST -->
                            </div>
                        </div>
                        <div class="task-footer">
                            <div class="btn-arrow-link pull-right">
                                <a href="#">See All Records</a>
                                <i class="icon-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix">
        </div>
        <div class="row ">
            <div class="col-md-6 col-sm-6">
                <div class="portlet box purple-wisteria">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-calendar"></i>General Stats
                        </div>
                        <div class="actions">
                            <a href="javascript:;" class="btn btn-sm btn-default easy-pie-chart-reload">
                                <i class="fa fa-repeat"></i> Reload </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="easy-pie-chart">
                                    <div class="number transactions" data-percent="55">
                                                                                                                                                                           <span>
                                                                                                                                                                               +55 </span>
                                        %
                                    </div>
                                    <a class="title" href="#">
                                        Transactions <i class="icon-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="margin-bottom-10 visible-sm">
                            </div>
                            <div class="col-md-4">
                                <div class="easy-pie-chart">
                                    <div class="number visits" data-percent="85">
                                                                                                                                                                           <span>
                                                                                                                                                                               +85 </span>
                                        %
                                    </div>
                                    <a class="title" href="#">
                                        New Visits <i class="icon-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="margin-bottom-10 visible-sm">
                            </div>
                            <div class="col-md-4">
                                <div class="easy-pie-chart">
                                    <div class="number bounce" data-percent="46">
                                                                                                                                                                           <span>
                                                                                                                                                                               -46 </span>
                                        %
                                    </div>
                                    <a class="title" href="#">
                                        Bounce <i class="icon-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="portlet box red-sunglo">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-calendar"></i>Server Stats
                        </div>
                        <div class="tools">
                            <a href="#" class="collapse">
                            </a>
                            <a href="#portlet-config" data-toggle="modal" class="config">
                            </a>
                            <a href="#" class="reload">
                            </a>
                            <a href="#" class="remove">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="sparkline-chart">
                                    <div class="number" id="sparkline_bar"></div>
                                    <a class="title" href="#">
                                        Network <i class="icon-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="margin-bottom-10 visible-sm">
                            </div>
                            <div class="col-md-4">
                                <div class="sparkline-chart">
                                    <div class="number" id="sparkline_bar2"></div>
                                    <a class="title" href="#">
                                        CPU Load <i class="icon-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="margin-bottom-10 visible-sm">
                            </div>
                            <div class="col-md-4">
                                <div class="sparkline-chart">
                                    <div class="number" id="sparkline_line"></div>
                                    <a class="title" href="#">
                                        Load Rate <i class="icon-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix">
        </div>
        <div class="row ">
            <div class="col-md-6 col-sm-6">
                <!-- BEGIN REGIONAL STATS PORTLET-->
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Regional Stats
                        </div>
                        <div class="tools">
                            <a href="#" class="collapse">
                            </a>
                            <a href="#portlet-config" data-toggle="modal" class="config">
                            </a>
                            <a href="#" class="reload">
                            </a>
                            <a href="#" class="fullscreen">
                            </a>
                            <a href="#" class="remove">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="region_statistics_loading">
                            <img src="{{asset('assets/admin/layout/img/loading.gif')}}" alt="loading"/>
                        </div>
                        <div id="region_statistics_content" class="display-none">
                            <div class="btn-toolbar margin-bottom-10">
                                <div class="btn-group" data-toggle="buttons">
                                    <a href="#" class="btn default btn-sm active">
                                        Users </a>
                                    <a href="#" class="btn default btn-sm">
                                        Orders </a>
                                </div>
                                <div class="btn-group pull-right">
                                    <a href="#" class="btn default btn-sm dropdown-toggle" data-toggle="dropdown"
                                       data-hover="dropdown" data-close-others="true">
                                        Select Region <span class="fa fa-angle-down">
                                                                                                                                                                            </span>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;" id="regional_stat_world">
                                                World </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" id="regional_stat_usa">
                                                USA </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" id="regional_stat_europe">
                                                Europe </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" id="regional_stat_russia">
                                                Russia </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" id="regional_stat_germany">
                                                Germany </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div id="vmap_world" class="vmaps display-none">
                            </div>
                            <div id="vmap_usa" class="vmaps display-none">
                            </div>
                            <div id="vmap_europe" class="vmaps display-none">
                            </div>
                            <div id="vmap_russia" class="vmaps display-none">
                            </div>
                            <div id="vmap_germany" class="vmaps display-none">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END REGIONAL STATS PORTLET-->
            </div>
            <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
                <div class="portlet paddingless">
                    <div class="portlet-title line">
                        <div class="caption">
                            <i class="fa fa-bell-o"></i>Feeds
                        </div>
                        <div class="tools">
                            <a href="#" class="collapse">
                            </a>
                            <a href="#portlet-config" data-toggle="modal" class="config">
                            </a>
                            <a href="#" class="reload">
                            </a>
                            <a href="#" class="remove">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!--BEGIN TABS-->
                        <div class="tabbable tabbable-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">
                                        System </a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">
                                        Activities </a>
                                </li>
                                <li>
                                    <a href="#tab_1_3" data-toggle="tab">
                                        Recent Users </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="scroller" style="height: 290px;" data-always-visible="1"
                                         data-rail-visible="0">
                                        <ul class="feeds">
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                You have 4 pending tasks. <span
                                                                        class="label label-sm label-danger ">
                                                                                                                                                                                                                                Take action <i
                                                                            class="fa fa-share"></i>
                                                                                                                                                                                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        Just now
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">
                                                                    New version v1.4 just lunched!
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">
                                                            20 mins
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-danger">
                                                                <i class="fa fa-bolt"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                Database server #12 overloaded. Please fix the issue.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        24 mins
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        30 mins
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        40 mins
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-warning">
                                                                <i class="fa fa-plus"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New user registered.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        1.5 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                Web server hardware needs to be upgraded. <span
                                                                        class="label label-sm label-default ">
                                                                                                                                                                                                                            Overdue </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        2 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        3 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-warning">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        5 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        18 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        21 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        22 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        21 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        22 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        21 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        22 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        21 hours
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received. Please take care of it.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        22 hours
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_1_2">
                                    <div class="scroller" style="height: 290px;" data-always-visible="1"
                                         data-rail-visible1="1">
                                        <ul class="feeds">
                                            <li>
                                                <a href="#">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">
                                                                    New user registered
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">
                                                            Just now
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">
                                                                    New order received
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">
                                                            10 mins
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-danger">
                                                                <i class="fa fa-bolt"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                Order #24DOP4 has been rejected. <span
                                                                        class="label label-sm label-danger ">
                                                                                                                                                                                                                        Take action <i
                                                                            class="fa fa-share"></i>
                                                                                                                                                                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        24 mins
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">
                                                                    New user registered
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">
                                                            Just now
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">
                                                                    New user registered
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">
                                                            Just now
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">
                                                                    New user registered
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">
                                                            Just now
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">
                                                                    New user registered
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">
                                                            Just now
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">
                                                                    New user registered
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">
                                                            Just now
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">
                                                                    New user registered
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">
                                                            Just now
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bell-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc">
                                                                    New user registered
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date">
                                                            Just now
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_1_3">
                                    <div class="scroller" style="height: 290px;" data-always-visible="1"
                                         data-rail-visible1="1">
                                        <div class="row">
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Robert Nilson </a>
                                                                                                                                                                                                            <span class="label label-sm label-success label-mini">
                                                                                                                                                                                                               Approved </span>
                                                    </div>
                                                    <div>
                                                        29 Jan 2013 10:45AM
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Lisa Miller </a>
                                                                                                                                                                                                                <span class="label label-sm label-info">
                                                                                                                                                                                                                   Pending </span>
                                                    </div>
                                                    <div>
                                                        19 Jan 2013 10:45AM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Eric Kim </a>
                                                                                                                                                                                                                    <span class="label label-sm label-info">
                                                                                                                                                                                                                       Pending </span>
                                                    </div>
                                                    <div>
                                                        19 Jan 2013 12:45PM
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Lisa Miller </a>
                                                                                                                                                                                                                        <span class="label label-sm label-danger">
                                                                                                                                                                                                                           In progress </span>
                                                    </div>
                                                    <div>
                                                        19 Jan 2013 11:55PM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Eric Kim </a>
                                                                                                                                                                                                                            <span class="label label-sm label-info">
                                                                                                                                                                                                                               Pending </span>
                                                    </div>
                                                    <div>
                                                        19 Jan 2013 12:45PM
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Lisa Miller </a>
                                                                                                                                                                                                                                <span class="label label-sm label-danger">
                                                                                                                                                                                                                                   In progress </span>
                                                    </div>
                                                    <div>
                                                        19 Jan 2013 11:55PM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Eric Kim </a>
                                                                                                                                                                                                                                    <span class="label label-sm label-info">
                                                                                                                                                                                                                                       Pending </span>
                                                    </div>
                                                    <div>
                                                        19 Jan 2013 12:45PM
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Lisa Miller </a>
                                                                                                                                                                                                                                        <span class="label label-sm label-danger">
                                                                                                                                                                                                                                           In progress </span>
                                                    </div>
                                                    <div>
                                                        19 Jan 2013 11:55PM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Eric Kim </a>
                                                                                                                                                                                                                                            <span class="label label-sm label-info">
                                                                                                                                                                                                                                               Pending </span>
                                                    </div>
                                                    <div>
                                                        19 Jan 2013 12:45PM
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Lisa Miller </a>
                                                                                                                                                                                                                                                <span class="label label-sm label-danger">
                                                                                                                                                                                                                                                   In progress </span>
                                                    </div>
                                                    <div>
                                                        19 Jan 2013 11:55PM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Eric Kim </a>
                                                                                                                                                                                                                                                    <span class="label label-sm label-info">
                                                                                                                                                                                                                                                       Pending </span>
                                                    </div>
                                                    <div>
                                                        19 Jan 2013 12:45PM
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 user-info">
                                                <img alt="" src="{{asset('assets/admin/layout/img/avatar.png')}}"
                                                     class="img-responsive"/>

                                                <div class="details">
                                                    <div>
                                                        <a href="#">
                                                            Lisa Miller </a>
                                                                                                                                                                                                                                                        <span class="label label-sm label-danger">
                                                                                                                                                                                                                                                           In progress </span>
                                                    </div>
                                                    <div>
                                                        19 Jan 2013 11:55PM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END TABS-->
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
        <div class="clearfix">
        </div>
        <div class="row ">
            <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
                <div class="portlet box blue-madison calendar">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-calendar"></i>Calendar
                        </div>
                    </div>
                    <div class="portlet-body light-grey">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
            <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
                <div class="portlet">
                    <div class="portlet-title line">
                        <div class="caption">
                            <i class="fa fa-comments"></i>Chats
                        </div>
                        <div class="tools">
                            <a href="#" class="collapse">
                            </a>
                            <a href="#portlet-config" data-toggle="modal" class="config">
                            </a>
                            <a href="#" class="reload">
                            </a>
                            <a href="#" class="fullscreen">
                            </a>
                            <a href="#" class="remove">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body" id="chats">
                        <div class="scroller" style="height: 352px;" data-always-visible="1" data-rail-visible1="1">
                            <ul class="chats">
                                <li class="in">
                                    <img class="avatar" alt="" src="{{asset('assets/admin/layout/img/avatar1.jpg')}}"/>

                                    <div class="message">
                                                                                                                                                                                                                                       <span class="arrow">
                                                                                                                                                                                                                                       </span>
                                        <a href="#" class="name">
                                            Bob Nilson </a>
                                                                                                                                                                                                                                        <span class="datetime">
                                                                                                                                                                                                                                           at 20:09 </span>
                                                                                                                                                                                                                                           <span class="body">
                                                                                                                                                                                                                                               Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="out">
                                    <img class="avatar" alt="" src="{{asset('assets/admin/layout/img/avatar2.jpg')}}"/>

                                    <div class="message">
                                                                                                                                                                                                                                           <span class="arrow">
                                                                                                                                                                                                                                           </span>
                                        <a href="#" class="name">
                                            Lisa Wong </a>
                                                                                                                                                                                                                                            <span class="datetime">
                                                                                                                                                                                                                                               at 20:11 </span>
                                                                                                                                                                                                                                               <span class="body">
                                                                                                                                                                                                                                                   Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="in">
                                    <img class="avatar" alt="" src="{{asset('assets/admin/layout/img/avatar1.jpg')}}"/>

                                    <div class="message">
                                                                                                                                                                                                                                               <span class="arrow">
                                                                                                                                                                                                                                               </span>
                                        <a href="#" class="name">
                                            Bob Nilson </a>
                                                                                                                                                                                                                                                <span class="datetime">
                                                                                                                                                                                                                                                   at 20:30 </span>
                                                                                                                                                                                                                                                   <span class="body">
                                                                                                                                                                                                                                                       Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="out">
                                    <img class="avatar" alt="" src="{{asset('assets/admin/layout/img/avatar3.jpg')}}"/>

                                    <div class="message">
                                                                                                                                                                                                                                                   <span class="arrow">
                                                                                                                                                                                                                                                   </span>
                                        <a href="#" class="name">
                                            Richard Doe </a>
                                                                                                                                                                                                                                                    <span class="datetime">
                                                                                                                                                                                                                                                       at 20:33 </span>
                                                                                                                                                                                                                                                       <span class="body">
                                                                                                                                                                                                                                                           Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="in">
                                    <img class="avatar" alt="" src="{{asset('assets/admin/layout/img/avatar3.jpg')}}"/>

                                    <div class="message">
                                                                                                                                                                                                                                                       <span class="arrow">
                                                                                                                                                                                                                                                       </span>
                                        <a href="#" class="name">
                                            Richard Doe </a>
                                                                                                                                                                                                                                                        <span class="datetime">
                                                                                                                                                                                                                                                           at 20:35 </span>
                                                                                                                                                                                                                                                           <span class="body">
                                                                                                                                                                                                                                                               Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="out">
                                    <img class="avatar" alt="" src="{{asset('assets/admin/layout/img/avatar1.jpg')}}"/>

                                    <div class="message">
                                                                                                                                                                                                                                                           <span class="arrow">
                                                                                                                                                                                                                                                           </span>
                                        <a href="#" class="name">
                                            Bob Nilson </a>
                                                                                                                                                                                                                                                            <span class="datetime">
                                                                                                                                                                                                                                                               at 20:40 </span>
                                                                                                                                                                                                                                                               <span class="body">
                                                                                                                                                                                                                                                                   Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="in">
                                    <img class="avatar" alt="" src="{{asset('assets/admin/layout/img/avatar3.jpg')}}"/>

                                    <div class="message">
                                                                                                                                                                                                                                                               <span class="arrow">
                                                                                                                                                                                                                                                               </span>
                                        <a href="#" class="name">
                                            Richard Doe </a>
                                                                                                                                                                                                                                                                <span class="datetime">
                                                                                                                                                                                                                                                                   at 20:40 </span>
                                                                                                                                                                                                                                                                   <span class="body">
                                                                                                                                                                                                                                                                       Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="out">
                                    <img class="avatar" alt="" src="{{asset('assets/admin/layout/img/avatar1.jpg')}}"/>

                                    <div class="message">
                                                                                                                                                                                                                                                                   <span class="arrow">
                                                                                                                                                                                                                                                                   </span>
                                        <a href="#" class="name">
                                            Bob Nilson </a>
                                                                                                                                                                                                                                                                    <span class="datetime">
                                                                                                                                                                                                                                                                       at 20:54 </span>
                                                                                                                                                                                                                                                                       <span class="body">
                                                                                                                                                                                                                                                                           Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. sed diam nonummy nibh euismod tincidunt ut laoreet. </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="chat-form">
                            <div class="input-cont">
                                <input class="form-control" type="text" placeholder="Type a message here..."/>
                            </div>
                            <div class="btn-cont">
                                                                                                                                                                                                                                                             <span class="arrow">
                                                                                                                                                                                                                                                             </span>
                                <a href="#" class="btn blue icn-only">
                                    <i class="fa fa-check icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
    @endif
    @if(Session::get('managelevel')=='2'||Session::get('managelevel')=='4')
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
			<span>
			新的文章请不要在旧文章链接中修改，会导致数据统计不准确。</span>
        </div>
        <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            $row = DB::table('wx_user_info')
                                    ->where('eventkey', Session::get('eventkey'))
                                    ->count();
                            echo $row;
                            ?>
                        </div>
                        <div class="desc">
                            总关注数
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php
                            $row = DB::table('wx_article')
                                    ->where('eventkey', Session::get('eventkey'))
                                    ->where('del', '0')
                                    ->whereDate('adddate', '>=', '2017-1-1')
                                    ->count();
                            echo $row;
                            ?>
                        </div>
                        <div class="desc">
                            2017年文章数
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green-haze">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php

                                //2017年阅读数统计
                            /*$row_hits=DB::table('wx_article_hits')->join('wx_article',function($join){
                                $join->on('wx_article_hits.article_id','=','wx_article.id')
                                        ->where('wx_article.del','=',0)
                                        ->where('wx_article_hits.adddate', '>=', '2017-1-1')
                                        ->where('wx_article.eventkey','=',Session::get('eventkey'));
                            })->count();*/

                            $row = DB::table('wx_order_send')
                                    ->whereDate('adddate', '>=', '2017-1-1')
                                    ->where('eventkey', Session::get('eventkey'))
                                    ->count();
                            echo $row;

                            ?>
                        </div>
                        <div class="desc">
                            2017年订单数
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="getqrcode" data-target="#long" data-toggle="modal" data-src="qrcode_create/{!! Session::get('eventkey') !!}">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">

                        <div class="number">
                            市场二维码下载
                        </div>

                    </div>
                    <a class="getqrcode more" data-target="#long" data-toggle="modal" data-src="qrcode_create/{!! Session::get('eventkey') !!}">

                    View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
                    </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN INLINE NOTIFICATIONS PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>可复制内容
                        </div>

                    </div>
                    <div class="portlet-body">

                        <?php
                        $rows = DB::table('wx_article')
                                ->where('allow_copy', '1')
                                ->where('del', '0')
                                ->where('audit', '1')
                                ->where('online', '1')
                                ->orderBy('id', 'desc')
                                ->get();
                        if ($rows)
                        {
                        foreach ($rows as $row){
                        ?>
                        <div class="alert alert-block alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert"></button>
                            <h4 class="alert-heading">{!! $row->title !!}</h4>

                            <p>
                                <a class="btn green" href="articlecopy?id={!! $row->id !!}">
                                    复 制 </a>

                            </p>
                        </div>
                        <?php }}?>
                    </div>
                </div>
            </div>
        </div>
        <!--弹出层-->
        <div id="long" class="modal fade " tabindex="-1" data-replace="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{!! Session::get('username') !!}市场二维码</h4>
            </div>
            <div class="modal-body">
                {{--<img id='qr'  src="../../../../../../i.imgur.com/KwPYo.jpg">--}}
                <iframe id='qr' src="http://www.lesson.me" style="border:none; width:500px; height:500px;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">关闭</button>
            </div>
        </div>
        <!--结束弹出层-->
        @endif
        @stop

        @section('js')
                <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.categories.min.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery.pulsate.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/moment.min.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"
                type="text/javascript"></script>
        <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
        <script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!-- BEGIN 图 LEVEL PLUGINS -->
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.min.js')}}"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.resize.min.js')}}"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.pie.min.js')}}"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.stack.min.js')}}"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.crosshair.min.js')}}"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.categories.min.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('assets/admin/pages/scripts/charts-flotcharts.js')}}"></script>
        <!-- END 图 LEVEL PLUGINS -->
        <script src="{{asset('assets/admin/pages/scripts/index.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/pages/scripts/tasks.js')}}" type="text/javascript"></script>
        <script src="{{asset('lib/function.js')}}"></script>

        <script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/pages/scripts/ui-extended-modals.js')}}"></script>
@stop

@section('init')

    Index.init();
    Index.initDashboardDaterange();
    Index.initJQVMAP(); // init index page's custom scripts
    Index.initCalendar(); // init index page's custom scripts
    Index.initCharts(); // init index page's custom scripts
    Index.initChat();
    Index.initMiniCharts();
    Tasks.initDashboardWidget();
    ChartsFlotcharts.init();
    ChartsFlotcharts.initCharts();
    ChartsFlotcharts.initPieCharts();
    ChartsFlotcharts.initBarCharts();

    $(".getqrcode").click(function () {
      //  alert($(this).attr('data-src'));
    $("#qr").attr({"src": $(this).attr("data-src")});
    });

@stop