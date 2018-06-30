<?php

class Quack
{
	protected $username, $quack, $date;

	function __construct( $username, $quack, $date )
	{
		$this->username = $username;
		$this->quack = $quack;
		$this->date = $date;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
