<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\WeChat\Api;
use App\WeChat\Usage;
use App\WeChat\Zone;
use Carbon\Carbon;
use EasyWeChat\Foundation\Application;
use App\WeChat\Count;
use EasyWeChat\Message\Text;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SoapClient;

class TestController extends Controller
{

    public $usage;
    public $app;
    public $qrcode;
    public $zone;
    public $staff;
    public $session;
    public $material;
    private $SoapClint;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->qrcode = $this->app->qrcode;
        $this->staff = $app->staff;
        $this->usage = new Usage();
        $this->zone = new Zone();
        $this->session = $app->staff_session; // 客服会话管理

        $this->material = $app->material;
//        $wsdl = env('AGENT_WSDL', '');
//        $this->SoapClint = new SoapClient($wsdl);
    }

    public function test1()
    {
//        $app = app('wechat');
        $image=$this->material->get("y1_Ypabgd3rcrb6YdsaJjlGFUD20hq_ye7S9pgdpiJBtdWR5RsTJhCIR-ponseyY");
        var_dump($image);
    }
    private function pkcsPadding($str, $blocksize)
    {
        $pad = $blocksize - (strlen($str) % $blocksize);
        return $str . str_repeat(chr($pad), $pad);
    }
    private function unPkcsPadding($str)
    {
        $pad = ord($str{strlen($str) - 1});
        if ($pad > strlen($str)) {
            return false;
        }
        return substr($str, 0, -1 * $pad);
    }

    public function temp()
    {
        $a = 1;
        $b = 1;
        $c = 1;
        $d = 1;
        $e = 1;
        $f = 1;
        $g = 1;
        $u = 0.1;
        $v = 0.1;
        $w = 0.1;
        $x = 0.1;
        $y = 0.1;
        $z = 0.1;
        for ($i = 0; $i <= 20; $i++) {
            $result1 = 0 * $a + 2 * $a * (23 / 27) + 0 * $a * (21 / 27) + 1 * $a * (18 / 27) + 1 * $a * (14 / 27) + 2 * $a * (11 / 27) + 0 * $a * (8 / 27);
            $result2 = 0 * $b + 2 * $b * (23 / 27) + 1 * $b * (21 / 27) + 1 * $b * (18 / 27) + 3 * $b * (14 / 27) + 1 * $b * (11 / 27) + 1 * $b * (8 / 27);
            $result3 = 1 * $c + 2 * $c * (23 / 27) + 1 * $c * (21 / 27) + 2 * $c * (18 / 27) + 5 * $c * (14 / 27) + 3 * $c * (11 / 27) + 0 * $c * (8 / 27);
            $result4 = 0 * $d + 1 * $d * (23 / 27) + 1 * $d * (21 / 27) + 1 * $d * (18 / 27) + 0 * $d * (14 / 27) + 2 * $d * (11 / 27) + 1 * $d * (8 / 27);
            $result5 = 1 * $e + 1 * $e * (23 / 27) + 4 * $e * (21 / 27) + 0 * $e * (18 / 27) + 2 * $e * (14 / 27) + 5 * $e * (11 / 27) + 1 * $e * (8 / 27);
            $result6 = 0 * $f + 0 * $f * (23 / 27) + 1 * $f * (21 / 27) + 9 * $f * (18 / 27) + 5 * $f * (14 / 27) + 2 * $f * (11 / 27) + 0 * $f * (8 / 27);
            $result = $result1 + $result2 + $result3 + $result4 + $result5 + $result6;
            echo $result1 . '_' . $result2 . '_' . $result3 . '_' . $result4 . '_' . $result5 . '_' . $result6 . '_' . $result . '_' . $a . "</br>";


            $a = $a + 1;
            $b = $a;
            $c = $a;
            $d = $a - 1;
            $e = $a - 2;
            $f = $a - 3;
        }

    }

    public function create()
    {


        $id = '101';

        $app = app('wechat');
        $qrcode = $app->qrcode;
        $result = $this->qrcode->forever($id);// 或者 $qrcode->forever("foo");
        return $result;
        $ticket = $result->ticket; // 或者 $result['ticket']
        if ($row->qrscene_logo) {
            $qr_logo = $row->qrscene_logo;
        } else {
            $qr_logo = 'qr/logo.png';
        }
        /* $QR = $qrcode->url($ticket);
         $logo = $qr_logo;
         $img = Image::make($QR);
         $img->insert($logo, 'center');
         return $img->response('png');*/
        return $this->create_qr($ticket, $qr_logo);
    }

    private function create_qr($ticket, $qr_logo)
    {
        $QR = $this->qrcode->url($ticket);
        $logo = $qr_logo;
        $img = Image::make($QR);
        $img->insert($logo, 'center');
        return $img->response('png');
    }


    public function index(Request $request)
    {
        $action = $request->action;
        switch ($action) {
            case 'orderquery':
                var_dump($this->TestQuery('DL20180103033707', 'mtddmp12738yhs'));
                break;
            default:
                break;
        }
    }

    /**
     * 测试美团查询接口
     * @param $OrderID
     * @param $CompanyCode
     */
    private function TestQuery($CompanyOrderID, $CompanyCode)
    {
        $TimeStamp = date('YmdHis');
        $params = array('TimeStamp' => $TimeStamp,
            'CompanyCode' => $CompanyCode,
            'CompanyOrderID' => $CompanyOrderID,
//            'IdCardNeed' => 'dfs',
        );
        $response = $this->SoapClint->OrderStatusCheck(array('orderInfo' => $params));
//        return $response;
        $ErrorMsg = $response->OrderStatusCheckResult;
        return $ErrorMsg;
    }


    public function test()
    {
//        echo 'sdaa';
        $rows = DB::table('Report_2021')
            ->where('guest_city', '=', '')
            ->where('guest_tel', '<>', '')
            ->orderBy('ID', 'asc')
            ->skip(0)
            ->take(500)
            ->get();
//        var_dump($rows);
        if ($rows) {
            foreach ($rows as $row) {
                try {
                    $json = file_get_contents("http://cx.shouji.360.cn/phonearea.php?number=" . $row->guest_tel);
                    $data = json_decode($json, true);
                    $province = $data['data']['province'];
                    $city = $data['data']['city'];
//             echo $province;

                    DB::table('Report')
                        ->where('ID', $row->ID)
                        ->update(['guest_province' => $province, 'guest_city' => $city]);
                } catch (Exception $e) {
                    var_dump($e);
                }

            }
        } else {
            echo "同步地区信息已完成";
        }

//                          echo($row->guest_tel.'<br>');

    }

    private function CheckCardBan($eventkey)
    {
        $row = DB::table('wx_card_ban')
            ->where('id', 1)
            ->first();

        $tmparray = explode($eventkey, $row->eventkey);
        if (count($tmparray) > 1) {
            return true;
        } else {
            return false;
        }

    }

    public function GetCardInfo($str)
    {
        $i = 0;
        $j = 0;
        $k = 0;
        $result = explode("+", $str);
        foreach ($result as $value) {
            if (strpos($value, '成人') !== false) {
                $i = $this->GetNumbers($value);
            }
            if (strpos($value, '学生') !== false) {
                $k = $this->GetNumbers($value);
            }
            if (strpos($value, '老人') !== false) {
                $j = $this->GetNumbers($value);
            }
        }
        $aaa = array($i, $j, $k);
        return ($aaa[0]);
    }

    private function GetNumbers($str)
    {
        $result = '';
        for ($x = 0; $x < strlen($str); $x++) {
            if (is_numeric($str[$x])) {
                $result .= $str[$x];
            }

        }
        return $result;
    }


    private function checkNum($number)
    {
        if ($number > 1) {
            throw new \Exception("Value must be 1 or below");
        }
        return true;
    }

    private
    function decode_mime($string)
    {
        $pos = strpos($string, '=?');
//        return $pos;
        if (!is_int($pos)) {
            return $string;
        } else {
            return $string;
        }
    }


    public
    function take_add_json(Request $request)
    {
//        $info[]=array('root'=>'add');
        /*     for ($x=-16; $x<=-1; $x++) {
                 $y=$x+1;
                 $z=$x+16;
                 $from = date("Y-m-d", strtotime($x." day"));
                 $to = date("Y-m-d", strtotime($y." day"));
                 $row = DB::table('wx_user_add')

                     ->whereDate('adddate', '>=', $from)
                     ->whereDate('adddate', '<', $to)
                     ->count();
                 $date=strtotime("2002-02-20 UTC") * 1000;
                 $add[] = array('date' => $z, 'numbers' => $row);
             }*/

        $row_add = DB::table('wx_user_dairy_detail')
            ->orderBy('id', 'desc')
            ->take(15)
            ->get();
        $i = 1;
        $row_add = array_reverse($row_add);
        foreach ($row_add as $key => $row_test) {
            $add[] = array('date' => $i, 'numbers' => $row_test->add);
            $esc[] = array('date' => $i, 'numbers' => $row_test->esc);
            $i = $i + 1;
        }
//        $test=$row_add->add;
//        return $add;

        /*  for ($x=-16; $x<=-1; $x++) {
              $y=$x+1;
              $z=$x+16;
              $from = date("Y-m-d", strtotime($x." day"));
              $to = date("Y-m-d", strtotime($y." day"));
              $row = DB::table('wx_user_esc')

                  ->whereDate('esc_time', '>=', $from)
                  ->whereDate('esc_time', '<', $to)
                  ->count();
              $date=strtotime("2002-02-20 UTC") * 1000;
              $esc[] = array('date' => $z, 'numbers' => $row);
          }
  */

        $info = array('add' => $add, 'esc' => $esc);
        return response()->json($info)->setCallback($request->input('callback'));
    }

    public
    function take_esc_json(Request $request)
    {
        for ($x = 100; $x <= 130; $x++) {
            $y = $x - 1;
            $from = date("Y-m-d", strtotime("-" . $x . " day"));
            $to = date("Y-m-d", strtotime("-" . $y . " day"));
            $row = DB::table('wx_user_esc')
                /*  ->whereDate('adddate', '>=', '2016-10-12')
                  ->whereDate('adddate', '<', '2016-10-13')   */
                ->whereDate('esc_time', '>=', $from)
                ->whereDate('esc_time', '<', $to)
                ->count();
            $date = strtotime("2002-02-20 UTC") * 1000;
            $info[] = array('name' => $date, 'passwd' => $row);
//            $info[] = array(['name' => 'LaravelAcademy', 'passwd' => $row]);
        }
//        echo $row;
        return response()->json($info)->setCallback($request->input('callback'));
    }
}