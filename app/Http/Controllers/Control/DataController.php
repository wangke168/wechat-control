<?php

namespace App\Http\Controllers\Control;

use App\WeChat\Usage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;

class DataController extends Controller
{
    public function click(Request $request)
    {

        $from = date('Y-m-d', mktime(0, 0, 0, date('n'), 1, date('Y')));
        $to = date('Y-m-d');
        \Session::flash('from', $from);
        \Session::flash('to', $to);
        $rows = DB::table('wx_click_hits')
//            ->select(DB::raw('count(*) as count,click'))
            ->whereDate('adddate', '>=', $from)
            ->whereDate('adddate', '<', $to)
            ->groupBy('click')
            ->get();
//            return $rows;
        return view('control.count_menu_click', compact('rows', 'from', 'to'));
    }

    public function countSearch(Request $request)
    {

//        dd($request->all());

        $action = $request->input('action');
        $from = $request->input('from');
        $to = $request->input('to');
        \Session::flash('from', $from);
        \Session::flash('to', $to);
        switch ($action) {
            case 'menu':
                $rows = DB::table('wx_click_hits')
                    ->select(DB::raw('count(*) as count,click'))
                    ->whereDate('adddate', '>=', $from)
                    ->whereDate('adddate', '<', $to)
                    ->orderBy('click', 'asc')
                    ->groupBy('click')
                    ->get();
//            return $rows;
                return view('control.count_menu_click', compact('rows', 'from', 'to'));
                break;
            default:
                break;
        }
    }

    //订单管理
    public function ordersend()
    {
        $rows = DB::table('wx_order_confirm')
            ->whereDate('adddate', '>=', '2017-1-1')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('control.count_order_payed', compact('rows'));
    }

    public function orderaction(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');
        switch ($action) {
            case 'yes':
                DB::table('wx_order_confirm')
                    ->where('id', $id)
                    ->update(['other_order' => '1']);
                return redirect('control/ordercount');
                break;
            case 'no':
                DB::table('wx_order_confirm')
                    ->where('id', $id)
                    ->update(['other_order' => '0']);
                return redirect('control/ordercount');
                break;
            default:
                break;
        }
    }

    public function ordersend_search(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        \Session::flash('from', $from);
        \Session::flash('to', $to);
        $rows = DB::table('wx_order_confirm')
            ->whereDate('adddate', '>=', $from)
            ->whereDate('adddate', '<=', $to)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('control.count_order_payed_search', compact('rows', 'from', 'to'));
    }

    /**
     * 获取近半个月的关注谁和取消关注数,并在公告牌显示
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function user_dairy_detail(Request $request)
    {
        $row_add = DB::table('wx_user_dairy_detail')
            ->orderBy('id', 'desc')
            ->take(15)
            ->get();
        $i = 1;
        $row_add = array_reverse($row_add);
        foreach ($row_add as $key => $row_test) {
            $add[] = array('date' => $i, 'numbers' => $row_test->add);
            $esc[] = array('date' => $i, 'numbers' => $row_test->esc);
            $i = $i + 1;
        }
        $info = array('add' => $add, 'esc' => $esc);
        return response()->json($info)->setCallback($request->input('callback'));
    }

    /**
     * 获取近半个月的订单提交数和付款数,并在公告牌显示
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function order_dairy_detail(Request $request)
    {
        $row_add = DB::table('wx_order_dairy_detail')
            ->orderBy('id', 'desc')
            ->take(15)
            ->get();
        $i = 1;
        $row_add = array_reverse($row_add);
        foreach ($row_add as $key => $row_test) {
            $send[] = array('date' => $i, 'numbers' => $row_test->confirm);
            $other[] = array('date' => $i, 'numbers' => $row_test->submit - $row_test->confirm);
            $i = $i + 1;
        }
        $info = array('send' => $send, 'other' => $other);
        return response()->json($info)->setCallback($request->input('callback'));
    }

    public function market(Request $request)
    {
        $action = $request->input('action');

        switch ($action) {
            case 'search':
                $from = $request->input('from');
                $to = $request->input('to');
                \Session::flash('from', $from);
                \Session::flash('to', $to);
                $rows = DB::table('wx_qrscene_info')
                    ->where('classid', '1')
                    ->where('parent_id', '')
                    ->paginate(20);
                $type = 'market';
                return view('control.count_market_info', compact('type', 'rows', 'from', 'to', 'action'));
                dd($request->all());
                break;
            default:
                $type = 'default';
                return view('control.count_market_info', compact('type'));
                break;
        }
        return view('control.count_market_info');
    }

    //各部门年卡订单管理
    public function CardCount()
    {
         $rows = DB::table('wx_order_detail')
             ->whereDate('adddate','>=','2017-1-1')
             ->orderBy('adddate','desc')
             ->orderBy('eventkey','asc')
             ->orderBy('ticket','asc')
             ->orderBy('numbers','desc')
             ->orderBy('id', 'desc')
             ->paginate(20);
         return view('control.count_order_card_payed', compact('rows'));

        $rows = DB::table('wx_order_detail')
            ->where('eventkey', '1028')
            ->whereDate('adddate', '=', date("Y-m-d", strtotime("-1 day")))
            ->groupBy('ticket')
            /* ->orderBy('ticket','asc')
             ->orderBy('numbers','desc')
             ->orderBy('id', 'desc')*/
            ->get();

//        $i=$i+1;
//        echo $i;
        foreach ($rows as $row) {
            $result = DB::table('wx_order_detail')
                ->where('ticket', $row->ticket)
                ->whereDate('adddate', '=', date("Y-m-d", strtotime("-1 day")))
                ->get();
            $i = 0;
            $j = 0;
            $k = 0;
            echo $row->ticket.'<br>';
            foreach ($result as $aaa) {

                if (strpos($aaa->numbers, '学生') !== false) {
//                    echo mb_substr(strstr($aaa->numbers, "学生"), 2, 1) . '<br>';
                    $i = $i + mb_substr(strstr($aaa->numbers, "学生"), 2, 1);
//                    echo $aaa->numbers . '<br>';
                }
                if (strpos($aaa->numbers, '成人') !== false) {
//                    echo mb_substr(strstr($aaa->numbers, "成人"), 2, 1) . '<br>';
                    $j = $j + mb_substr(strstr($aaa->numbers, "成人"), 2, 1);
//                    echo $aaa->numbers . '<br>';
                }
                if (strpos($aaa->numbers, '老人') !== false) {
//                    echo mb_substr(strstr($aaa->numbers, "老人"), 2, 1) . '<br>';
                    $k = $k + mb_substr(strstr($aaa->numbers, "老人"), 2, 1);
//                    echo $aaa->numbers . '<br>';
                }

            }
            echo $i . '<br>';
            echo $j . '<br>';
            echo $k . '<br>';
        }


    }

    private function substr_cut($str_cut, $length)
    {
        if (strlen($str_cut) > $length) {
            for ($i = 0; $i < $length; $i++)
                if (ord($str_cut[$i]) > 128) $i++;
            $str_cut = substr($str_cut, 0, $i) . "..";
        }
        return $str_cut;
    }

    //各部门年卡订单管理
    public function CardSearchCount(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        \Session::flash('from', $from);
        \Session::flash('to', $to);

        return view('control.count_order_card_payed_search', compact('rows', 'from', 'to'));
    }


    public function CardBan(Request $request)
    {
        $action=$request->action;
        switch ($action){
            case 'update':
                $usage=new Usage();
                $marketid = $request->input('marketid');
                $marketid = $usage->getQrscene_info($marketid);
                DB::table('wx_card_ban')
                    ->where('id','1')
                    ->update(['eventkey'=>$marketid]);
                return redirect('/control/cardban');
                break;
            default:

            $row=DB::table('wx_card_ban')
                ->where('id',1)
                ->first();
           $eventkey=$row->eventkey;
            return view('control.cardban',compact('eventkey'));

        }

    }
}
