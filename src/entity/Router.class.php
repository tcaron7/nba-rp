<?php

class Router
{

	private $url;
	private $server;
	private $routes      = [];
	private $namedRoutes = [];

	public function __construct( $url, $server )
	{
		$this->url    = $url;
		$this->server = $server;
	}

	public function get( $path, $callable, $name = null )
	{
		return $this->add( $path, $callable, $name, 'GET' );
	}

	public function post( $path, $callable, $name = null )
	{
		return $this->add( $path, $callable, $name, 'POST' );
	}

	public function delete( $path, $callable, $name = null )
	{
		return $this->add( $path, $callable, $name, 'DELETE' );
	}

	private function add( $path, $callable, $name, $method )
	{
		$route = new Route( $path, $callable );
		$this->routes[$method][] = $route;

		if ( is_string( $callable ) && $name === null )
		{
			$name = $callable;
		}
		if ( $name )
		{
			$this->namedRoutes[$name] = $route;
		}
		return $route;
	}

	public function run()
	{
		if ( !isset( $this->routes[$_SERVER['REQUEST_METHOD']] ) )
		{
			throw new Exception( 'REQUEST_METHOD does not exist' );
		}

		foreach( $this->routes[$_SERVER['REQUEST_METHOD']] as $route )
		{
			if ( $route->match( $this->url ) )
			{
				return $route->call();
			}
		}
		throw new Exception( 'No matching routes "' . $this->url . '"' );
	}

	public function generateUrl( $name, $params = [] )
	{
		if ( !isset( $this->namedRoutes[$name] ) )
		{
			throw new Exception( 'No route matches this name' );
		}
		return $this->server . $this->namedRoutes[$name]->fillPath( $params );
	}

}