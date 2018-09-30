<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class QyController extends Controller
{
    public function tglm(Request $request)
    {
        $action = $request->input('action');
        switch ($action) {
            case 'add':
                return view('control.qy_tglm_add');
                break;
            case 'save':
//                dd($request->all());
                $name=$request->input('name');
                $tel=$request->input('tel');
                $uid=$request->input('uid');
                $this->Insert_User_Info($name,$tel,$uid);
                return redirect('control/tglm');
                break;
            default:
                $rows = DB::table('qyh_user_info')
                    ->orderBy('id','desc')
                    ->paginate(20);
                return view('control.qy_tglm', compact('rows'));
                break;
        }
    }


    private function Insert_User_Info($name, $tel,$uid)
    {
        $row=DB::table('qyh_user_info')
            ->where('mobile',$tel)
            ->get();
        if($row){

        }
        else{
            DB::table('qyh_user_info')
                ->insert(['name'=>$name,'mobile'=>$tel,'uid'=>$uid]);
            $row_id=DB::table('qyh_user_info')
                ->where('mobile',$tel)
                ->first();
            $id=$row_id->id;
            $user_id="user".$id;
            DB::table('qyh_user_info')
                ->where('mobile',$tel)
                ->update(['userid'=>$user_id]);
//            $this->add_qyh_user($name,tel,$user_id);
        }
    }



//add_qyh_user($name,$tel);

    /*
        插入数据到标qyh_user_info

    */

/*    function Insert_User_Info($name, $tel)
    {
        $db = new \wechat\DB();

        $row = $db->row("select count(*) as tcount from qyh_user_info WHERE mobile=:mobile", array("mobile" => $tel));

        if ($row["tcount"] > 0) {
            echo "您的手机号已经被登记，请后退检查";
        } else {
            $db->query("insert into qyh_user_info (name,mobile) VALUES (:name,:mobile)",
                array("name" => $name, "mobile" => $tel));

            $row_id = $db->row("select id from qyh_user_info WHERE mobile=:mobile", array("mobile" => $tel));

            $id = $row_id['id'];
            $user_id = "user" . $id;

            $db->query("update qyh_user_info set UserID=:UserID WHERE  mobile=:mobile",
                array("UserID" => $user_id, "mobile" => $tel));
            add_qyh_user($name, $tel, $user_id);        //添加到企业号通讯录中

            echo "<script>window.location =\"http://weix.hengdianworld.com/agent/qrcodeattion.html\";</script>";
        }

    }*/


    /*
    * 获取企业号的access_token
    * 写到缓存
    */
    public function get_qyh_AccessToken()
    {

        $mem = new Memcache;
        $mem->connect("127.0.0.1", 11211);
        $qyh_AccessToken = $mem->get("qyh_AccessToken");
        if (!$qyh_AccessToken) {
            $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=wx6bb8b192d1dcfe19&corpsecret=4j9Ld_RGV3lB6Zn4I3bd8nKwf-NjIiBgn3AO8P5h2qyV6ogoqwdMEY-QM2cGelA6";
            $json = http_request_json($url);//这个地方不能用file_get_contents
            $data = json_decode($json, true);
            if ($data['access_token']) {
                //将access_token写入缓存
                //            require_once 'BaeMemcache.class.php';
                //         	$mem = new BaeMemcache();
                $mem->set("qyh_AccessToken", $data['access_token'], 0, 5000);    //设置cache，为下一步提供依据

                return $data['access_token'];
            } else {
                return "获取qyh_AccessToken错误";
            }
        } else {
            return $qyh_AccessToken;
        }
    }


    //因为url是https 所有请求不能用file_get_contents,用curl请求json 数据
    private function http_request_json($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /*
    * 提交post
    */
    private function vpost($url, $data)
    { // 模拟提交数据函数
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)'); // 模拟用户使用的浏览器
        // curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        // curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包x
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno' . curl_error($curl);//捕抓异常
        }
        curl_close($curl); // 关闭CURL会话
        return $tmpInfo; // 返回数据
    }


    private function add_qyh_user($name, $tel, $userid)
    {
        $ACCESS_TOKEN = get_qyh_AccessToken();
        $url = "https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token=" . $ACCESS_TOKEN;
        $xjson = "{
	   \"userid\": \"" . $userid . "\",
	   \"name\": \"" . $name . "\",
	   \"department\": [33],
	   \"position\": \"\",
	   \"mobile\": \"" . $tel . "\",
	   \"gender\": \"1\",
	   \"email\": \"\",
	   \"weixinid\": \"\"
	}";
        vpost($url, $xjson);
    }

}
