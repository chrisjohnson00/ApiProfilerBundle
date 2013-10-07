<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Chris
 * Date: 10/6/13
 * Time: 3:01 PM
 * To change this template use File | Settings | File Templates.
 */

namespace ChrisJohnson00\ApiProfilerBundle\Profiler;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class APIRequestDataCollector extends DataCollector
{
    private $dataStore;


    public function __construct()
    {
        $this->dataStore = new \SplObjectStorage();
    }

    public function collect(SymfonyRequest $request, SymfonyResponse $response, \Exception $exception = null)
    {
        $this->data = array(
            'api_request' => $this->dataStore
        );
    }

    public function attachData($url, $method, $requestHeaders = array(), $requestBody = null, $time, $responseHeaders = array(), $statusCode, $responseBody = null)
    {
        $request = new APIRequest();
        $request->setUrl($url);
        $request->setMethod($method);
        $request->setHeaders($requestHeaders);
        $request->setBody($requestBody);

        $response = new APIResponse();
        $response->setTime($time);
        $response->setHeaders($responseHeaders);
        $response->setStatusCode($statusCode);
        $response->setBody($responseBody);

        $data = new APIData();
        $data->setRequest($request);
        $data->setResponse($response);

        $this->dataStore->attach($data);
    }

    public function getAPIData()
    {
        return $this->data['api_request'];
    }

    public function warning()
    {
        return ($this->getTime() > 5000) ? true : false;
    }

    public function error()
    {
        return ($this->getTime() > 10000) ? true : false;
    }

    public function getTime()
    {
        $requestTime = 0;
        foreach ($this->data['api_request'] as $data)
            $requestTime = $requestTime + $data->getTime();
        return $requestTime;
    }

    public function getCount()
    {
        return $this->data['api_request']->count();
    }

    public function getName()
    {
        return 'api_request';
    }
}

class APIRequest extends message
{

}

class APIResponse extends message
{

}

class APIData
{
    private $request;
    private $response;
    private $key;

    public function getKey()
    {
        if (is_null($this->key))
            $this->key = uniqid();
        return $this->key;
    }

    public function getTime()
    {
        return $this->response->getTime();
    }

    public function setRequest(APIRequest $request)
    {
        $this->request = $request;
        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function setResponse(APIResponse $response)
    {
        $this->response = $response;
        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }

}

class message
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