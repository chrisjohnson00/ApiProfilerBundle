<?php
/**
 * Created by JetBrains PhpStorm.
 * User: cjohnson
 * Date: 10/8/13
 * Time: 8:53 AM
 * To change this template use File | Settings | File Templates.
 */

namespace ChrisJohnson00\ApiProfilerBundle\DataCollector;


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