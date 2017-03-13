<?php

namespace App\Http\Controllers\Control;

use App\WeChat\Usage;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Support\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;

class RequestController extends Controller
{
    public $app;
    public $material;
    public $usage;

    public function __construct(Application $app)
    {
        $this->app = $app;

        // 永久素材
        $this->material = $this->app->material;
        $this->usage = new Usage();
    }

    public function txt(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');
        switch ($action) {
            case 'add':
                return view('control.request_txt_add');
            case 'modify':
                $row = DB::table('wx_txt_request')
                    ->find($id);
                return view('control.request_txt_modify', compact('row'));
                break;
            case 'save';
//                dd($request->all());
                $content = $request->input('content');

                $keyword = str_replace('，',',',$request->input('keyword'));
                $this->checkkeyword($keyword);
                $focus = $request->input('focus');
                $focus ?: $focus = 0;
                $eventkey = $request->input('eventkey');
                $eventkey = $this->Qrscene_info($eventkey);
                if ($id) {
                    DB::table('wx_txt_request')
                        ->where('id', $id)
                        ->update(['content' => $content, 'keyword' => $keyword, 'focus' => $focus, 'eventkey' => $eventkey]);
                } else {
                    DB::table('wx_txt_request')
                        ->insert(['content' => $content, 'keyword' => $keyword, 'focus' => $focus, 'eventkey' => $eventkey]);
                }
                return redirect('/control/requesttxt');
                break;
            case 'search':
                $keyword = $request->input('keyword');
                $rows = DB::table('wx_txt_request')
                    ->where('content', 'like', '%' . $keyword . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.request_txt_list', compact('rows'));
                break;
            case 'online':
                DB::table('wx_txt_request')
                    ->where('id', $id)
                    ->update(['online' => '1']);
                return redirect('/control/requesttxt');
                break;
            case 'offline':
                DB::table('wx_txt_request')
                    ->where('id', $id)
                    ->update(['online' => '0']);
                return redirect('/control/requesttxt');
                break;
            case 'del':
                DB::table('wx_txt_request')
                    ->where('id', $id)
                    ->delete();
                return redirect('/control/requesttxt');
                break;
            default:
                $rows = DB::table('wx_txt_request')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.request_txt_list', compact('rows'));
                break;
        }

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
            case 'online':
                $id = $request->input('id');
                DB::table('wx_voice_request')
                    ->where('id', $id)
                    ->update(['online' => '1']);
                return redirect('/control/requestvoice');
                break;
            case 'offline':
                $id = $request->input('id');
                DB::table('wx_voice_request')
                    ->where('id', $id)
                    ->update(['online' => '0']);
                return redirect('/control/requestvoice');
                break;
            case 'del':
                $id = $request->input('id');
                $media_id = $request->input('media_id');
                DB::table('wx_voice_request')
                    ->where('id', $id)
                    ->delete();
                $this->material->delete($media_id);
                return redirect('/control/requestvoice');
                break;
            case 'add':
                return view('control.request_voice_add');
                break;
            case 'search':
                $keyword = $request->input('keyword');

                $rows = DB::table('wx_voice_request')
                    ->where('remark', 'like', '%' . $keyword . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.request_voice_list', compact('rows'));
                break;
            case 'save':

                $content = $request->input('content');
                $marketid = $request->input('marketid');

                $marketid = $this->usage->getQrscene_info($marketid);

                $file = $request->file('file');
                $media_id = $this->upload_material($file, 'voice');

                DB::table('wx_voice_request')
                    ->insert(['media_id' => $media_id, 'eventkey' => $marketid, 'remark' => $content]);
                return redirect('/control/requestvoice');
                break;
            case 'download':
                $id = $request->input('id');
                $row = DB::table('wx_voice_request')
                    ->find($id);
                $media_id = $row->media_id;
                $title = $row->remark;
                $voice = $this->material->get($media_id);
                $ext = File::getStreamExt($voice); //这里返回的扩展名已经带[.]了
//                return $ext;
                $directory = '/volumes/result/Downloads';
                file_put_contents($directory . '/' . $title . $ext, $voice);
                return $title . $ext;

                break;
            default:
                $rows = DB::table('wx_voice_request')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.request_voice_list', compact('rows'));
                break;

        }
    }

    private function upload_material($file, $type)
    {
        //判断文件上传过程中是否出错
        if (!$file->isValid()) {
            exit('文件上传出错！');
        }
        $destPath = 'uploads/' . date('Ymd') . '/';
        if (!file_exists($destPath))
            mkdir($destPath, 0755, true);
        $extension = $file->getClientOriginalExtension();
        $filename = time() . str_random(5) . '.' . $extension;

        if (!$file->move($destPath, $filename)) {
            exit('保存文件失败！');
        }
        $file = public_path() . '/' . $destPath . $filename;

        switch ($type) {
            case 'voice':
                $result = $this->material->uploadVoice($file);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）！
                return ($result->media_id);
                break;
        }

    }

    private function Qrscene_info($qrscene_name)
    {

        $qrscene_name = explode(',', $qrscene_name);
        $marketid = '';
        for ($index = 0; $index < count($qrscene_name); $index++) {
            if ($index == 0) {
                if ($qrscene_name[$index] == '全部显示') {
                    $marketid = "all";
                } else {
                    $row = DB::table('wx_qrscene_info')
                        ->where('qrscene_name', $qrscene_name[$index])
                        ->first();
                    if ($row) {
                        $marketid = $row->qrscene_id;
                    }
                }
            } else {
                if ($qrscene_name[$index] == '全部显示') {
                    $marketid = $marketid . ',' . "all";
                } else {
                    $row = DB::table('wx_qrscene_info')
                        ->where('qrscene_name', $qrscene_name[$index])
                        ->first();
                    $marketid = $marketid . ',' . $row->qrscene_id;
                }
            }

        }
        return $marketid;
    }

    private function checkkeyword($keyword)  //检查关键字表中是否已经含有关键字，没有的话写入*/
    {
        $keyword = str_replace("，", ",", $keyword);
        $keyword = explode(',', $keyword);

        for ($index = 0; $index < count($keyword); $index++) {

            $row = DB::table('wx_request_keyword')
                ->where('keyword', $keyword[$index])
                ->first();
            if (!$row) {
                DB::table('wx_request_keyword')
                    ->insert(['keyword' => $keyword[$index]]);
            }
        }
    }


}
