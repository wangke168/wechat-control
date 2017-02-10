@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－数据统计')

@section('page-menu-title', '市场数据')

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
                <a href="#">市场数据</a>
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
                        <i class="fa fa-globe"></i>市场数据
                    </div>
                </div>
                <div class="portlet-body">
                 <!--   <form method="POST" name="myform" action="/control/countmarket?action=search"
                          class="navbar-form navbar-right">-->
                        {!! Form::open(['url'=>'/control/countmarket?action=search',
                 'class'=>'navbar-form navbar-right','id'=>'postForm']) !!}
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
                    {!! Form::close() !!}
                  <!--  </form>-->

                    <!-- /input-group -->
                    @if($type=='default')
                        <table class="table table-striped table-bordered table-hover" id="sample_6">
                            <thead>
                            <tr>
                                <th>
                                    市场
                                </th>
                                <th>
                                    增加关注
                                </th>
                                <th>
                                    取消关注
                                </th>
                                <th>
                                    文章数
                                </th>
                                <th>
                                    点击数
                                </th>
                                <th>
                                    不重复点击数
                                </th>
                                <th>
                                    转发数
                                </th>
                                <th>
                                    订单数
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                        </table>
                    @elseif($type<>'default')
                        <table class="table table-striped table-bordered table-hover" id="sample_6">
                            <thead>
                            <tr>
                                <th>
                                    市场
                                </th>
                                <th>
                                    增加关注
                                </th>
                                <th>
                                    取消关注
                                </th>
                                <th>
                                    文章数
                                </th>
                                <th>
                                    点击数
                                </th>
                                <th>
                                    不重复点击数
                                </th>
                                <th>
                                    转发数
                                </th>
                                <th>
                                    订单数
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td>
                                        {!! $row->qrscene_name !!}
                                    </td>

                                    <td>
                                        <?php
                                        $count = new \App\WeChat\Count();
                                        echo $count->count_market_info('user_add', $row->qrscene_id, $from, $to);
                                        ?>
                                    </td>
                                    <td>
                                        {{ $count->count_market_info('user_esc', $row->qrscene_id, $from, $to)}}
                                    </td>

                                    <td>
                                        {{ $count->count_market_info('articles', $row->qrscene_id, $from, $to)}}
                                    </td>

                                    <td>
                                        {{ $count->count_market_info('articles_hits', $row->qrscene_id, $from, $to)}}
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        {{ $count->count_market_info('articles_resp', $row->qrscene_id, $from, $to)}}
                                    </td>
                                    <td>
                                        {{ $count->count_market_info('order', $row->qrscene_id, $from, $to)}}
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $rows->appends(["from"=>$from,'to'=>$to,'action'=>$action])->render() !!}
                    @endif
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