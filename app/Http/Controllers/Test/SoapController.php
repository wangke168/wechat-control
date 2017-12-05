<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Artisaninweb\SoapWrapper\SoapWrapper;

class SoapController extends Controller
{

    private $SoapClint;
    private $CompanyCode;

    public function index(Request $request)
    {
        $type = $request->input('type');
        switch ($type) {
            case 'Verify':
//                $this->Verify();
                break;
            case 'OrderReq':
                $this->OrderReq();
                break;
            case 'OrderCancel':
                $this->OrderCancel();
                break;
        }
    }

    public function __construct()
    {
        $this->SoapClint = new \SoapClient("http://aaa.hdyuanmingxinyuan.com/interface/AgentInterface.asmx?WSDL");
        $this->CompanyCode = 'ymxytest0fjloa';
    }

    private function OrderCancel()
    {
        $params = array('orderInfo' => array('TimeStamp' => '20171025123644',
            'CompanyCode' => $this->CompanyCode,
            'CompanyName' => '圆明新园测试',
            'CompanyOrderID' => '3765534456',
            'IdCardNeed' => ''));
        try {
            var_dump($params);
            $response = $this->SoapClint->OrderCancel($params);
            var_dump($response);
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
        /*                echo("SOAP服务器提供的开放函数:");
                       echo('<pre>');
                       var_dump($this->SoapClint->__getFunctions());
                       echo('</pre>');
                       echo("SOAP服务器提供的Type:");

                       echo('<pre>');
                       var_dump($this->SoapClint->__getTypes());
                       echo('</pre>');*/
    }

    private function OrderReq()
    {
//        $client = new \SoapClient("http://aaa.hdyuanmingxinyuan.com/interface/AgentInterface.asmx?WSDL");
        $products = "<product>
                    <viewid>F01</viewid>
                    <viewname>新圆明园(春苑)(电子票6折)</viewname>
                    </product>";

//        $products = array("product" => array("viewid" => "F01", "viewname" => "新圆明园(春苑)(电子票6折)"));
        $property = "<PropertyAndNumber>
                    <Property>Adult</Property>
                    <Number>2</Number>                  
                    </PropertyAndNumber>
                    <PropertyAndNumber>
                    <Property>Elder</Property>
                    <Number>2</Number>                  
                    </PropertyAndNumber>";

        $other = "<OtherVisitor>
                   <VisitorName></VisitorName>
                <IdNumber></IdNumber>
                </OtherVisitor>";
        $params = array('TimeStamp' => '20171025123644',
            'CompanyCode' => 'ymxytest0fjloa',
            'CompanyName' => '圆明新园测试',
            'CompanyOrderID' => '533765532343',
            'OrderTime' => '2017-11-14 09:14:25',
            'ArrivalDate' => '2017-11-30',
            'PayType' => '1',
            'VisitorName' => '测试',
            'VisitorMobile' => '13605725464',
            'IdCardNeed' => '0',
            'IdCard' => '',
            'Products' => $products,
            'TicketProperties' => $property,
            'OtherVisitors' => $other,
            'Memo' => 'fdgdf'
        );


//        var_dump(array('agentOrderInfo' => $params));
        $response = $this->SoapClint->AgentOrderReq(array('agentOrderInfo' => $params));
        var_dump($response);
//        var_dump($response->AgentOrderReqResult->PropertyMsg);
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

class temp_info
{

    public $CompanyOrderID;

    public $Result;

    public $ErrorMsg;

    public $DealTime;

    public $ErrorCode;

    public $OrderNo;
}