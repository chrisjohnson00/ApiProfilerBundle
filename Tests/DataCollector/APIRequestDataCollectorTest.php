<?php
/**
 * Created by JetBrains PhpStorm.
 * User: cjohnson
 * Date: 10/8/13
 * Time: 9:17 AM
 * To change this template use File | Settings | File Templates.
 */

namespace ChrisJohnson00\ApiProfilerBundle\Tests\DataCollector;


use ChrisJohnson00\ApiProfilerBundle\DataCollector\APIRequestDataCollector;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class APIRequestDataCollectorTest extends \PHPUnit_Framework_TestCase
{
    private $apiRequestDataCollector1;
    private $apiRequestDataCollector2;

    public function setUp()
    {
        $this->apiRequestDataCollector1 = new APIRequestDataCollector();
        $this->apiRequestDataCollector2 = new APIRequestDataCollector();
        for ($i = 0; $i < 10; $i++)
        {
            $this->apiRequestDataCollector1->attachData("http://localhost", "GET", array("User-Agent", "My fancy user agent"), "Odelay", 10000, array("Date" => "Some time"), 200, "Yodelay");
            $this->apiRequestDataCollector2->attachData("http://localhost", "GET", array("User-Agent", "My fancy user agent"), "Odelay", 10, array("Date" => "Some time"), 200, "Yodelay");
        }
        $this->apiRequestDataCollector1->collect(new SymfonyRequest(), new SymfonyResponse);
    }

    public function testGetCount()
    {
        $this->assertEquals(10, $this->apiRequestDataCollector1->getCount());
        $this->assertEquals(10, $this->apiRequestDataCollector2->getCount());
    }

    public function testGetTime()
    {
        $this->assertEquals(100000, $this->apiRequestDataCollector1->getTime());
        $this->assertEquals(100, $this->apiRequestDataCollector2->getTime());

    }

    public function testWarning()
    {
        $this->assertTrue($this->apiRequestDataCollector1->warning());
        $this->assertFalse($this->apiRequestDataCollector2->warning());
    }

    public function testError()
    {
        $this->assertTrue($this->apiRequestDataCollector1->error());
        $this->assertFalse($this->apiRequestDataCollector2->error());
    }
}
