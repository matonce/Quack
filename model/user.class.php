<?php

class User
{
	protected $id, $username;

	function __construct( $id, $username )
	{
		$this->id = $id;
		$this->username = $username;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
