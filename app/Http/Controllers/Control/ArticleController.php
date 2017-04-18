<?php
namespace App\Http\Controllers\Control;

use App\WeChat\Usage;
use EasyWeChat\Staff\Session;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;

class ArticleController extends Controller
{

    public function articleList(Request $request)
    {
        $classid = $request->input('classid');
        $eventkey = \Session::get('eventkey');
        if ($eventkey == 'all') {
            if (!$classid) {
                $rows = DB::table('wx_article')
                    ->where('del', '0')
                    ->where('audit', '1')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
            } elseif ($classid == 1) {
                $rows = DB::table('wx_article')
                    ->where('eventkey', '<>', 'all')
                    ->where('del', '0')
                    ->where('audit', '1')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
            } elseif ($classid == 97) {
                $rows = DB::table('wx_article')
                    ->where('del', '0')
                    ->where('audit', '1')
                    ->where('classid', '')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
            } elseif ($classid == 'audit') {
                $rows = DB::table('wx_article')
                    ->where('del', '0')
                    ->where('audit', '0')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
            } elseif ($classid == 'del') {
                $rows = DB::table('wx_article')
                    ->where('del', '1')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
            } else {
                $rows = DB::table('wx_article')
                    ->where('del', '0')
                    ->where('audit', '1')
                    ->where('classid', $classid)
                    ->where('eventkey', 'all')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
            }
            return view('control.articlelist', compact('rows', 'classid'));
        } else {
            $rows = DB::table('wx_article')
                ->where('eventkey', $eventkey)
                ->orderBy('id', 'desc')
                ->paginate(20);
            return view('control.articlelist', compact('rows', 'classid', 'eventkey'));
        }
    }


    public function articleModify(Request $request)
    {
        $id = $request->input('id');
        $type = $request->input('action');

        switch ($type) {
            case 'del':
                DB::table('wx_article')
                    ->where('id', $id)
                    ->update(['del' => '1']);
                return redirect()->back();
                break;
            case 'return':
                DB::table('wx_article')
                    ->where('id', $id)
                    ->update(['del' => '0']);
                return redirect()->back();
                break;
            case 'offline':
                DB::table('wx_article')
                    ->where('id', $id)
                    ->update(['online' => '0']);
                return redirect()->back();
                break;
            case 'online':
                DB::table('wx_article')
                    ->where('id', $id)
                    ->update(['online' => '1']);
                return redirect()->back();
                break;
            case 'audit':
                DB::table('wx_article')
                    ->where('id', $id)
                    ->update(['audit' => '1']);
                return redirect()->back();
                break;
            case 'modify':
                $row = DB::table('wx_article')
                    ->where('id', $id)
                    ->first();
//                dd( $row);

                return view('control.articlemodify', compact('row', 'id'));
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
        return view('control.articleadd');
    }


    public function articleAdd1()
    {
        return view('control.articleadd_back');
    }


    public function articleSave(Request $request)
    {
        $action = $request->input('action');

        $classid = $request->input('classid');
        $title = $request->input('title');

        $keyword = $request->input('keyword');
        $this->checkkeyword($keyword);

        $pyq_title = $request->input('pyq_title');
        $content = $request->input('content');

        $content = str_replace('\'', '\'\'', $content);
        $content = str_replace("'", "", $content);
        $content = str_replace("https://img.xiumi.us", "http://img.xiumi.us", $content);

        $url = $request->input('url');
        $startdate = $request->input('startdate');
        if (!$startdate) {
            $startdate = date('Y-m-d');
        }
        $enddate = $request->input('enddate');
        if (!$enddate) {
            $enddate = '2999-9-9';
        }

        $priority = $request->input('priority');
        $marketid = $request->input('marketid');

        $marketid = $this->Qrscene_info($marketid);
        $audit = $this->checkbox($request->input('audit'), '0');
        $focus = $this->checkbox($request->input('focus'), '1');
        $allow_copy = $this->checkbox($request->input('allow_copy'), '1');
        $show_qr = $this->checkbox($request->input('show_qr'), '1');

        $pic_url = $this->uploadImage($request->file('pic_url'), 'pic_url');
        $pyq_pic = $this->uploadImage($request->file('pyq_pic'), 'pyq_pic');

        if ($action == 'modify') {

            if (!$pic_url) {
                $pic_url = $request->input('pic_url_session');
            }
            if (!$pyq_pic) {
                $pyq_pic = $request->input('pyq_pic_session');
            }
            $id = $request->input('id');
            DB::table('wx_article')
                ->where('id', $id)
                ->update(['classid' => $classid, 'title' => $title, 'keyword' => $keyword, 'picurl' => $pic_url,
                    'pyq_pic' => $pyq_pic, 'pyq_title' => $pyq_title, 'content' => $content, 'url' => $url,
                    'startdate' => $startdate, 'enddate' => $enddate, 'priority' => $priority,
                    'audit' => $audit, 'focus' => $focus, 'show_qr' => $show_qr,
                    'allow_copy' => $allow_copy, 'adddate' => date('Y-m-d'),
                    'eventkey' => $marketid, 'author' => \Session::get('username')]);

        } elseif ($action == 'add') {
            DB::table('wx_article')
                ->insert(['classid' => $classid, 'title' => $title, 'keyword' => $keyword, 'picurl' => $pic_url,
                    'pyq_pic' => $pyq_pic, 'pyq_title' => $pyq_title, 'content' => $content, 'url' => $url,
                    'startdate' => $startdate, 'enddate' => $enddate, 'priority' => $priority,
                    'audit' => $audit, 'focus' => $focus, 'show_qr' => $show_qr,
                    'allow_copy' => $allow_copy, 'adddate' => date('Y-m-d'),
                    'eventkey' => $marketid, 'author' => \Session::get('username')]);
        } elseif ($action == 'copy') {
            if (!$pic_url) {
                $pic_url = $request->input('pic_url_session');
            }
            if (!$pyq_pic) {
                $pyq_pic = $request->input('pyq_pic_session');
            }
            DB::table('wx_article')
                ->insert(['classid' => $classid, 'title' => $title, 'keyword' => $keyword, 'picurl' => $pic_url,
                    'pyq_pic' => $pyq_pic, 'pyq_title' => $pyq_title, 'content' => $content, 'url' => $url,
                    'startdate' => $startdate, 'enddate' => $enddate, 'priority' => $priority,
                    'audit' => $audit, 'focus' => $focus, 'show_qr' => $show_qr,
                    'allow_copy' => $allow_copy, 'adddate' => date('Y-m-d'),
                    'eventkey' => $marketid, 'author' => \Session::get('username')]);
        }
        return redirect('/control/articlelist');

    }

    public function articleCopy(Request $request)
    {
        $id = $request->input('id');
        $row = DB::table('wx_article')
            ->where('id', $id)
            ->first();
        return view('control.articlecopy', compact('row', 'id'));

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

    public function review_qr(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        $app = app('wechat');
        $url = $app->url;
        switch ($type) {
            case 'article':
                $shortUrl = $url->shorten('http://e.hengdianworld.com/WeixinOpenId.aspx?nexturl=https://wechat.hengdianworld.com/article/review?id=' . $id);
                break;
            case 'article_se':
                $shortUrl = $url->shorten('http://e.hengdianworld.com/WeixinOpenId.aspx?nexturl=https://wechat.hengdianworld.com/article/review?type=article_se&id=' . $id);
                break;
        }
        //      $shortUrl = $url->shorten('http://e.hengdianworld.com/WeixinOpenId.aspx?nexturl=https://wechat.hengdianworld.com/article/review?id='.$id);
//        return $shortUrl->short_url;
        return view('control.articlereviewqr', compact('shortUrl'));

    }
}
