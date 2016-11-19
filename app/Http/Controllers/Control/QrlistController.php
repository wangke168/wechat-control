<?php
namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;

class QrlistController extends Controller
{
    public function index(Request $request)
    {
        $classid = $request->input('classid');

        $rows = DB::table('wx_qrscene_info')
            ->where('classid', $classid)
            ->where('parent_id', '')
            ->paginate(20);

        return view('control.qrlist', compact('rows', "classid"));
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
        $id=$request->input('id');
        $row=DB::table('wx_qrscene_info')
            ->where('id',$id)
            ->first();
        return view('control.qrmodify',compact('row','id'));
    }

    public function save(Requests\QrRequest $request)
    {
        $action = $request->input('action');

        $id=$request->input('id');
        $qrscene_name = $request->input('qrscene_name');
        $qrscene_person_name = $request->input('qrscene_person_name');
        $qrscene_person_phone = $request->input('qrscene_person_phone');
        $uid = $request->input('qrscene_uid');
        $classid = $request->input('classid');
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
                ->insert(['classid'=>$classid,'qrscene_id'=>$j,'qrscene_name'=>$qrscene_name,
                    'qrscene_person_name'=>$qrscene_person_name,
                    'qrscene_person_phone'=>$qrscene_person_phone,'uid'=>$uid]);

            return redirect('control/qrlist?classid='.$classid);
    //        $db->query("insert into wx_qrscene_info (classid,qrscene_id,parent_id,qrscene_name,qrscene_person_name,qrscene_person_phone,uid) VALUES (:classid,:j,:qrscene_id,:qrscene_name,:qrscene_person_name,:qrscene_person_phone,:Qrscene_UID)",
    //            array("classid" => "$classid", "j" => "$j", "qrscene_id" => "$qrscene_id", "qrscene_name" => "$qrscene_name", "qrscene_person_name" => "$qrscene_person_name", "qrscene_person_phone" => "$qrscene_person_phone", "Qrscene_UID" => "$Qrscene_UID"));
        }
        elseif($action=='modify')
        {
            DB::table('wx_qrscene_info')
                ->where('id',$id)
                ->update(['classid'=>$classid,'qrscene_name'=>$qrscene_name,
                    'qrscene_person_name'=>$qrscene_person_name,
                    'qrscene_person_phone'=>$qrscene_person_phone,'uid'=>$uid]);

            return redirect('control/qrlist?classid='.$classid);
        }


    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $rows = DB::table('wx_qrscene_info')
            ->where('qrscene_name','like', '%'.$keyword.'%')
            ->paginate(20);

        return view('control.qrsearch', compact('rows', 'keyword'));
    }
}
