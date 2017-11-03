@extends('control.blade.data')

@section('title', '横店圆明新园微信管理平台－－－代理商订单同步')

@section('css')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/global/plugins/jquery-multi-select/css/multi-select.css')}}"/>
    <!--上传-->
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet">
@stop
<script language="JavaScript">

    function button123() {
        var x=document.getElementById("orderinfo");
     /*   alert(x.value);
        alert((x.value.split(" ") + "<br />"));*/

        params = x.value.split("\t");
//        alert(params[0].split(" "));
//        alert(params[0]);
        params_child1=params[0].split(" ");
//        alert(params_child1);
        params_child2=params[7].split(" ");
        CompanyOrderID=params_child1[0].replace(/订单号：/,"");

//        alert (CompanyOrderID.length);
        if (CompanyOrderID.length==10)
        {
            document.getElementById("CompanyName").value='携程单订门票';
            document.getElementById("CompanyCode").value='xcddmpowurop';
            companycode='xcddmpowurop';
        }
        if(params_child1[4]==''){
            product_name=params_child1[5]
        }
        else{
            product_name=params_child1[4];
        }
//        alert(CompanyOrderID);
        document.getElementById("CompanyOrderID").value=CompanyOrderID;
        document.getElementById("Products").value=product_name;
        document.getElementById("OrderTime").value=params[3];
        document.getElementById("ArrivalDate").value=params[4];
        document.getElementById("VisitorName").value=params[6];
        document.getElementById("VisitorMobile").value=params_child2[0];
        document.getElementById("Number").value=params_child2[1];

//        alert($.get('/control/agentinterface?type=getproductid&productname=abc&companycode=xcddmpowurop'));
        product_name=product_name.replace(/[+]/g,"%2B");
//        alert(product_name);
        $.ajax({
            type : "GET",
            url: '/control/agentinterface?action=getproductid&productname='+product_name+'&CompanyCode='+companycode,//后台映射的URL
//            data:$("#saveForm").serializeArray(),//往后台传的参数
//            dataType:'json',//返回的数据格式
            success : function(result) {
                document.getElementById("ProductID").value=result;
                //result即你的返回值
                //ajax请求成功执行的函数
            },
            error : function(result) {

            }
        });


    }

</script>
@section('page-menu-title', '代理商')
@section('page-title', '订单推送')
@section('page-bar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">代理商订单推送</a>
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

                    <div class="caption"><i class="icon-comments"></i>添加信息</div>

                    <div class="tools">

                        <a href="javascript:;" class="collapse"></a>

                    </div>

                </div>

                <div class="portlet-body form">

                    {!! Form::open(['url'=>'/control/agentinterface?action=addorder', 'onclick'=>'check','class'=>'form-horizontal form-bordered','id'=>'postForm']) !!}


                    <div class="form-body">


                        <div class="form-group">

                            <label class="control-label  col-md-1">订单信息</label>

                            <div class="col-md-11">
                                <div class="input-group">
                                   <input id="orderinfo" type="text" placeholder="订单信息" class="form-control"
                                           name="orderinfo" value=""/>
                                    {{--<textarea class="input-block-level" id="orderinfo" name="orderinfo" rows="5" style="width: 300px"></textarea>--}}
                                    <span class="input-group-btn">
                                     <button type="button" class="btn btn-Danger" onclick="button123()"><i
                                                 class="fa fa-arrow-left fa-fw"></i> 分 解</button>
	                                </span>
                                </div>
                            </div>
                        </div>

                          <div class="form-group">

                               <label class="control-label  col-md-1">代理商名称</label>

                               <div class="col-md-11">
                                   <input id="CompanyName" type="text"  placeholder="代理商名称" class="form-control input-large"
                                          name="CompanyName"/>
                               </div>

                           </div>
                        <div class="form-group">

                            <label class="control-label  col-md-1">代理商编号</label>

                            <div class="col-md-11">
                                <input id="CompanyCode" type="text"  placeholder="代理商名称" class="form-control input-large"
                                       name="CompanyCode"/>
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label  col-md-1">代理商订单号</label>

                            <div class="col-md-11">

                                <input id="CompanyOrderID" type="text" placeholder="代理商订单号" class="form-control input-large"
                                       name="CompanyOrderID"/>

                            </div>

                        </div>
                        <div class="form-group">

                            <label class="control-label  col-md-1">预订门票</label>

                            <div class="col-md-11">

                                <input id="Products" type="text" placeholder="预订门票" class="form-control input-large"
                                       name="Products"/>

                            </div>

                        </div>
                        <div class="form-group">

                            <label class="control-label  col-md-1">门票ID</label>

                            <div class="col-md-5">

                                <input id="ProductID" type="text" placeholder="门票ID" class="form-control input-large"
                                       name="ProductID"/>

                            </div>
                            @if(Session::has('check'))
                                <div class="alert alert-danger">
                                    <button class="close" data-close="alert"></button>
                                    <span>该门票未绑定ID </span>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">

                            <label class="control-label  col-md-1">预达日期</label>

                            <div class="col-md-11">

                                <input id="ArrivalDate" type="text" placeholder="预达日期" class="form-control input-large"
                                       name="ArrivalDate"/>


                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">游客姓名</label>

                            <div class="col-md-11">

                                <input id="VisitorName" type="text" placeholder="游客姓名" class="form-control input-large"
                                       name="VisitorName"/>


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">游客手机号</label>

                            <div class="col-md-11">

                                <input id="VisitorMobile" type="text" placeholder="游客手机号" class="form-control input-large"
                                       name="VisitorMobile"/>


                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">人数</label>

                            <div class="col-md-11">

                                <input id="Number" type="text" placeholder="人数" class="form-control input-large"
                                       name="Number"/>


                            </div>
                        </div>
                        <div class="form-group">

                            <label class="control-label  col-md-1">供应商下单时间</label>

                            <div class="col-md-11">

                                <input id="OrderTime" type="text" placeholder="供应商下单时间" class="form-control input-large"
                                       name="OrderTime"/>

                            </div>

                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green"><i class="fa fa-check"></i> 提 交</button>
                                    <button type="button" class="btn default">Cancel</button>
                                </div>
                            </div>
                        </div>

                        <!--END TABS-->
                    </div>
                    {!! Form::close() !!}

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
    <!--上传-->
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}"></script>
@stop