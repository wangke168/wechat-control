<?php

namespace App\Http\Controllers\Control;


use App\WeChat\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ZoneController extends Controller
{

    public function showlist(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');
        switch ($action) {
            case 'add':
                return view('control.zone_show_add');
                break;
            case 'modify':
                $row = DB::table('zone_show_info')
                    ->where('id', $id)
                    ->first();
                return view('control.zone_show_modify', compact('row'));
                break;
            case 'save':
                $zone_id = $request->input('zone_id');
                $show_name = str_replace(' ', '', $request->input('show_name'));
                $show_place = $request->input('show_place');
                $show_place_url = $request->input('show_place_url');
                $remark = $request->input('remark');
                $zone = new Zone();
                $eventkey = $zone->get_zone_info($zone_id)->eventkey;
                if ($this->check_show($show_name, $zone_id)) {
//                    \Session::flash('check','failed');
                    return \Redirect::back()->with(['check' => 'failed', 'show_name' => $show_name, 'zone_id' => $zone_id]);
                } else {
                    if ($id) {
                        DB::table('zone_show_info')
                            ->where('id', $id)
                            ->update(['zone_id' => $zone_id, 'show_name' => $show_name, 'show_place' => $show_place,
                                'show_place_url' => $show_place_url, 'remark' => $remark, 'eventkey' => $eventkey]);
                    } else {
                        DB::table('zone_show_info')
                            ->insert(['zone_id' => $zone_id, 'show_name' => $show_name, 'show_place' => $show_place,
                                'show_place_url' => $show_place_url, 'remark' => $remark, 'eventkey' => $eventkey]);
                    }
                }
                return redirect('/control/showlist');
                break;
            case 'notpush':
                DB::table('zone_show_info')
                    ->where('id', $id)
                    ->update(['is_push' => '0']);
                return redirect('/control/showlist');
                break;
            case 'push':
                DB::table('zone_show_info')
                    ->where('id', $id)
                    ->update(['is_push' => '1']);
                return redirect('/control/showlist');
                break;
            default:
                $rows = DB::table('zone_show_info')
                    ->orderBy('eventkey', 'desc')
                    ->paginate(20);
                return view('control.zone_show_list', compact('rows'));
                break;
        }
    }

    public function push(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');

        switch ($action) {
            case 'add':
                return view('control.push_project_add');
                break;
            case 'modify':
                $row = DB::table('zone_show_time')
                    ->where('id', $id)
                    ->first();
                return view('control.push_project_modify', compact('row'));
            case 'save':
//                dd($request->all());
                $show_id = $request->input('show_id');
                $show_time = str_replace('：', ':', str_replace('，', ',', $request->input('show_time')));
                $startdate = $request->input('startdate');
                $startdate ?: $startdate = Carbon::now()->toDateString(); //如果开始日期不填,默认是今天
                $enddate = $request->input('enddate');
                $enddate ?: $enddate = '2017-12-31';        //如果不填,默认是年底

                $is_top = $request->input('is_top');
                $remark = $request->input('remark');
                $se_name = $request->input('se_name');
                $zone = new Zone();
//                    $show_name=$zone->get_project_info($show_id)->project_name;
                $zone_id = $zone->get_project_info($show_id)->zone_id;
                $eventkey = $zone->get_zone_info($zone_id)->eventkey;

                if ($this->check_show_time($show_id, $startdate,$id,$remark)) {
//                    \Session::flash('check','failed');
                    return \Redirect::back()->with(['check' => 'failed', 'show_id' => $show_id, 'show_time' => $show_time,
                        'startdate' => $startdate, 'enddate' => $enddate, 'remark' => $remark, 'se_name' => $se_name]);
                }

                if ($id) {

                    DB::table('zone_show_time')
                        ->where('id', $id)
                        ->update(['show_id' => $show_id, 'zone_id' => $zone_id, 'show_time' => $show_time, 'startdate' => $startdate,
                            'enddate' => $enddate, 'eventkey' => $eventkey, 'is_top' => $is_top, 'remark' => $remark, 'se_name' => $se_name]);
                } else {

                    DB::table('zone_show_time')
                        ->insert(['show_id' => $show_id, 'show_time' => $show_time, 'zone_id' => $zone_id,
                            'startdate' => $startdate, 'enddate' => $enddate,
                            'eventkey' => $eventkey, 'is_top' => $is_top, 'remark' => $remark, 'se_name' => $se_name]);
                }
                return redirect('/control/pushproject');
                break;
            case 'notpush':
                DB::table('tour_project_info')
                    ->where('id', $id)
                    ->update(['is_push' => '0']);
                return redirect('/control/pushproject');
                break;
            case 'push':
                DB::table('tour_project_info')
                    ->where('id', $id)
                    ->update(['is_push' => '1']);
                return redirect('/control/pushproject');
                break;
            default:
                $rows = DB::table('zone_show_time')
                    ->orderBy('zone_id', 'asc')
                    ->orderBy('show_id', 'asc')
                    ->orderBy('startdate', 'asc')
                    ->paginate(20);
                return view('control.push_project_list', compact('rows'));
                break;
        }
    }

    /**
     * 检查数据库中是否已经存在该演艺秀
     * @param $type
     */
    private function check_show($show_name, $zone_id)
    {
        $row = DB::table('zone_show_info')
            ->where('show_name', $show_name)
            ->where('zone_id', $zone_id)
            ->count();
        if ($row > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function check_show_time($show_id, $startdate, $id=null,$remark=null)
    {
        if (!$id) {
            $row = DB::table('zone_show_time')
                ->where('show_id', $show_id)
                ->whereDate('enddate', '>', $startdate)
                ->count();
            if ($row > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            $row = DB::table('zone_show_time')
                ->where('show_id', $show_id)
                ->where('remark',$remark)
                ->where('id','<>',$id)
                ->whereDate('enddate', '>', $startdate)
                ->count();
            if ($row > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
}
