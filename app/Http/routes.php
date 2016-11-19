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

Route::get('test','Test\TestController@index');

Route::get('index', function () {
    return view('test.test');
});


Route::get('control/login','UsersController@signin');
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

    //二维码管理
    Route::get('qradd','Control\QrlistController@add');
    Route::get('qrmodify','Control\QrlistController@modify');
    Route::post('qrsave','Control\QrlistController@save');
    Route::get('qrsearch','Control\QrlistController@search');
    Route::get('qrlist', 'Control\QrlistController@index');
    Route::get('qrlist1', 'Control\QrlistController@test');

    Route::get('clickcount','Control\DataController@click');
});