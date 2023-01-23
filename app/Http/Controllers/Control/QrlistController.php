<?php
namespace App\Http\Controllers\Control;

use App\WeChat\Usage;
use App\WeChat\Api;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use Intervention\Image\Facades\Image;

class QrlistController extends Controller
{
    public $usage;
    public $app;
    public $qrcode;
    public $api;
    public function __construct(Application $app)
    {
        $this->app=$app;
        $this->qrcode=$this->app->qrcode;
        $this->api=new Api();
        $this->usage=new Usage();
    }

    public function index(Request $request)
    {
        $classid = $request->input('classid');
        $parentid=$request->input('parentid');
        if (!$parentid) {
            $rows = DB::table('wx_qrscene_info')
                ->where('classid', $classid)
                ->where('parent_id', '')
                ->paginate(20);
            return view('control.qrlist', compact('rows', "classid"));
        }
        else{
            $rows = DB::table('wx_qrscene_info')
                ->where('parent_id', $parentid)

                ->paginate(20);
            return view('control.qrlist', compact('rows', "parentid",'classid'));
        }

    }

    public function test(Request $request)
    {
        $classid = $request->input('classid');

        $rows = DB::table('wx_qrscene_info')
            ->where('classid', $classid)
            ->where('parent_id', '')
            ->get();

        return view('control.qrlist1', compact('rows'));
    }

    public function add()
    {
        return view('control.qradd');
    }

    public function modify(Request $request)
    {
        $id = $request->input('id');
        $row = DB::table('wx_qrscene_info')
            ->where('id', $id)
            ->first();
        return view('control.qrmodify', compact('row', 'id'));
    }

    public function save(Requests\QrRequest $request)
    {
        $action = $request->input('action');

        $id = $request->input('id');
        $qrscene_name = $request->input('qrscene_name');
        $qrscene_person_name = $request->input('qrscene_person_name');
        $qrscene_person_phone = $request->input('qrscene_person_phone');
        $uid = $request->input('qrscene_uid');

        $classid = $request->input('classid');
        $qr_logo = $this->usage->uploadImage($request->file('qrscene_logo'),'qr_logo');
        if ($action == 'add') {
            $j = 1000;
            $k = 100000;
            for ($j; $j < $k; $j++) {
                $query = DB::table('wx_qrscene_info')
                    ->where('qrscene_id', $j)
                    ->count();
                if ($query == 0) {
                    break;
                }
            }

            DB::table('wx_qrscene_info')
                ->insert(['classid' => $classid, 'qrscene_id' => $j, 'qrscene_name' => $qrscene_name,
                    'qrscene_person_name' => $qrscene_person_name,
                    'qrscene_person_phone' => $qrscene_person_phone,'qrscene_logo'=>$qr_logo, 'uid' => $uid]);

            return redirect('control/qrlist?classid=' . $classid);
        } elseif ($action == 'modify') {
//            $qr_logo = $this->usage->uploadImage($request->file('qrscene_logo'),'qr_logo');
            if (!$qr_logo) {
                $qr_logo = $request->input('qrscene_logo_session');
            }
            DB::table('wx_qrscene_info')
                ->where('id', $id)
                ->update(['classid' => $classid, 'qrscene_name' => $qrscene_name,
                    'qrscene_person_name' => $qrscene_person_name,
                    'qrscene_person_phone' => $qrscene_person_phone,'qrscene_logo'=>$qr_logo,'uid' => $uid]);

            return redirect('control/qrlist?classid=' . $classid);
        }


    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $rows = DB::table('wx_qrscene_info')
            ->where('qrscene_name', 'like', '%' . $keyword . '%')
            ->orWhere('qrscene_id',$keyword)
            ->get();

        return view('control.qrsearch', compact('rows', 'keyword'));
    }

    /**
     * 生成带参二维码
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id)
    {
        $row=DB::table('wx_qrscene_info')
            ->where('qrscene_id',$id)
            ->first();
        $app = app('wechat');
        $qrcode = $app->qrcode;
        $result = $qrcode->forever($id);// 或者 $qrcode->forever("foo");
        $ticket = $result->ticket; // 或者 $result['ticket']
        if ($row->qrscene_logo) {
            $qr_logo = $row->qrscene_logo;
        }
        else{
            $qr_logo='qr/logo_hd.png';
        }
       /* $QR = $qrcode->url($ticket);
        $logo = $qr_logo;
        $img = Image::make($QR);
        $img->insert($logo, 'center');
        return $img->response('png');*/
        return $this->create_qr($ticket,$qr_logo);
    }


    public function qrtemp(Request $request)
    {
        $action = $request->input('action');
        switch ($action) {
            case 'add':
                return view('control.qrtempadd');
                break;
            case 'save':
                $qr_id=$request->input('qrscene_id');
                $qr_name=$request->input('qrscene_name');
                $qr_expire=$request->input('qrscene_expire');
                $qr_uid=$request->input('qrscene_uid');
                $qr_logo = $this->usage->uploadImage($request->file('qrscene_logo'),'qr_logo');

                $row=DB::table('wx_qrscene_temp_info')
                    ->where('qrscene_id',$qr_id)
                    ->get();
                if ($row)
                {
                    \Session::flash('qr_id_repeat','failed');
                    return redirect()->back()->withInput($request->input());
                }

                DB::table('wx_qrscene_temp_info')
                    ->insert(['qrscene_id'=>$qr_id,"qrscene_name"=>$qr_name,'uid'=>$qr_uid,
                        'qrscene_logo'=>$qr_logo,'expireseconds'=>$qr_expire]);
                return redirect('/control/qrtemp');
                break;
            case 'modify':
                $id=$request->input('id');
                $row=DB::table('wx_qrscene_temp_info')
                    ->where('id',$id)
                    ->first();
                return view('control.qrtempmodify', compact('row'));
                break;
            case 'modifysave':
                $id = $request->input('id');
                $qr_id=$request->input('qrscene_id');
                $qr_name=$request->input('qrscene_name');
                $qr_expire=$request->input('qrscene_expire');
                $qr_uid=$request->input('qrscene_uid');
                $qr_logo = $this->usage->uploadImage($request->file('qrscene_logo'),'qr_logo');
                if (!$qr_logo) {
                    $qr_logo = $request->input('qrscene_logo_session');
                }
                DB::table('wx_qrscene_temp_info')
                    ->where('id',$id)
                    ->update(['qrscene_id'=>$qr_id,"qrscene_name"=>$qr_name,'uid'=>$qr_uid,
                        'qrscene_logo'=>$qr_logo,'expireseconds'=>$qr_expire]);
                return redirect('/control/qrtemp');
                break;
            case 'search':
                $keyword = $request->input('keyword');
                $rows = DB::table('wx_qrscene_temp_info')
                    ->where('qrscene_name', 'like', '%' . $keyword . '%')
                    ->orWhere('qrscene_id',$keyword)
                    ->paginate(20);

                return view('control.qrtemplist', compact('rows'));
                break;
            default:
                $rows = DB::table('wx_qrscene_temp_info')
                    ->paginate(20);
                return view('control.qrtemplist', compact('rows'));
                break;
        }

    }

    public function create_temp($id)
    {
        $row=DB::table('wx_qrscene_temp_info')
            ->where('qrscene_id',$id)
            ->first();
        $qr_id=$row->qrscene_id;
        $qr_expire=$row->expireseconds*60;
        if ($row->qrscene_logo) {
            $qr_logo = $row->qrscene_logo;
        }
        else{
            $qr_logo='qr/logo.png';
        }

//        $qrcode = $this->app->qrcode;
        $result = $this->qrcode->temporary($qr_id, $qr_expire);
        $ticket = $result->ticket;// 或者 $result['ticket']
//        $expireSeconds = $result->expire_seconds; // 有效秒数
//        $url = $result->url; // 二维码图片解析后的地址，开发者可根据该地址自行生成需要的二维码图片

        /*$QR = $this->qrcode->url($ticket);
        $logo=$qr_logo;
        $img = Image::make($QR);
        $img->insert($logo, 'center');
        return $img->response('png');*/
        return $this->create_qr($ticket,$qr_logo);

    }

    private function create_qr($ticket,$qr_logo)
    {
        $QR = $this->qrcode->url($ticket);
        $logo=$qr_logo;
        $img = Image::make($QR);
        $img->insert($logo, 'center');
        return $img->response('png');
    }
}
