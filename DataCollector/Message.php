<?php
/**
 * Created by JetBrains PhpStorm.
 * User: cjohnson
 * Date: 10/8/13
 * Time: 8:53 AM
 * To change this template use File | Settings | File Templates.
 */

namespace ChrisJohnson00\ApiProfilerBundle\DataCollector;

abstract class Message
{
    private $headers;
    private $body;
    private $url;
    private $time = 0;
    private $statusCode;
    private $method;

    public function setMethod($m)
    {
        $this->method = strtoupper($m);
        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setHeaders(array $a)
    {
        $this->headers = $a;
        return $this;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setBody($b)
    {
        $this->body = $b;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setUrl($u)
    {
        $this->url = $u;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setTime($t)
    {
        $this->time = $t;
        return $this;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setStatusCode($c)
    {
        $this->statusCode = $c;
        return $this;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}