<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\WeChat\Usage;
use EasyWeChat\Foundation\Application;
use App\WeChat\Count;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Intervention\Image\Facades\Image;

class ApiController extends Controller
{
    public $usage;
    public $app;
    public $qrcode;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->qrcode = $this->app->qrcode;
        $this->usage = new Usage();
    }

    public function ldjl()
    {
        $row = DB::table('wx_qrscene_temp_info')
            ->where('qrscene_id', '1306')
            ->first();
        $qr_id = $row->qrscene_id;
        $qr_expire = $row->expireseconds * 60;
        if ($row->qrscene_logo) {
            $qr_logo = $row->qrscene_logo;
        } else {
            $qr_logo = 'qr/logo.png';
        }

        $result = $this->qrcode->temporary($qr_id, $qr_expire);
        $ticket = $result->ticket;// 或者 $result['ticket']

        $QR = $this->qrcode->url($ticket);
        $logo = $qr_logo;
        $img = Image::make($QR);
        $img->insert($logo, 'center');
        return $img->response('png');
    }
}
