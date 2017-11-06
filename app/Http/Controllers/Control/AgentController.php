<?php

namespace App\Http\Controllers\Control;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use SoapClient;
use DB;

class AgentController extends Controller
{
    private $SoapClint;

    public function __construct()
    {
        $wsdl = env('AGENT_WSDL', '');
        $this->SoapClint = new SoapClient($wsdl);
//        $this->CompanyCode='ymxytest0fjloa';
    }

    /**
     * 订单同步
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $action = $request->input('action');
        switch ($action) {
            case 'getproductid':
                $ProductName = $request->input('productname');
                $CompanyCode = $request->input('CompanyCode');
                return $this->get_productid($ProductName, $CompanyCode);
                break;
            case 'addorder':
                $viewid = $request->input('ProductID');
                $ProductName = $request->input('Products');
                $CompanyCode = $request->input('CompanyCode');
//                $Property = $request->input('Property');
                $Number = $request->input('Number');
                $CompanyName = $request->input('CompanyName');
                $CompanyOrderID = $request->input('CompanyOrderID');
                $OrderTime = $request->input('OrderTime');
                $ArrivalDate = $request->input('ArrivalDate');
                $VisitorName = $request->input('VisitorName');
                $VisitorMobile = $request->input('VisitorMobile');
                if ($this->CheckAgentProduct($viewid, $ProductName, $CompanyCode)) {
                    $ErrorMsg = $this->OrderReq($viewid, $Number, $CompanyCode, $CompanyName, $CompanyOrderID, $OrderTime, $ArrivalDate, $VisitorName, $VisitorMobile);
                    return redirect('/control/agentinterface?action=result&type=sync&msg=' . $ErrorMsg);
                } else {
                    \Session::flash('check', 'failed');
                    return redirect()->back()->withInput($request->input());
                }
                break;
            case 'result':
                $ErrorMsg = $request->input('msg');
                $Type = $request->input('type');
                return view('control.agentinterfaceresult', compact('ErrorMsg', 'Type'));
                break;
            default:
                return view('control.agentinterface');
                break;
        }
    }

    /**
     * 获取产品ID
     * @param $product_name
     * @param $company_code
     * @return mixed
     */
    private function get_productid($product_name, $company_code)
    {
        $row = DB::table('agent_product_id')
            ->where('product_name', $product_name)
            ->where('companycode', $company_code)
            ->first();
        return $row->product_id;
    }

    /**
     * 检查产品ID，产品名称，CompanyCode是否对应
     * @param $viewid
     * @param $ProductName
     * @param $CompanyCode
     * @return bool
     */
    private function CheckAgentProduct($viewid, $ProductName, $CompanyCode)
    {
        $row = DB::table('agent_product_id')
            ->where('product_id', $viewid)
            ->where('product_name', $ProductName)
            ->where('companycode', $CompanyCode)
            ->get();
        if ($row) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * POST到订单接口
     * @param $viewid
     * @param $Number
     * @param $CompanyCode
     * @param $CompanyName
     * @param $CompanyOrderID
     * @param $OrderTime
     * @param $ArrivalDate
     * @param $VisitorName
     * @param $VisitorMobile
     * @return mixed
     */
    private function OrderReq($viewid, $Number, $CompanyCode, $CompanyName, $CompanyOrderID, $OrderTime, $ArrivalDate, $VisitorName, $VisitorMobile)
    {
        $products = "<product>
                    <viewid>$viewid</viewid>
                    <viewname></viewname>
                    </product>";
        $property = "<PropertyAndNumber>
                    <Property>Adult</Property>
                    <Number>$Number</Number>                  
                    </PropertyAndNumber>";
        $other = "<OtherVisitor>
                   <VisitorName></VisitorName>
                <IdNumber></IdNumber>
                </OtherVisitor>";
        $TimeStamp = date('YmdHis');
        $params = array('TimeStamp' => $TimeStamp,
            'CompanyCode' => $CompanyCode,
            'CompanyName' => $CompanyName,
            'CompanyOrderID' => $CompanyOrderID,
            'OrderTime' => $OrderTime,
            'ArrivalDate' => $ArrivalDate,
            'PayType' => '1',
            'VisitorName' => $VisitorName,
            'VisitorMobile' => $VisitorMobile,
            'IdCardNeed' => '0',
            'IdCard' => '',
            'Products' => $products,
            'TicketProperties' => $property,
            'OtherVisitors' => $other,
            'Memo' => ''
        );
        $response = $this->SoapClint->AgentOrderReq(array('agentOrderInfo' => $params));
        $ErrorMsg = $response->AgentOrderReqResult->ErrorMsg;
        if ($response->AgentOrderReqResult->Result == true) {
            DB::table('agent_order_sync')
                ->insert(['CompanyOrderID' => $CompanyOrderID, 'OrderID' => $response->AgentOrderReqResult->OrderNo,
                    'AddTime' => Carbon::now(), 'CompanyCode' => $CompanyCode, 'User' => \Session::get('username')]);
        }
        return $ErrorMsg;
    }

    /**
     * 门票数据管理
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function AgentProduct(Request $request)
    {
        $action = $request->input('action');
        switch ($action) {
            case 'addproduct':
                return view('control.agent_products_add');
                break;
            case 'modifyproduct':
                $id = $request->input('id');
                $row = DB::table('agent_product_id')
                    ->where('id', $id)
                    ->first();
                return view('control.agent_products_modify', compact('row'));
                break;
            case 'saveproduct':
                $product_id = $request->input('product_id');
                $product_name = $request->input('product_name');
                $companycode = $request->input('companycode');
                $type = $request->input('type');
                if ($type == 'add') {
                    DB::table('agent_product_id')
                        ->insert(['product_id' => $product_id, 'product_name' => $product_name, 'companycode' => $companycode]);
                    return redirect('control/agentproduct');
                } elseif ($type == 'modify') {
                    $id = $request->input('id');
                    DB::table('agent_product_id')
                        ->where('id', $id)
                        ->update(['product_id' => $product_id, 'product_name' => $product_name, 'companycode' => $companycode]);
                    return redirect('control/agentproduct');
                }
                break;
            case 'del':
                $id = $request->input('id');
                DB::table('agent_product_id')
                    ->where('id', $id)
                    ->delete();
                return redirect('control/agentproduct');
                break;
            default:
                $rows = DB::table('agent_product_id')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.agent_products_list', compact('rows'));
                break;
        }
    }

    /**
     * 取消订单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */

    public function OrderCancel(Request $request)
    {
        $action = $request->input('action');
        switch ($action) {
            case 'cancel':
                $CompanyCode = $request->input('CompanyCode');
                $CompanyOrderID = $request->input('CompanyOrderID');
                $TimeStamp = date('YmdHis');
                $params = array('orderInfo' => array('TimeStamp' => $TimeStamp,
                    'CompanyCode' => $CompanyCode,
                    'CompanyOrderID' => $CompanyOrderID,
                    'IdCardNeed' => ''));
                $response = $this->SoapClint->OrderCancel($params);
                $ErrorMsg = $response->OrderCancelResult->ErrorMsg;
                if ($response->OrderCancelResult->Result == true) {
                    DB::table('agent_order_cancel')
                        ->insert(['CompanyOrderID' => $CompanyOrderID, 'AddTime' => Carbon::now(),
                            'CompanyCode' => $CompanyCode, 'User' => \Session::get('username')]);
                }
                return redirect('/control/agentinterface?action=result&type=cancel&msg=' . $ErrorMsg);
                break;
            default:
                return view('control.agent_order_cancel');
                break;
        }
    }


    /**
     * 订单同步历史
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function AgentOrderSyncList(Request $request)
    {
        $Action = $request->input('action');
        switch ($Action) {
            case 'search':
                $Keyword=$request->input('keyword');
                $rows=DB::table('agent_order_sync')
                    ->where('CompanyOrderID',$Keyword)
                    ->orWhere('OrderID',$Keyword)
                    ->orWhere('User',$Keyword)
                    ->paginate(20);
                return  view('control.agent_sync_list', compact('rows'));

                break;
            default:
                $rows = DB::table('agent_order_sync')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.agent_sync_list', compact('rows'));
                break;
        }
    }


    /**
     * 订单取消历史
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function AgentOrderCancelList(Request $request)
    {
        $Action = $request->input('action');
        switch ($Action) {
            case 'search':
                $Keyword=$request->input('keyword');
                $rows=DB::table('agent_order_cancel')
                    ->where('CompanyOrderID',$Keyword)
                    ->orWhere('OrderID',$Keyword)
                    ->orWhere('User',$Keyword)
                    ->paginate(20);
                return  view('control.agent_cancel_list', compact('rows'));

                break;
            default:

                $rows=DB::table('agent_order_cancel')
                    ->get();
                foreach ($rows as $row){
                    $result=DB::table('agent_order_sync')
                        ->where('CompanyOrderID',$row->CompanyOrderID)
                        ->first();
                    DB::table('agent_order_cancel')
                        ->update(['OrderID'=>$result->OrderID]);
                }

                /*$rows = DB::table('agent_order_cancel')
                    ->orderBy('id', 'desc')
                    ->paginate(20);
                return view('control.agent_cancel_list', compact('rows'));*/
                break;
        }
    }
}
