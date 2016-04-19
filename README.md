# Jaeger Dependency Injection Container

[![Build Status](https://travis-ci.org/jaeger-app/di.svg?branch=master)](https://travis-ci.org/jaeger-app/di)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jaeger-app/di/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jaeger-app/di/?branch=master)
[![Author](http://img.shields.io/badge/author-@mithra62-blue.svg?style=flat-square)](https://twitter.com/mithra62)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/jaeger-app/bootstrap/master/LICENSE)

A simple dependency injection container for use with Jaeger (or stand alone). 

## Installation
Add `jaeger-app/di` as a requirement to your `composer.json`:

```bash
$ composer require jaeger-app/di
```
## Adding Services

Ideally, like all Jaeger classes, you should extend `Jaeger\Bootstrap` and initialize the parent services before adding your own like the below:

```php
use \JaegerApp\Di;

class MyDi extends Di
{
    public function getServices()
    {
        $this->container = parent::getServices(); //init existing services
		
		//add new service
        $this->container['my_service'] = function ($c) {
            $settings = new NewService;
            return $settings;
        };

		return $this->container;
    }
}
```

You can also add new Services at run time by using the `setService($name, \Closure $function)` method. 


```php
use \JaegerApp\Di;

$di = new Di();
$callable = function() {
    return 'foo to the who';
};

$di->setService('test_service', $callable);
```


## Calling Services Example


```php
use \JaegerApp\Di;

$di = new Di();

//get all the services
$services = $di->getServices();

//get a specific service
$db = $services['db']; 

//or get specific service directly
$db = $di->getService('db');

```
