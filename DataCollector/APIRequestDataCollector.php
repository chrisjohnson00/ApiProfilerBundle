<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Chris
 * Date: 10/6/13
 * Time: 3:01 PM
 * To change this template use File | Settings | File Templates.
 */

namespace ChrisJohnson00\ApiProfilerBundle\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class APIRequestDataCollector extends DataCollector
{
    private $dataStore;
    private $errorThreshold;
    private $warningThreshold;

    public function __construct($warningThreshold, $errorThreshold)
    {
        $this->dataStore        = new \SplObjectStorage();
        $this->errorThreshold   = $errorThreshold;
        $this->warningThreshold = $warningThreshold;
    }

    public function collect(SymfonyRequest $request, SymfonyResponse $response, \Exception $exception = null)
    {
        $this->data = array(
            'api_request' => array('data'             => $this->dataStore,
                                   'warningThreshold' => $this->warningThreshold,
                                   'errorThreshold'   => $this->errorThreshold)
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
        return $this->data['api_request']['data'];
    }

    public function warning()
    {
        return ($this->getTime() > $this->data['api_request']['warningThreshold']) ? true : false;
    }

    public function error()
    {
        return ($this->getTime() > $this->data['api_request']['errorThreshold']) ? true : false;
    }

    public function getTime()
    {
        $requestTime = 0;
        foreach ($this->data['api_request']['data'] as $data)
            $requestTime = $requestTime + $data->getTime();
        return $requestTime;
    }

    public function getCount()
    {
        return $this->data['api_request']['data']->count();
    }

    public function getName()
    {
        return 'api_request';
    }
}