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
//        return $type;
        switch ($type) {
            case 'Verify':
//                return 'sdsf';
                $this->Verify();
                break;
            case 'OrderReq':
                $this->OrderReq();
                break;
            case 'OrderCancel':
                $this->OrderCancel();
                break;
            case 'OrderQuery':
                $this->OrderQuery();
                break;
        }
    }

    public function __construct()
    {

        $wsdl = env('AGENT_WSDL', '');
        $this->SoapClint = new \SoapClient($wsdl);
        $this->CompanyCode = 'tbzy2hzddgj2021012';
    }

    private  function OrderQuery()
    {
        $params = array('agentOrderInfo' => array('TimeStamp' => '20210121123644',

            'IdCardNeed' => ''));
        $response = $this->SoapClint->AgentOrderQuery($params);
        var_dump($response);
    }

    private function OrderCancel()
    {
        $params = array('orderInfo' => array('TimeStamp' => '20210121123644',
            'CompanyCode' => $this->CompanyCode,
//            'CompanyName' => '自营店测试',
            'CompanyOrderID' => '533765532343',
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
                    <viewid>1111C</viewid>
                    <viewname>测试</viewname>
                    </product>";

//        $products = array("product" => array("viewid" => "F01", "viewname" => "新圆明园(春苑)(电子票6折)"));
        $property = "<PropertyAndNumber>
                    <Property>Adult</Property>
                    <Number>1</Number>                  
                    </PropertyAndNumber>
                      ";

        $other = "<OtherVisitor>
                   <VisitorName></VisitorName>
                <IdNumber></IdNumber>
                </OtherVisitor>";
        $params = array('TimeStamp' => '20171025123644',
            'CompanyCode' => 'tbzy2hzddgj2021012',
            'CompanyName' => '圆明新园测试',
            'CompanyOrderID' => '533765532343',
            'OrderTime' => '2021-1-21 09:14:25',
            'ArrivalDate' => '2021-1-27',
            'PayType' => '1',
            'VisitorName' => '测试',
            'VisitorMobile' => '13605725464',
            'IdCardNeed' => '0',
            'IdCard' => '330724197811270010',
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

    public function Verify()
    {
//        return 'dfsf';
//        $client = new \SoapClient("http://aaa.hdyuanmingxinyuan.com/interface/AgentInterface.asmx?WSDL");
        $products = "<product>
                    <viewid>1111C</viewid>
                    <viewname>测试</viewname>
                    </product>";

//        $products = array("product" => array("viewid" => "F01", "viewname" => "新圆明园(春苑)(电子票6折)"));
        $property = "<PropertyAndNumber>
                    <Property>Adult</Property>
                    <Number>2</Number>                  
                    </PropertyAndNumber>
                      ";

        $other = "<OtherVisitor>
                   <VisitorName>李四</VisitorName>
                <IdNumber>330823197206194514</IdNumber>
                </OtherVisitor>";


        $params = array('TimeStamp' => '20171025123644',
            'CompanyCode' => 'tbzy2hzddgj2021012',
            'CompanyName' => '圆明新园测试',
            'CompanyOrderID' => '533765532343',
            'OrderTime' => '2021-1-21 09:14:25',
            'ArrivalDate' => '2021-1-27',
            'PayType' => '1',
            'VisitorName' => '张三',
            'VisitorMobile' => '13605725464',
            'IdCardNeed' => '1',
            'IdCard' => '3307241911270010',
            'Products' => $products,
            'TicketProperties' => $property,
            'OtherVisitors' => $other,
            'Memo' => '备注'
        );


//        var_dump($params);
//        echo json_encode((array('agentOrderInfo' => $params)));
        $response = $this->SoapClint->AgentOrderVerifyNew(array('agentOrderInfo' => $params));
//        $response = $this->SoapClint->AgentOrderVerifyNew($testinfo->toArray());
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
