<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;

class MenuController extends Controller
{
/*    public $app;
    public function __construct(Application $app)
    {
        $this->app=$app;
    }*/

    public function menuList()
    {
        return "221";
//        $ACCESS_TOKEN=$this->app->access_token->getToken();
        $token_url = "http://wechat.hengdianworld.com/hd-token";
        $ACCESS_TOKEN = file_get_contents($token_url);
       return $ACCESS_TOKEN;


//        return $ACCESS_TOKEN;

        $menu_url='https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$ACCESS_TOKEN;
        $menu_list=file_get_contents($menu_url);
        $menu_list=json_decode($menu_list,true);

   /*     foreach ($menu_list['menu']['button'] as  $key=> $menu)
        {
            echo  $menu['name'].'<br>';
            foreach ($menu['sub_button'] as $key=>$menu_name)
            {
                echo $menu_name['name'].'<br>';

            }
        }

        foreach ($menu_list['conditionalmenu'] as $key=> $menu)
        {
            echo $menu['matchrule']['group_id'];
            foreach ($menu['button'] as $key=>$menu_button)
            {
                echo ($menu_button['name']).'<br>';

                foreach ($menu_button['sub_button'] as $menu_name)
                {
                    echo ($menu_name['name']).'<br>';

                }
            }
        }*/

        return view('control.menu_list',compact('menu_list'));
    }
}
