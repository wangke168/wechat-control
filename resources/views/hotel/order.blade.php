<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width,initial-scale=1">
    <title>{{$hotel_name}}预订</title>
    <link href="{{asset('topic/tcandhotel/css/app.08456d22.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('topic/tcandhotel/css/app.08456d22.css')}}" rel="stylesheet" type="text/css"/>

    <!--<link href=topic/tcandhotel/js/app.bd86460a.js rel=preload as=script>-->
    <!--<link href=topic/tcandhotel/js/chunk-vendors.863b3461.js rel=preload as=script>-->
    <!--<link href=css/app.08456d22.css rel=stylesheet>-->
</head>
<body>
<script>
    // 获取当前日期
    var date = new Date();

    // 获取当前月份
    var nowMonth = date.getMonth() + 1;

    // 获取当前是几号
    var strDate = date.getDate();

    // 添加分隔符“-”
    var seperator = "-";

    // 对月份进行处理，1-9月在前面添加一个“0”
    if (nowMonth >= 1 && nowMonth <= 9) {
        nowMonth = "0" + nowMonth;
    }

    // 对月份进行处理，1-9号在前面添加一个“0”
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }

    // 最后拼接字符串，得到一个格式为(yyyy-MM-dd)的日期
    var nowDate = date.getFullYear() + seperator + nowMonth + seperator + strDate;

    // var a= document.querySelector('.893');
    document.getElementById("links").href="http://www.baidu.com";
    alert(nowDate);
</script>
<div id=app></div>
<?php

$indate = \Carbon\Carbon::today()->toDateString();
$todate = \Carbon\Carbon::tomorrow()->toDateString();
$date = \Carbon\Carbon::today()->toDateString();
$zero1 = date("H:i:s");
$zero2 = "12:30:00";

//if ($hotel_id == 18) {
//    $uid = '677765785F3031';
//} else {
//    $uid = '74616F63616E';
//}
$uid="7A6662786378";
?>
@if ($id=='1' || $id=='10')
    <br>
    <a href="https://job.hdymxy.com/hotel/detail?id={{$id}}"><img
                src="{{$hotel_detail_pic}}" width=100%></a>
    <br>
@endif

<!--买门票送住宿-->

{{--<a href="https://weix2.hengdianworld.com/redirect?type=tc&id=893&hotel_id={{$hotel_id}}&nativepay={{$nativepay}}&uid={{$uid}}"><img--}}
{{--src="{{asset('media/image/hotel_sell/893.jpg')}}" width=100%></a>--}}
<a href="https://hd-control.test/redirect?type=tc&id=893&hotel_id={{$hotel_id}}&nativepay={{$nativepay}}&uid={{$uid}}" id=links><img
            src="{{asset('media/image/hotel_sell/893.jpg')}}" width=100%></a>
<br>

<!--买门票送住宿3天2晚-->
{{--http://e.hengdianworld.com/WeixinOpenId.aspx?nexturl=http://e.hengdianworld.com/yd_tc_s1.aspx?id=32&comedate={{$date}}&wxnumber=&coupon=&statparam=&uid={{$uid}}&nativepay={{$nativepay}}&wpay=&hotelno={{$hotel_id}}--}}
{{--http://e.hengdianworld.com/WeixinOpenId.aspx?nexturl=https://weix2.hengdianworld.com/redirect?type=tc_active&id=18&nativepay=1&uid=677765785F3031--}}
<a href="https://weix2.hengdianworld.com/redirect?type=tc&id=724&hotel_id={{$hotel_id}}&nativepay={{$nativepay}}&uid={{$uid}}"><img
            src="{{asset('media/image/hotel_sell/724.jpg')}}" width=100%></a>

<br>


</body>
</html>
