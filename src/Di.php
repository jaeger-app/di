<?php
/**
 * Jaeger
 *
 * @copyright	Copyright (c) 2015-2016, mithra62
 * @link		http://jaeger-app.com
 * @version		1.0
 * @filesource 	./Di.php
 */
namespace JaegerApp; 

use Pimple\Container;

/**
 * Jaeger - Dependency Injection Object
 *
 * Wrapper for a simple database interface
 *
 * @package Database
 * @author Eric Lamb <eric@mithra62.com>
 */
class Di
{
    /**
     * The Pimple DI Container object
     *
     * @var \Pimple\Container
     */
    protected $container = null;
    
    public function __construct()
    {
        $container = new Container();
        $this->setContainer($container);
    }

    /**
     * Sets the DI Container object
     * 
     * @param \Pimple\Container $container            
     */
    public function setContainer(\Pimple\Container $container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * Returns an instance of the DI Container
     * 
     * @return \Pimple\Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Sets a new service outside of the bootstrap object
     * 
     * @param string $name
     *            The name of the new service
     * @param \Closure $function
     *            The Closure to execute when the service is called
     * @return \JaegerApp\Bootstrap
     */
    public function setService($name, \Closure $function)
    {
        $this->container[$name] = $function;
        return $this;
    }
    
    /**
     * Returns a single service
     * @param string $service The name of the service we want
     * @return \Pimple\Container
     */
    public function getService($service)
    {
        if(isset($this->container[$service])) {
            return $this->container[$service];
        }
    }
    
    /**
     * Sets up and returns all the objects we'll use
     *
     * @return \Pimple\Container
     */
    public function getServices()
    {
        return $this->container;
    }
}