<?php

class Follows
{
	protected $id_user, $id_followed_user;

	function __construct( $id_user, $id_followed_user )
	{
		$this->id_user = $id_user;
		$this->id_followed_user = $id_followed_user;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
