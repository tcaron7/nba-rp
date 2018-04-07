<?php

class Route
{

	private $path;
	private $callable;
	private $matches = [];
	private $params  = [];

	public function __construct( $path, $callable )
	{
		$this->path     = trim( $path, '/' );
		$this->callable = $callable;
	}

	public function getPath()
	{
		return $this->path;
	}

	public function fillPath( $params = [] )
	{
		$path = $this->path;
		foreach ( $params as $name => $value )
		{
			$path = str_replace( ":$name", $value, $path );
		}
		return $path;
	}

	public function match( $url )
	{
		$url   = trim( $url, '/' );
		$path  = preg_replace( '#:([\w]+)#', '([^/]+)', $this->path );
		$regex = "#^$path$#i";

		if ( !preg_match( $regex, $url, $matches ) )
		{
			return false;
		}

		array_shift( $matches );
		$this->matches = $matches;
		return true;
	}

	public function call()
	{
		if ( is_string( $this->callable ) )
		{
			$params     = explode( '::', $this->callable );
			$controller = new $params[0]();
			$function   = $params[1];
			return call_user_func_array( [$controller, $function], $this->matches );
		}
		else
		{
			return call_user_func_array( $this->callable, $this->matches );
		}
	}

}