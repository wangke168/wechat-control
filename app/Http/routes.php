<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('index', function () {
    return view('test.test');
});


Route::get('control/login', 'UsersController@signin');
Route::get('control/login.php', 'UsersController@signin');
Route::get('control/Login.php', 'UsersController@signin');
Route::post('control/login', 'UsersController@login');

Route::group(['prefix' => 'control', 'middleware' => 'control'], function () {
    Route::get('index', function () {
        // Matches The "/control/index" URL
        return view('control.index');
    });

    Route::get('articlehits', function () {
        return view('control.mark_count');
    });

  //  Route::get('json/qrscene', 'JsonController@qrscene');

    //用户管理
    Route::get('logout', 'UsersController@logout');
    //文章管理
    Route::get('articlelist', 'Control\ArticleController@articleList');
    Route::get('articlemodify', 'Control\ArticleController@articleModify');
    Route::get('articlesearch', 'Control\ArticleController@articleSearch');
    Route::get('articleadd', 'Control\ArticleController@articleAdd');
    Route::post('articlesave', 'Control\ArticleController@articleSave');
    Route::get('articlecopy', 'Control\ArticleController@articleCopy');
//预览二维码
    Route::get('qrcreat', 'Control\ArticleController@review_qr');


    Route::get('articleadd1', 'Control\ArticleController@articleAdd1');

    //回复管理
    Route::get('requesttxt', 'Control\RequestController@txt');
    Route::post('requesttxt', 'Control\RequestController@txt');

    //语音回复
    Route::get('requestvoice', 'Control\RequestController@voice');
    Route::post('requestvoice', 'Control\RequestController@voice');

    //二次回复
    Route::get('request_se', 'Control\RequestController@se');
    Route::post('request_se', 'Control\RequestController@se');

    Route::get('requestmodify', 'Control\RequestController@request_modify');

    //数据统计
    Route::get('menuclickcount', 'Control\DataController@click');
    Route::post('menuclickcount', 'Control\DataController@countSearch');

    Route::get('ordercount', 'Control\DataController@ordersend');
    Route::get('ordercountsearch', 'Control\DataController@ordersend_search');
    Route::get('orderaction', 'Control\DataController@orderaction');
    //市场数据统计
    Route::get('countmarket', 'Control\DataController@market');
    Route::post('countmarket', 'Control\DataController@market');

    //二维码管理
    Route::get('qradd', 'Control\QrlistController@add');
    Route::get('qrmodify', 'Control\QrlistController@modify');
    Route::post('qrsave', 'Control\QrlistController@save');
    Route::get('qrsearch', 'Control\QrlistController@search');
    Route::get('qrlist', 'Control\QrlistController@index');
    Route::get('qrlist1', 'Control\QrlistController@test');

    Route::get('qrtemp', 'Control\QrlistController@qrtemp');
    Route::post('qrtemp', 'Control\QrlistController@qrtemp');
    //获取带参二维码
    Route::get('qrcode_create/{id}', 'Control\QrlistController@create');

    Route::get('qrcode_temp_create/{id}', 'Control\QrlistController@create_temp');

    Route::get('json/qrscene', 'Control\JsonController@qrscene');
    //菜单查询
    Route::get('menulist', 'Control\MenuController@menuList');

    //标签管理
    Route::any('tag', 'Control\TagController@index');


    Route::get('message', 'Control\MessageController@index');

    //演艺秀管理
    Route::get('showlist', 'Control\ZoneController@showlist');
    Route::post('showlist', 'Control\ZoneController@showlist');
    //景区演艺秀推送
    Route::any('pushproject', 'Control\ZoneController@push');

    //企业号推广联盟管理
    Route::any('tglm', 'Control\QyController@tglm');

    //代理商订单衔接
    Route::any('agentinterface', 'Control\AgentController@index');
    Route::any('agentordercancel', 'Control\AgentController@OrderCancel');
    Route::any('agentproduct', 'Control\AgentController@AgentProduct');
    Route::any('agentsycnlist', 'Control\AgentController@AgentOrderSyncList');
    Route::any('agentcancellist', 'Control\AgentController@AgentOrderCancelList');
    //修改密码
    Route::any('changpassword', 'UsersController@changpwd');

});

//对外
Route::get('api/ldjl', 'Api\ApiController@ldjl');        //龙帝惊临每天获取二维码(有效期12小时)

Route::get('api/mobile', 'Api\ApiController@api_mobile');
//景区导览图
Route::get('zone/map', 'ZoneController@map');


Route::get('test', 'Test\TestController@test');
Route::get('soap','Test\SoapController@index');
Route::get('json/userdairydetail', 'Control\DataController@user_dairy_detail');
Route::get('esc', 'Test\TestController@take_esc_json');
Route::get('json/orderdairydetail', 'Control\DataController@order_dairy_detail');