<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class CardController extends Controller
{
    //
    public function index(Request $request)
    {
        $type = $request->input('type');
        switch ($type) {
            case 'search':
                $Name = $request->input('Name');
                $DIdNumber = $request->input('DIdNumber');
                $rows = DB::table('tbdEmployeeInfo')
                    ->where('DName', $Name)
                    ->orWhere('DID', $DIdNumber)
                    ->get();

                $info='';
                foreach ($rows as $row) {
                    $result=DB::table('tbdEmployeeCard')
                        ->where('DEmployeeNo',$row->DEmployeeNo)
                        ->first();

                    $info=$info.($result->curID);
//                    dd($info);
                }
                if (!$info)
                {
                    $info='未查到年卡信息';
                }
                \Session::flash('curlID', $info);

                \Session::flash('check', 'failed');

                return redirect()->back()->withInput($request->input());

                break;
            default:
                return view('control.employeecard');
                break;
        }
    }
    private function CheckCurID($curID)
    {
        switch ($curID){
            case 'E308':
                $info='2017年8点年卡';
                break;

        }
    }
}
