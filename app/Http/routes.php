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


Route::get('control/login','UsersController@signin');
Route::get('control/login.php','UsersController@signin');
Route::get('control/Login.php','UsersController@signin');
Route::post('control/login','UsersController@login');

Route::group(['prefix' => 'control','middleware' => 'control'], function () {
    Route::get('index', function () {
        // Matches The "/control/index" URL
        return view('control.index');
    });

    Route::get('articlehits', function () {
        return view('control.mark_count');
    });

    Route::get('json/qrscene','JsonController@qrscene');

    //用户管理
    Route::get('logout','UsersController@logout');
    //文章管理
    Route::get('articlelist','Control\ArticleController@articleList');
    Route::get('articlemodify','Control\ArticleController@articleModify');
    Route::get('articlesearch','Control\ArticleController@articleSearch');
    Route::get('articleadd','Control\ArticleController@articleAdd');
    Route::post('articlesave','Control\ArticleController@articleSave');
    Route::get('articlecopy','Control\ArticleController@articleCopy');
//预览二维码
    Route::get('qrcreat/{id}','Control\ArticleController@review_qr');


    Route::get('articleadd1','Control\ArticleController@articleAdd1');

    //回复管理
    Route::get('requesttxt','Control\RequestController@txt');
    Route::get('requestse','Control\RequestController@se');

    Route::get('requestmodify','Control\RequestController@request_modify');

    //数据统计
    Route::get('menuclickcount','Control\DataController@click');
    Route::post('menuclickcount','Control\DataController@countSearch');

    Route::get('ordercount','Control\DataController@ordersend');
    Route::get('ordercountsearch','Control\DataController@ordersend_search');
    Route::get('orderaction','Control\DataController@orderaction');

    //二维码管理
    Route::get('qradd','Control\QrlistController@add');
    Route::get('qrmodify','Control\QrlistController@modify');
    Route::post('qrsave','Control\QrlistController@save');
    Route::get('qrsearch','Control\QrlistController@search');
    Route::get('qrlist', 'Control\QrlistController@index');
    Route::get('qrlist1', 'Control\QrlistController@test');
    //获取带参二维码
    Route::get('qrcode_create/{id}','Control\QrlistController@create');

    //菜单查询
    Route::get('menulist','Control\MenuController@menuList');

    //标签管理
    Route::any('tag','Control\TagController@index');


    Route::get('message','Control\MessageController@index');

    //景区演艺秀推送
    Route::any('pushproject','Control\PushController@project');

    //企业号推广联盟管理
    Route::any('tglm','Control\QyController@tglm');

    //修改密码
    Route::any('changpassword','UsersController@changpwd');

});

Route::get('test','Test\TestController@test');

Route::get('json/userdairydetail','Control\DataController@user_dairy_detail');
Route::get('esc','Test\TestController@take_esc_json');
Route::get('json/orderdairydetail','Control\DataController@order_dairy_detail');