<?php

class FollowingController extends BaseController
{
  	public function index()
  	{
        $qs = new QuackService();

        if( !isset( $_SESSION[ 'username' ] ) ){
  		      header( 'Location: ' . __SITE_URL . '/index.php?rt=quack' );
            exit;
        }

        $this->registry->template->quacklist = $qs->getQuacksByFollowedUserId( $_SESSION[ 'user_id' ] );
    		$this->registry->template->show( 'following_index' );
  	}

  	public function newfollow()
  	{
    		$qs = new QuackService();

        if( !isset( $_SESSION[ 'username' ] ) ){
  		      header( 'Location: ' . __SITE_URL . '/index.php?rt=quack' );
            exit;
        }

    		if( isset( $_POST[ "new_follow_button" ] ) )
    		{
    				if( !isset( $_POST[ "new_follow" ] ) || $_POST[ "new_follow" ] === '' )
    						$this->registry->template->message = "You must enter a valid username!";
            else if( $_POST[ "new_follow" ] === $_SESSION[ 'username' ] )
    						$this->registry->template->message = "You can't follow yourself!";
    				else
              switch ( $qs->startFollowing( $_SESSION[ "user_id"], $_POST[ "new_follow" ] ) ){
      						case -1:
      								$this->registry->template->message = "You must enter an existing duck!";
                      break;
      						case 0:
      								$this->registry->template->message = "You're already following this duck!";
                      break;
      						case 1:
      								$this->registry->template->message = "You've just started following " . $_POST[ "new_follow" ] ."!";
      				        break;
      		    }
        }
    		$this->registry->template->quacklist = $qs->getQuacksByFollowedUserId( $_SESSION[ 'user_id' ] );
    		$this->registry->template->show( 'following_index' );
        exit();
  	}

    public function deletefollow()
  	{
    		$qs = new QuackService();

        if( !isset( $_SESSION[ 'username' ] ) ){
  		      header( 'Location: ' . __SITE_URL . '/index.php?rt=quack' );
            exit;
        }

    		if( isset( $_POST[ "stop_following_button" ] ) )
    				if( !isset( $_POST[ "stop_following" ] ) || $_POST[ "stop_following" ] === '' )
    						$this->registry->template->message = "You must enter a valid username!";
            else
      				switch ( $qs->stopFollowing( $_SESSION[ "user_id"], $_POST[ "stop_following" ] ) )
              {
      						case -1:
      								$this->registry->template->message = "There is no duck with such name!";
                      break;
      						case 0:
      								$this->registry->template->message = "You must enter someone you're currently following!";
                      break;
      						case 1:
      								$this->registry->template->message =  "You've just stopped following " . $_POST[ "stop_following" ] ."!";
                      break;
      				}

    		$this->registry->template->quacklist = $qs->getQuacksByFollowedUserId( $_SESSION[ 'user_id' ] );
    		$this->registry->template->show( 'following_index' );
        exit();
  	}
};

?>
