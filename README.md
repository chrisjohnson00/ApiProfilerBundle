# ApiProfilerBundle

This bundle adds a REST API profiler/debugger to the Symfony 2 Profiler

## Installation

### Installation by Composer

Add ApiProfilerBundle bundle as a dependency to the composer.json of your application

    "require": {
        ...
        "chrisjohnson00/api-profiler-bundle": "dev-master"
        ...
    },

Or on the command line with
`composer require chrisjohnson00/api-profiler-bundle`

## Add ApiProfilerBundle to your application kernel.

```php
// app/AppKernel.php
<?php
    // ...
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new ChrisJohnson00\ApiProfilerBundle\ChrisJohnson00ApiProfilerBundle(),
        );
    }
```

## Usage

A service will be registered by the name of `data_collector.api_request`.  To have API request information included in the profiler, you must attach the profile data using the service.

```php
$theService->attachData($theURL,
                        $theRequestMethod,
                        $theRequestHeadersAsAnAssociativeArray,
                        $theRequestBody,
                        $theResponseTimeInMilliseconds,
                        $theResponseHeadersAsAnAssociativeArray,
                        $theHTTPStatusCode,
                        $theResponseBody);
```

Here's the full signature:
```php
public function attachData( $url,
                            $method,
                            $requestHeaders = array(),
                            $requestBody = null,
                            $time,
                            $responseHeaders = array(),
                            $statusCode,
                            $responseBody = null)
```

Here's a simple example:
```php
$theService->attachData("http://localhost/api/status",
                        "GET",
                        array('User-Agent'=>'My fancy application'),
                        null,
                        125,
                        array('Date'=>'Mon, 07 Oct 2013 00:50:46 GMT','Server'=>'Apache'),
                        200,
                        "Everything is groovy!!");
```



