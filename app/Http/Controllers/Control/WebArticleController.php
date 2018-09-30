<?php

namespace App\Http\Controllers\Control;


use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;

class WebArticleController extends Controller
{

    public function articleList(Request $request)
    {

        $classid = $request->input('classid');

        if ($classid) {
            $rows = DB::connection('mysql_main')->table('news')
                ->where('cat_id', $classid)
                ->orderBy('id', 'desc')
                ->paginate(20);
        } else {
            $rows = DB::connection('mysql_main')->table('news')
                ->orderBy('id', 'desc')
                ->paginate(20);

        }
        return view('control.web_articlelist', compact('rows', 'classid'));
    }


    public function articleModify(Request $request)
    {
        $id = $request->input('id');
        $type = $request->input('action');

        switch ($type) {
            case 'del':
                DB::connection('mysql_main')->table('news')
                    ->where('id', $id)
                    ->delete();
                return redirect()->back();
                break;
            case 'modify':
                $row = DB::connection('mysql_main')->table('news')
                    ->where('id', $id)
                    ->first();
                return view('control.web_articlemodify', compact('row', 'id'));
                break;
        }
    }

    public function articleSearch(Request $request)
    {
        $keyword = $request->input('keyword');
        $eventkey = $this->Qrscene_info($keyword);
        $rows = DB::table('wx_article')
            ->where('title', 'like', '%' . $keyword . '%')
            ->orWhere('eventkey', $eventkey)
            ->where('audit', '1')
            ->orderBy('online', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('control.articlesearch', compact('rows', 'keyword'));
    }

    public function articleAdd()
    {
        return view('control.web_articleadd');
    }





    public function articleSave(Request $request)
    {
        $action = $request->input('action');

        $classid = $request->input('classid');
        $title = $request->input('title');


        $content = $request->input('content');

        $content = str_replace('\'', '\'\'', $content);
        $content = str_replace("'", "", $content);
        //  $content = str_replace("https://img.xiumi.us", "http://img.xiumi.us", $content);



        if ($action == 'modify') {

            $id = $request->input('id');
            DB::connection('mysql_main')->table('news')
                ->where('id', $id)
                ->update(['cat_id' => $classid, 'title' => $title, 'content' => $content]);

        } elseif ($action == 'add') {
            DB::connection('mysql_main')->table('news')
                ->insert(['cat_id' => $classid, 'title' => $title,'content' => $content, 'created' => date('Y-m-d')]);
        }
        return redirect('/control/web_articlelist');

    }


    public function uploadImage($filename, $type)
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
