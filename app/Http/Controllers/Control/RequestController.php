<?php

namespace App\Http\Controllers\Control;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;

class RequestController extends Controller
{
    public $app;
    public $material;
    public function __construct(Application $app)
    {
        $this->app = $app;

        // 永久素材
        $this->material = $this->app->material;
    }

    public function txt()
    {
        $rows = DB::table('wx_txt_request')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('control.request_txt_list', compact('rows'));
    }

    public function se()
    {
        $rows = DB::table('se_info_detail')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('control.request_se_list', compact('rows'));
    }

    public function request_modify(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');
        switch ($action) {
            case 'se_offline':
                DB::table('se_info_detail')
                    ->where('id', $id)
                    ->update(['online' => '0']);
                return redirect()->back();
                break;
            case 'se_online':
                DB::table('se_info_detail')
                    ->where('id', $id)
                    ->update(['online' => '1']);
                return redirect()->back();
                break;
        }
    }

    public function voice(Request $request)
    {
        $action = $request->input('action');
        switch ($action) {
            case 'add':
                return view('control.request_voice_add');
                break;
            case 'save':

                $filename=$request->file('file')->getClientOriginalName();
//                dd($request->file());
                $path=$request->file->path();
                $file = Input::file('photo');
                $filename=$path.'/'.$filename;
                return $request->file('file')->getPathInfo();
                $result = $this->material->uploadImage($filename);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）！
                var_dump($result);
                break;
            default:
                $rows = DB::table('wx_voice_request')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.request_voice_list', compact('rows'));
                break;

        }
    }
}
