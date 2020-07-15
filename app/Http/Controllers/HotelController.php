<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HotelController extends Controller
{
    //

    //酒店介绍
    public function detail(Request $request)
    {
        $id = $request->input('id');
        switch ($id) {
            case '1':
                return view('hotel.gxj');
                break;
            case '2':
                return view('hotel.blh');
                break;
            case '10':
                return view('hotel.gmds');
                break;
            default:
                break;
        }
    }

    public function order(Request $request)
    {
        $id = $request->input('id');
        $nativepay = $request->input('nativepay');

        if ($nativepay==null) {
            $nativepay = 1;
        }
        if ($id) {
            $result = \DB::table('Hotel_ID')
                ->where('id', $id)
                ->first();
            $hotel_name = $result->Hotel_Name;
            $hotel_id = $result->ID;
            $hotel_detail_pic = "/media/image/hotel_sell/1-" . $id . '.jpg';
        }
        else{
            $hotel_name = '公共酒店';
            $hotel_id = '';
            $hotel_detail_pic = '';
        }
        return view('hotel.order', compact('hotel_name', 'hotel_detail_pic', 'hotel_id','id', 'nativepay'));
    }


    /**
     * 增加点击数
     * @param $id
     */
    private function add_click($action, $id, $ip_address, $openid = null)
    {
        DB::table('Hotel_ID')
            ->where('id', $id)
            ->increment('Count');
        DB::table('Hotel_ID_Click_Detail')
            ->insert(['hotel_id' => $id, 'ip_address' => $ip_address, 'type' => $action, 'openid' => $openid, 'addtime' => Carbon::now()]);

    }

}
