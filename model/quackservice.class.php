<?php

class QuackService {
  function getQuacksByUserId( $id_user, $username )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT quack, `date` FROM dz2_quacks WHERE id_user=:id_user ORDER BY `date` DESC' ); // ne prepoznaje date kao stupac?
			$st->execute( array( 'id_user' => $id_user ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while( $row = $st->fetch() )
      $arr[] = new Quack( $username, $row['quack'], $row['date']);
    return $arr;
	}

  function addQuack( $id_user, $quack )
  {
      try{
          $db = DB::getConnection();
    			$st = $db->prepare( 'INSERT INTO dz2_quacks VALUES( DEFAULT, :id_user, :quack, :mysqldate) ' );
    			$st->execute( array( 'id_user' => $id_user , 'quack' => $quack, 'mysqldate' => date( 'Y-m-d H:i:s' ) ) ); // moze ovak?
      }
  		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
  }

  function startFollowing( $id_user, $username )
  {
    try{
        $db = DB::getConnection();

        $st1 = $db->prepare( 'SELECT id FROM dz2_users WHERE username = :username' );
        $st1->execute( array( 'username' => $username ) );
        $row1 = $st1->fetch();
        if( ! $row1 )
            return -1;

        $st = null;

        $st = $db->prepare( 'SELECT * FROM dz2_follows WHERE id_user = :id_user AND id_followed_user = :id_followed_user');
        $st->execute( array( 'id_user' => $id_user, 'id_followed_user' => $row1['id'] ) );
        if( $st->rowCount() == 1 )
          return 0;

        if( $row = $st->fetch() )
            return 0;

        $st = null; // trea li ovo?
        $st = $db->prepare( 'INSERT INTO dz2_follows VALUES( :id_user, :id_followed_user ) ' );
        $st->execute( array( 'id_user' => $id_user , 'id_followed_user' => $row1['id'] ) );
    }
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    return 1;
  }

  function stopFollowing( $id_user, $username )
  {
    try{
        $db = DB::getConnection();

        $st1 = $db->prepare( 'SELECT id FROM dz2_users WHERE username = :username' );
        $st1->execute( array( 'username' => $username ) );
        $row1 = $st1->fetch();
        if( ! $row1 )
            return -1;

        $st = null;
        // $st = $db->prepare( 'SELECT * FROM dz2_follows INNER JOIN dz2_users ON dz2_follows.id_followed_user = dz2_users.id WHERE dz2_follows.id_followed_user = :id_user AND dz2_users.id = :username' );
        // $st->execute( array( 'id_user' => $id_user, 'username' => $username ) );
        $st = $db->prepare( 'SELECT * FROM dz2_follows WHERE id_user = :id_user AND id_followed_user = :id_followed_user');
        $st->execute( array( 'id_user' => $id_user, 'id_followed_user' => $row1['id'] ) );
        if( !$row = $st->fetch() )
            return 0;

        $st = null; // trea li ovo?
        $st = $db->prepare( 'DELETE FROM dz2_follows WHERE id_user = :id_user AND id_followed_user = :id_followed_user' );
        $st->execute( array( 'id_user' => $id_user , 'id_followed_user' => $row1['id'] ) );
    }
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    return 1;
  }

  function getQuacksByFollowedUserId( $id_user )
  {
    try
    {
      $db = DB::getConnection();
      // $st = $db->prepare( 'SELECT id_user, quack, `date` FROM dz2_quacks WHERE id_user IN (SELECT id_followed_user FROM dz2_follows WHERE id_user = :id_user) ORDER BY `date` DESC '
      // . ' UNION  '
      // );
      $st = $db->prepare( 'SELECT dz2_users.username, dz2_quacks.quack, dz2_quacks.`date` FROM dz2_users INNER JOIN dz2_quacks ON dz2_users.id = dz2_quacks.id_user WHERE dz2_quacks.id_user IN (SELECT id_followed_user FROM dz2_follows WHERE id_user = :id_user) ORDER BY `date` DESC ');
      $st->execute( array( 'id_user' => $id_user ) );
    }
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while( $row = $st->fetch() )
    {
      $arr[] = new Quack( $row['username'], $row['quack'], $row['date']);
    }
    return $arr;
  }

  function getFollowers( $id_user )
  {
    try
    {
      $db = DB::getConnection();
      $st = $db->prepare( 'SELECT id, username FROM dz2_users WHERE id IN (SELECT id_user FROM dz2_follows WHERE id_followed_user = :id_user )' );
      $st->execute( array( 'id_user' => $id_user ) );
    }
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while( $row = $st->fetch() )
    {
      $arr[] = new User( $row['id'], $row['username']);
    }
    return $arr;
  }

  function getQuacksWithUsername( $username )
  {
    try
    {
      $db = DB::getConnection();

      $st = $db->prepare( "SELECT dz2_users.username, dz2_quacks.quack, dz2_quacks.`date` FROM dz2_users INNER JOIN dz2_quacks ON dz2_users.id = dz2_quacks.id_user WHERE dz2_quacks.quack LIKE '%@{$username}%' ORDER BY dz2_quacks.`date` DESC" );
      $st->execute();
    }
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while( $row = $st->fetch() )
      if( preg_match('/^(.* )?@'.$username.'(\W.*)?$/', $row['quack']) )
        $arr[] = new Quack( $row['username'], $row['quack'], $row['date']);

    return $arr;
  }

  function getQuacksWithTag( $tag )
  {
    try
    {
      $db = DB::getConnection();

      $st = $db->prepare( "SELECT dz2_users.username, dz2_quacks.quack, dz2_quacks.`date` FROM dz2_quacks INNER JOIN dz2_users ON dz2_users.id = dz2_quacks.id_user WHERE quack LIKE '%{$tag}%' ORDER BY `date` DESC" );
      $st->execute();
    }
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while( $row = $st->fetch() )
    {
      if( preg_match('/^(.* )?'.$tag.'(\W.*)?$/', $row['quack']) )
        $arr[] = new Quack( $row['username'], $row['quack'], $row['date']);
    }
    return $arr;
  }
};
 ?>
