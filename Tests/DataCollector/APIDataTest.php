<?php
/**
 * Created by JetBrains PhpStorm.
 * User: cjohnson
 * Date: 10/8/13
 * Time: 9:09 AM
 * To change this template use File | Settings | File Templates.
 */

namespace ChrisJohnson00\ApiProfilerBundle\Tests\DataCollector;


use ChrisJohnson00\ApiProfilerBundle\DataCollector\APIData;
use ChrisJohnson00\ApiProfilerBundle\DataCollector\APIRequest;
use ChrisJohnson00\ApiProfilerBundle\DataCollector\APIResponse;

class APIDataTest extends \PHPUnit_Framework_TestCase
{
    private $apiData;
    private $request;
    private $response;

    public function setUp()
    {
        $this->apiData  = new APIData();
        $this->request  = new APIRequest();
        $this->response = new APIResponse();

        $this->request->setUrl("http://www.google.com");
        $this->request->setHeaders(array("User-Agent" => "My User Agent"));
        $this->request->setBody("Body");
        $this->request->setMethod("GET");

        $this->response->setBody("Yippie");
        $this->response->setHeaders(array("Date" => "Sometime"));
        $this->response->setTime(100);
        $this->response->setStatusCode("200");

        $this->apiData->setRequest($this->request);
        $this->apiData->setResponse($this->response);
    }

    public function testGettersAndSetters()
    {
        $this->assertEqual($this->request, $this->apiData->getRequest());
        $this->assertEqual($this->response, $this->apiData->getResponse());
        $this->assertEqual($this->response, $this->apiData->getTime());
        $this->assertInternalType("string", $this->apiData->getId());
    }
}
