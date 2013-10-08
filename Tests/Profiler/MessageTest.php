<?php
/**
 * Created by JetBrains PhpStorm.
 * User: cjohnson
 * Date: 10/7/13
 * Time: 5:04 PM
 * To change this template use File | Settings | File Templates.
 */

namespace ChrisJohnson00\ApiProfilerBundle\Profiler\Tests;

use ChrisJohnson00\ApiProfilerBundle\Profiler\APIResponse;

class MessageTest extends \PHPUnit_Framework_TestCase
{
	public function testSettersAndGetters()
    {
        $message = new APIResponse();
        $message->setMethod("GET");
        $this->assertEquals("GET",$message->getMethod());
        $message->setBody("BODY");
        $this->assertEquals("BODY",$message->getBody());
    }

}
