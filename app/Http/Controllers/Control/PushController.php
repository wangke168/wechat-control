<?php

namespace App\Http\Controllers\Control;


use App\WeChat\Zone;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class PushController extends Controller
{
    public function project(Request $request)
    {
        $action = $request->input('action');
        $id=$request->input('id');

        switch ($action) {
            case 'add':
                return view('control.push_project_add');
                break;
            case 'modify':
                $row = DB::table('tour_project_info')
                    ->where('id', $id)
                    ->first();
                return view('control.push_project_modify', compact('row'));
            case 'save':
//                dd($request->all());
                $project_id = $request->input('project_id');
                $show_time = str_replace('：', ':', str_replace('，', ',', $request->input('show_time')));
                $location_name = $request->input('location_name');
                $location_url = $request->input('location_url');
                if ($id) {

                    DB::table('tour_project_info')
                        ->where('id', $id)
                        ->update(['show_time' => $show_time, 'location_name' => $location_name, 'location_url' => $location_url]);
                }
                else
                {
                    $zone=new Zone();
                    $show_name=$zone->get_project_info($project_id)->project_name;
                    $zone_id=$zone->get_project_info($project_id)->zone_classid;
                    $eventkey=$zone->get_zone_info($zone_id)->eventkey;
                    DB::table('tour_project_info')
                        ->insert(['show_name'=>$show_name,'show_time' => $show_time, 'zone_id'=>$zone_id,
                            'location_name' => $location_name, 'location_url' => $location_url,
                        'eventkey'=>$eventkey,'project_id'=>$project_id]);
                }
                return redirect('/control/pushproject');
                break;
            case 'notpush':
                DB::table('tour_project_info')
                    ->where('id', $id)
                    ->update(['is_push'=>'0']);
                return redirect('/control/pushproject');
                break;
            case 'push':
                DB::table('tour_project_info')
                    ->where('id', $id)
                    ->update(['is_push'=>'1']);
                return redirect('/control/pushproject');
                break;
            default:
                $rows = DB::table('tour_project_info')
                    ->orderBy('zone_id', 'asc')
                    ->paginate(20);
                return view('control.push_project_list', compact('rows'));
                break;
        }
    }

}
