<?php

namespace App\Http\Controllers\Control;

use App\WeChat\Usage;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Support\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use Image;

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

                $keyword = str_replace('，', ',', $request->input('keyword'));
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

    public function se(Request $request)
    {
        $action = $request->input('action');
        $id=$request->input('id');
        switch ($action) {
            case 'add':
                return view('control.request_se_add');
                break;
            case 'modify':
                $row=DB::table('wx_article_se')
                    ->find($id);
                return view('control.request_se_modify',compact('row','id'));
                break;
            case 'save':
//                dd($request->all());

                $title = $request->input('title');
                $pyq_title = $request->input('pyq_title');
                $content = $request->input('content');
                $content = str_replace('\'', '\'\'', $content);
                $content = str_replace("'", "", $content);
                $url = $request->input('url');
                $startdate = $request->input('startdate');
                if (!$startdate) {
                    $startdate = date('Y-m-d');
                }
                $enddate = $request->input('enddate');
                if (!$enddate) {
                    $enddate = '2999-9-9';
                }
                $target = $request->input('target');
                $priority = $request->input('priority');
                $marketid = $request->input('marketid');
                $marketid = $this->Qrscene_info($marketid);
                $show_qr = $this->checkbox($request->input('show_qr'), '1');
                $pic_url = $this->uploadImage($request->file('pic_url'), 'pic_url');
                $pyq_pic = $this->uploadImage($request->file('pyq_pic'), 'pyq_pic');
                if($id)
                {
                    if (!$pic_url) {
                        $pic_url = $request->input('pic_url_session');
                    }
                    if (!$pyq_pic) {
                        $pyq_pic = $request->input('pyq_pic_session');
                    }

                    DB::table('wx_article_se')
                        ->where('id', $id)
                        ->update(['title' => $title,  'pic_url' => $pic_url,
                            'pyq_pic' => $pyq_pic, 'pyq_title' => $pyq_title, 'content' => $content, 'url' => $url,
                            'startdate' => $startdate, 'enddate' => $enddate, 'target' => $target,'priority' => $priority,
                             'show_qr' => $show_qr, 'adddate' => date('Y-m-d'),
                            'eventkey' => $marketid, 'author' => \Session::get('username')]);
                }
                else{
                    DB::table('wx_article_se')
                        ->insert(['title' => $title,  'pic_url' => $pic_url,
                            'pyq_pic' => $pyq_pic, 'pyq_title' => $pyq_title, 'content' => $content, 'url' => $url,
                            'startdate' => $startdate, 'enddate' => $enddate, 'target' => $target,'priority' => $priority,
                            'show_qr' => $show_qr, 'adddate' => date('Y-m-d'),
                            'eventkey' => $marketid, 'author' => \Session::get('username')]);
                }
                return redirect('/control/request_se');
                break;
            default:
                $rows = DB::table('wx_article_se')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.request_se_list', compact('rows'));
                break;
        }

    }

    public function request_modify(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');
        switch ($action) {
            case 'se_offline':
                DB::table('wx_article_se')
                    ->where('id', $id)
                    ->update(['online' => '0']);
                return redirect()->back();
                break;
            case 'se_online':
                DB::table('wx_article_se')
                    ->where('id', $id)
                    ->update(['online' => '1']);
                return redirect()->back();
                break;
        }
    }

    public function voice(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');
        switch ($action) {
            case 'online':
//                $id = $request->input('id');
                DB::table('wx_voice_request')
                    ->where('id', $id)
                    ->update(['online' => '1']);
                return redirect('/control/requestvoice');
                break;
            case 'offline':
//                $id = $request->input('id');
                DB::table('wx_voice_request')
                    ->where('id', $id)
                    ->update(['online' => '0']);
                return redirect('/control/requestvoice');
                break;
            case 'del':
//                $id = $request->input('id');
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
            case 'modify':
                $row = DB::table('wx_voice_request')
                    ->find($id);
                return view('control.request_voice_modify', compact('row'));
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
                $eventkey = $request->input('eventkey');

                $eventkey = $this->usage->getQrscene_info($eventkey);

                $focus = $request->input('focus');
                $focus ?: $focus = 0;
                if ($id) {
                    DB::table('wx_voice_request')
                        ->where('id', $id)
                        ->update(['focus' => $focus, 'eventkey' => $eventkey, 'remark' => $content]);
                } else {
                    $file = $request->file('file');
                    $media_id = $this->upload_material($file, 'voice');

                    DB::table('wx_voice_request')
                        ->insert(['media_id' => $media_id, 'eventkey' => $eventkey, 'remark' => $content]);
                }
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
            case 'snyc':
                $voice_count = $this->material->stats()->voice_count;;
                $i = 0;
                do {
                    if ($voice_count - $i > 10) {
                        $result = $this->material->lists('voice', $i, 10);
                    } else {
                        $result = $this->material->lists('voice', $i, ($voice_count - $i));
                    }
                    $items = $result->item;
                    foreach ($items as $item) {
                        echo $item['media_id'] . "<br>";

                        $row = DB::table('wx_voice_request')
                            ->where('media_id', $item['media_id'])
                            ->count();
                        echo $row . "<br>";
                        if ($row < 1) {

                            DB::table('wx_voice_request')
                                ->insert(['media_id' => $item['media_id'], 'remark' => $item['name']]);
                        } else {
                            break;
                        }
                    }
                    $i = $i + 10;
                } while ($i <= $voice_count);
                return redirect('/control/requestvoice');
                break;
            default:
                $rows = DB::table('wx_voice_request')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.request_voice_list', compact('rows'));
                break;

        }
    }

    /**
     * 图片素材管理
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function image(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');
        switch ($action) {
            case 'online':
//                $id = $request->input('id');
                DB::table('wx_images_request')
                    ->where('id', $id)
                    ->update(['online' => '1']);
                return redirect('/control/requestimage');
                break;
            case 'offline':
//                $id = $request->input('id');
                DB::table('wx_images_request')
                    ->where('id', $id)
                    ->update(['online' => '0']);
                return redirect('/control/requestimage');
                break;
            case 'del':
//                $id = $request->input('id');
                $media_id = $request->input('media_id');
                DB::table('wx_images_request')
                    ->where('id', $id)
                    ->delete();
                $this->material->delete($media_id);
                return redirect('/control/requestimage');
                break;
            case 'add':
                return view('control.request_image_add');
                break;
            case 'modify':
                $row = DB::table('wx_images_request')
                    ->find($id);
                return view('control.request_image_modify', compact('row'));
                break;
            case 'search':
                $keyword = $request->input('keyword');

                $rows = DB::table('wx_images_request')
                    ->where('remark', 'like', '%' . $keyword . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.request_image_list', compact('rows'));
                break;
            case 'save':

                $content = $request->input('content');
                $eventkey = $request->input('eventkey');

                $eventkey = $this->usage->getQrscene_info($eventkey);

                $focus = $request->input('focus');
                $focus ?: $focus = 0;
                if ($id) {
                    DB::table('wx_images_request')
                        ->where('id', $id)
                        ->update(['focus' => $focus, 'eventkey' => $eventkey, 'remark' => $content]);
                } else {
                    $file = $request->file('file');
                    $media_id = $this->upload_material($file, 'voice');

                    DB::table('wx_images_request')
                        ->insert(['media_id' => $media_id, 'eventkey' => $eventkey, 'remark' => $content]);
                }
                return redirect('/control/requestimage');
                break;
            case 'download':
                $id = $request->input('id');
                $row = DB::table('wx_images_request')
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
            case 'snyc':
                $voice_count = $this->material->stats()->voice_count;;
                $i = 0;
                do {
                    if ($voice_count - $i > 10) {
                        $result = $this->material->lists('voice', $i, 10);
                    } else {
                        $result = $this->material->lists('voice', $i, ($voice_count - $i));
                    }
                    $items = $result->item;
                    foreach ($items as $item) {
                        echo $item['media_id'] . "<br>";

                        $row = DB::table('wx_images_request')
                            ->where('media_id', $item['media_id'])
                            ->count();
                        echo $row . "<br>";
                        if ($row < 1) {

                            DB::table('wx_images_request')
                                ->insert(['media_id' => $item['media_id'], 'remark' => $item['name']]);
                        } else {
                            break;
                        }
                    }
                    $i = $i + 10;
                } while ($i <= $voice_count);
                return redirect('/control/requestimage');
                break;
            default:
                $rows = DB::table('wx_images_request')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.request_image_list', compact('rows'));
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
            case "image":
                $result = $this->material->uploadImage($file);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）！
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

    private function checkbox($box, $return)
    {
        switch ($return) {
            case '0':           //是否审核
                if ($box) {
                    return '0';
                } else {
                    return '1';
                }
                break;
            case '1':
                if ($box) {
                    return '1';
                } else {
                    return '0';
                }
                break;
        }
    }

    private function uploadImage($filename, $type)
    {
        if ($filename) {
            $file = $filename;
            //判断文件上传过程中是否出错
            if (!$file->isValid()) {
                exit('文件上传出错！');
            }
            $destPath = 'uploads/' . date('Ymd') . '/';
            if (!file_exists($destPath))
                mkdir($destPath, 0755, true);
            $extension = $file->getClientOriginalExtension();
            $filename = time() . str_random(5) . '.' . $extension;

//            $filename = time() . str_random(5) . $file->getClientOriginalName();
            if (!$file->move($destPath, $filename)) {
                exit('保存文件失败！');
            }

            switch ($type) {

                case 'pic_url':
                    Image::make($destPath . $filename)->save();
                    break;
                case 'pyq_pic':
                    Image::make($destPath . $filename)->fit(200)->save();
                    break;
            }

            return $destPath . $filename;

        }
    }
}
