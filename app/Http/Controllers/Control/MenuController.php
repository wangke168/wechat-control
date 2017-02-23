<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;

class MenuController extends Controller
{
    public $app;
    public $menu;
    public function __construct(Application $app)
    {
        $this->app=$app;
        $this->menu=$app->menu;
    }

    public function menuList(Request $request)
    {
        $action=$request->input('action');
        switch ($action){
            case 'add':
                $buttons = [
                    [
                        "name"       => "活动专区",
                        "sub_button" => [
                            [
                                "type" => "click",
                                "name" => "最新活动",
                                "key"  => "2"
                            ],
                            [
                                "type" => "click",
                                "name" => "横店攻略",
                                "key"  => "19"
                            ],
                        ],
                    ],
                    [
                        "name"       => "我要预订",
                        "sub_button" => [
                            [
                                "type" => "click",
                                "name" => "门票预订",
                                "key"  => "7"
                            ],
                            [
                                "type" => "click",
                                "name" => "特惠（门票+住宿）",
                                "key" => "8"
                            ],
                            [
                                "type" => "click",
                                "name" => "酒店预订",
                                "key" => "9"
                            ],
                            [
                                "type" => "click",
                                "name" => "马拉松报名",
                                "key" => "21"
                            ],
                            [
                                "type" => "view",
                                "name" => "我的订单",
                                "url"  => "http://e.hengdianworld.com/yd_search.aspx"
                            ],
                        ],
                    ],
                    [
                        "name"       => "更多服务",
                        "sub_button" => [
                            [
                                "type" => "click",
                                "name" => "客服电话",
                                "key"  => "13"
                            ],
                            [
                                "type" => "click",
                                "name" => "景区节目时间表",
                                "key"  => "14"
                            ],
                            [
                                "type" => "click",
                                "name" => "剧组拍摄动态",
                                "key" => "15"
                            ],
                            [
                                "type" => "click",
                                "name" => "交通速查/叫出租/导航",
                                "key" => "16"
                            ],
                        ],
                    ],
                ];
//                $this->menu->add($buttons);
                break;
            case 'modify':
                /*$this->menu->destroy('408720071');
                $this->menu->destroy('413661557');
                     return $this->menu->all();*/

               $menus=$this->menu->all()->menu['button'];
               foreach ($menus as $key=>$menu)
               {
                   echo  $menu['name'].'<br>';
                   foreach ($menu['sub_button'] as $key=>$menu_name)
                   {
                       echo $menu_name['name'].'<br>';

                   }
               }
//               return $menus;
                break;
            default:
                $menus=$this->menu->all();
                return view('control.menu_list',compact('menus'));
            break;
        }
    }
}
