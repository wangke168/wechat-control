<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class AgentController extends Controller
{
    private $SoapClint;

//    private $CompanyCode;

    public function __construct()
    {
        $this->SoapClint = new \SoapClient("http:///10.0.61.201/interface/AgentInterface.asmx?WSDL");
//        $this->CompanyCode='ymxytest0fjloa';
    }

    public function index(Request $request)
    {
        $action = $request->input('action');
        $ProductName = $request->input('productname');
        $CompanyCode = $request->input('CompanyCode');
        switch ($action) {
            case 'test':
                return $this->post_order_test();
                break;
            case 'getproductid':
//                return $product_name;
                return $this->get_productid($ProductName, $CompanyCode);
                break;
            case 'addorder':

                var_dump($request->all());
//                return $request->input('$OrderTime');
                $viewid = $request->input('ProductID');
//                $Property = $request->input('Property');
                $Number = $request->input('Number');
                $CompanyName = $request->input('CompanyName');
                $CompanyOrderID = $request->input('CompanyOrderID');
                $OrderTime = $request->input('OrderTime');
                $ArrivalDate = $request->input('ArrivalDate');
                $VisitorName = $request->input('VisitorName');
                $VisitorMobile = $request->input('VisitorMobile');

                echo '<br>';
                echo $ArrivalDate;
                echo '<br>';
                $this->OrderReq($viewid, $Number, $CompanyCode, $CompanyName, $CompanyOrderID, $OrderTime, $ArrivalDate, $VisitorName, $VisitorMobile);
                break;
            default:

                return view('control.agentinterface');
                break;
        }
    }

    private function get_productid($product_name, $company_code)
    {
        /* echo $product_name;
         echo '<br>';
      $product_name='【携程特权日】新圆明园(春苑)+火烧圆明园（夏苑夜景）联票（11.1-11.30）';
         echo $product_name;*/
        $row = \DB::table('agent_product_id')
            ->where('product_name', $product_name)
            ->where('companycode', $company_code)
            ->first();
//    var_dump($row);
        return $row->product_id;
    }

    private function OrderReq($viewid, $Number, $CompanyCode, $CompanyName, $CompanyOrderID, $OrderTime, $ArrivalDate, $VisitorName, $VisitorMobile)
    {
//        $client = new \SoapClient("http://aaa.hdyuanmingxinyuan.com/interface/AgentInterface.asmx?WSDL");
        $products = "<product>
                    <viewid>$viewid</viewid>
                    <viewname></viewname>
                    </product>";

//        $products = array("product" => array("viewid" => "F01", "viewname" => "新圆明园(春苑)(电子票6折)"));
        $property = "<PropertyAndNumber>
                    <Property>Adult</Property>
                    <Number>$Number</Number>                  
                    </PropertyAndNumber>";
        $other = "<OtherVisitor>
                   <VisitorName></VisitorName>
                <IdNumber></IdNumber>
                </OtherVisitor>";
        $params = array('TimeStamp' => '20171025123644',
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

        var_dump(array('agentOrderInfo' => $params));
        $response = $this->SoapClint->AgentOrderReq(array('agentOrderInfo' => $params));
        var_dump($response);
        /*        echo("SOAP服务器提供的开放函数:");
                echo('<pre>');
                var_dump($client->__getFunctions());
                echo('</pre>');
                echo("SOAP服务器提供的Type:");

                echo('<pre>');
                var_dump($client->__getTypes());
                echo('</pre>');*/
    }

}
