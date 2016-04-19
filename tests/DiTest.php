<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./tests/DiTest.php
 */
namespace JaegerApp\tests;

use JaegerApp\Di; 

/**
 * Jaeger - Bootstrap object Unit Tests
 *
 * Contains all the unit tests for the \mithra62\Bootstrap object
 *
 * @package Jaeger\Tests
 * @author Eric Lamb <eric@mithra62.com>
 */
class DiTest extends \PHPUnit_Framework_TestCase
{   
    public function testContainerPropertyInstance()
    {
        $this->assertClassHasAttribute('container', '\JaegerApp\Di');
        
        $m62 = new Di();
        $this->assertInstanceOf('\Pimple\Container', $m62->getContainer());
    }
    
    public function testSetContainerReturnInstance()
    {
        $bootstrap = new Di();
        $this->assertInstanceOf('\JaegerApp\Di', $bootstrap->setContainer(new \Pimple\Container));
    }
    
    public function testSetServiceReturnInstance()
    {
        $bootstrap = new Di();
        $callable = function() {
            return 'foo to the who';
        };
        $this->assertInstanceOf('\JaegerApp\Di', $bootstrap->setService('test_service', $callable));
    }
    
    public function testSetServiceCallable()
    {
        $bootstrap = new Di();
        $callable = function() {
            return 'foo to the who';
        };
        
        $bootstrap->setService('test_service', $callable);
        $services = $bootstrap->getServices();
        $this->assertArrayHasKey('test_service', $services);
        $this->assertEquals('foo to the who', $services['test_service']);
        $this->assertEquals('foo to the who', $bootstrap->getService('test_service'));
    }
}