<?php
/**
 * Created by JetBrains PhpStorm.
 * User: cjohnson
 * Date: 10/7/13
 * Time: 5:04 PM
 * To change this template use File | Settings | File Templates.
 */

namespace ChrisJohnson00\ApiProfilerBundle\Tests\DataCollector;

use ChrisJohnson00\ApiProfilerBundle\DataCollector\APIResponse;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testSettersAndGetters()
    {
        $message = new APIResponse();
        $message->setMethod("GET");
        $this->assertEquals("GET", $message->getMethod());
        $message->setBody("BODY");
        $this->assertEquals("BODY", $message->getBody());
        $message->setHeaders(array("I-Heart-Automation" => true));
        $this->assertEquals(array("I-Heart-Automation" => true), $message->getHeaders());
        $message->setStatusCode(200);
        $this->assertEquals(200, $message->getStatusCode());
        $message->setTime(12);
        $this->assertEquals(12, $message->getTime());
        $message->setUrl("http://localhost");
        $this->assertEquals("http://localhost", $message->getUrl());
    }
}
