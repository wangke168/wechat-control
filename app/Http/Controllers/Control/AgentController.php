<?php

namespace App\Http\Controllers\Control;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use SoapClient;
use SoapHeader;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type');
        switch ($type) {
            case 'test':
                return $this->post_order_test();
                break;
            default:

                return view('control.agentinterface');
                break;
        }
    }


    private function post_order_test()
    {


        /*      [CompanyCode=[ymxytest0fjloa],
                  CompanyName=[圆明新园测试],
                  CompanyOrderID=[123123423],
                  Products=[<product><viewid>F01</viewid><viewname>新圆明园(春苑)(电子票6折)</viewname></product>],
              OrderTime=[2017-10-02 11:49:45],
              ArrivalDate=[2017-10-06],
              PayType=[1],
              VisitorName=[张三],
              VisitorMobile=[13605725464],
              IdCard=[],
              Products=[<product><viewid>F01</viewid><viewname>新圆明园(春苑)(电子票6折)</viewname></product>],
              TicketProperties=[<PropertyAndNumber><Property>Adult</Property><Number>1</Number></PropertyAndNumber>],
              OtherVisitors=[], Memo=[], ]*/
//        $time=date(format,timestamp);

               $post_data = '<?xml version=\"1.0\" encoding=\"utf-8\"?>
                           <soap12:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                             <soap12:Body>
                              <AgentOrderReq xmlns="http://tempuri.org/">
                           <agentOrderInfo>
                           <TimeStamp>20171003162344</TimeStamp>
                           <CompanyCode>ymxytest0fjloa</CompanyCode>
                           <CompanyName>圆明新园测试</CompanyName>
                           <CompanyOrderID>1234567891</CompanyOrderID>
                           <OrderTime>2017-10-03 09:14:25</OrderTime>
                           <ArrivalDate>2017-10-13</ArrivalDate>
                           <PayType>1</PayType>
                           <VisitorName>测试</VisitorName>
                           <VisitorMobile>13605725464</VisitorMobile>
                           <IdCard></IdCard>
                           <Products>%s</Products>
                           <TicketProperties>%s</TicketProperties>
                            <OtherVisitors></OtherVisitors>
                           <Memo>订单号:1234567891</Memo>
                           </agentOrderInfo>
                           </AgentOrderReq>
                           </soap12:Body>
                           </soap12:Envelope>';

        $products = "<product>
                    <viewid>F01</viewid>
                    <viewname>新圆明园(春苑)(电子票6折)</viewname>
                    </product>";

//        $products = array("product" => array("viewid" => "F01", "viewname" => "新圆明园(春苑)(电子票6折)"));
        $property = "<PropertyAndNumber>
                    <Property>Adult</Property>
                    <number>2</number>
                    <PropertyAndNumber>";

//        $property = array("PropertyAndNumber" => array("Property" => "Adult", "number" => 2));

        $show_info = array('TimeStamp' => '20171003162344',
            'CompanyCode' => 'ymxytest0fjloa',
            'CompanyName' => '圆明新园测试',
            'CompanyOrderID' => '1234567891',
            'OrderTime' => '2017-10-03 09:14:25',
            'ArrivalDate' => '2017-10-13',
            'PayType' => '1',
            'VisitorName' => '测试',
            'VisitorMobile' => '13605725464',
            'IdCardNeed' => '',
            'IdCard' => '',
            'Products' => $products,
            'TicketProperties' => $property,
            'OtherVisitors' => '',
            'Memo' => 'fdgdf');


        $post_info = array("agentOrderInfo" => $show_info);
//        print_r($post_info);
//        return $show_info;

        ini_set('soap.wsdl_cache_enabled','0');//关闭缓存
        $wsdl = 'http://aaa.hdyuanmingxinyuan.com/interface/agentinterface.asmx?WSDL';

//        $soap = new SoapClient('http://localhost/soap_demo/server.php?wsdl');
        $resultStr = sprintf($post_data, $products,$property);
//        return $resultStr;
        $soap = new SoapClient($wsdl);

        try {
            $result = $soap->AgentOrderReq($resultStr);
            print_r($result);
        } catch (SoapFault $e) {
            echo 'error';
            echo 'Message: ' . $e->getMessage();
        }


        /*        echo('<pre>');
                var_dump($soap->__getFunctions());
                echo('</pre>');
                echo("SOAP服务器提供的Type:");

                echo('<pre>');
                var_dump($soap->__getTypes());
                echo('</pre>');*/

        /* return $soap->__getLastRequest();
         try {
             $result = $soap->__doRequest($resultStr, $wsdl, 'http://tempuri.org/AgentOrderReq', 1.2, 0);
             print_r($result);
         } catch (SoapFault $e) {
             echo $e->getMessage();
         } catch (Exception $e) {
             echo $e->getMessage();
         }*/
//        return $resultStr;

    }

    private function post_template()
    {
        $template = "<agentOrderInfo>
                    <TimeStamp><![CDATA[%s]]></TimeStamp>
                    <CompanyCode>ymxytest0fjloa</CompanyCode>
                    <CompanyName>圆明新园测试</CompanyName>
                    <CompanyOrderID><![CDATA[%s]]></CompanyOrderID>
                    <OrderTime><![CDATA[%s]]></OrderTime>
                    <ArrivalDate><![CDATA[%s]]></ArrivalDate>
                    <PayType>st<![CDATA[%s]]>ring</PayType>
                    <VisitorName><![CDATA[%s]]></VisitorName>
                    <VisitorMobile><![CDATA[%s]]></VisitorMobile>
                    <IdCardNeed><![CDATA[%s]]></IdCardNeed>
                    <IdCard><![CDATA[%s]]></IdCard>
                    <Products><![CDATA[%s]]></Products>
                    <TicketProperties><![CDATA[%s]]></TicketProperties>
                    <OtherVisitors><![CDATA[%s]]></OtherVisitors>
                    <Memo><![CDATA[%s]]></Memo>
                    </agentOrderInfo>";
        return $template;
    }
    /*
    <soap:Body>
    <AgentOrderReq xmlns="http://tempuri.org/">
    <agentOrderInfo>
    <TimeStamp>string</TimeStamp>
    <CompanyCode>string</CompanyCode>
    <CompanyName>string</CompanyName>
    <CompanyOrderID>string</CompanyOrderID>
    <OrderTime>string</OrderTime>
    <ArrivalDate>string</ArrivalDate>
    <PayType>string</PayType>
    <VisitorName>string</VisitorName>
    <VisitorMobile>string</VisitorMobile>
    <IdCardNeed>int</IdCardNeed>
    <IdCard>string</IdCard>
    <Products>string</Products>
    <TicketProperties>string</TicketProperties>
    <OtherVisitors>string</OtherVisitors>
    <Memo>string</Memo>
    </agentOrderInfo>
    </AgentOrderReq>
    </soap:Body>
    */

}
