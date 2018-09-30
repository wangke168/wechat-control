<?php

namespace App\Http\Controllers\Control;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public $app;
    public $tag;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->tag = $app->user_tag;
    }

    public function index(Request $request)
    {
        $action=$request->input('action');
        switch ($action) {
            case 'add':
                $type='add';
                return view('control.tag_add',compact('type'));
                break;
            case 'edit':
                $id=$request->input('id');
                $tag_name=$request->input('tag');
                $type='edit';
                return view('control.tag_add',compact('type','id','tag_name'));
                break;
            case 'modify':
                $id=$request->input('id');
                $tag_name=$request->input('tag_name');
                $this->tag->update($id, $tag_name);
                return redirect('/control/tag');
            case 'save':
                $tag_name=$request->input('tag_name');
                $this->tag->create($tag_name);
                return redirect('/control/tag');
                break;
            default:
                $tags = $this->tag->lists();
                $tags_count = count($tags->tags);
                $row=floor($tags_count/4);

                return view('control.tag_list', compact('tags', 'tags_count','row'));
                break;
        }

    }
}
