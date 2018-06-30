<?php

class FollowersController extends BaseController
{
  	public function index()
  	{
        $qs = new QuackService();

        if( !isset( $_SESSION[ 'username' ] ) ){
  		      header( 'Location: ' . __SITE_URL . '/index.php?rt=quack' );
            exit;
        }

        $this->registry->template->duckList = $qs->getFollowers( $_SESSION[ 'user_id' ] );
    		$this->registry->template->show( 'followers_index' );
        exit();
  	}

};

?>
