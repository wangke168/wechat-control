
@extends('control.blade.data')

@section('title', '横店影视城微信管理平台－－－二维码管理')

@section('page-title', '二维码管理')

@section('page-bar')
 <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="index-2.html">Home</a>
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
    <div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box green-haze">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>Datatable with TableTools
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
									 获取二维码
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
                                            $row_count=DB::table('wx_user_info')
                                            ->where('eventkey',$row->qrscene_id)
                                            ->where('esc','0')
                                            ->count();
                                            echo $row_count;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $row_count=DB::table('wx_order_send')
                                                ->where('eventkey',$row->qrscene_id)
                                                ->count();
                                        echo $row_count;
                                        ?>
                                    </td>
                                    <td>
                                        X
                                    </td>
                                </tr>
                            @endforeach
							</tbody>
							</table>

						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>

@stop


