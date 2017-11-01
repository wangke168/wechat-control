<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use SoapClient;
use DB;

class AgentController extends Controller
{
    private $SoapClint;

//    private $CompanyCode;

    public function __construct()
    {
//        phpinfo();
//        $this->SoapClint = new SoapClient("http://aaa.hdyuanmingxinyuan.com/interface/AgentInterface.asmx?WSDL");
       $this->SoapClint = new SoapClient("http://10.0.61.201/interface/AgentInterface.asmx?WSDL");
//        $this->CompanyCode='ymxytest0fjloa';
    }

    public function index(Request $request)
    {
        $action = $request->input('action');
        $ProductName = $request->input('productname');
        $CompanyCode = $request->input('CompanyCode');
        switch ($action) {
            case 'getproductid':
                return $this->get_productid($ProductName, $CompanyCode);
                break;
            case 'addorder':
                $viewid = $request->input('ProductID');
//                $Property = $request->input('Property');
                $Number = $request->input('Number');
                $CompanyName = $request->input('CompanyName');
                $CompanyOrderID = $request->input('CompanyOrderID');
                $OrderTime = $request->input('OrderTime');
                $ArrivalDate = $request->input('ArrivalDate');
                $VisitorName = $request->input('VisitorName');
                $VisitorMobile = $request->input('VisitorMobile');

                $ErrorMsg = $this->OrderReq($viewid, $Number, $CompanyCode, $CompanyName, $CompanyOrderID, $OrderTime, $ArrivalDate, $VisitorName, $VisitorMobile);
                return redirect('/control/agentinterface?action=result&msg=' . $ErrorMsg);
                break;
            case 'result':
                $ErrorMsg = $request->input('msg');
//                $OrderNo = $request->input('no');
                return view('control.agentinterfaceresult', compact('ErrorMsg'));
                break;

            default:
                return view('control.agentinterface');
                break;
        }
    }

    public function agentproduct(Request $request){
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
                    ->where('id',$id)
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

    private function get_productid($product_name, $company_code)
    {
        $row = \DB::table('agent_product_id')
            ->where('product_name', $product_name)
            ->where('companycode', $company_code)
            ->first();
//    var_dump($row);
        return $row->product_id;
    }

    private function OrderReq($viewid, $Number, $CompanyCode, $CompanyName, $CompanyOrderID, $OrderTime, $ArrivalDate, $VisitorName, $VisitorMobile)
    {
//        return view('control.agentinterfaceresult');
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

//        var_dump(array('agentOrderInfo' => $params));
        $response = $this->SoapClint->AgentOrderReq(array('agentOrderInfo' => $params));
        /*    $data = json_decode($response, true);
            var_dump($data);*/
        $ErrorMsg = $response->AgentOrderReqResult->ErrorMsg;
        return $ErrorMsg;
        /* $OrderNo=$response->AgentOrderReqResult->OrderNo;*/
//        var_dump($response->AgentOrderReqResult);
        /* return redirect('/control/agentinterface?action=result&msg='.$ErrorMsg);
         var_dump($response->AgentOrderReqResult);*/
        /*    return view('control.agentinterfaceresult',compact(''));
            var_dump($response->AgentOrderReqResult);*/

    }

}
