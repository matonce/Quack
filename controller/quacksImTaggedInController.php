<?php

class QuacksImTaggedInController extends BaseController
{
  	public function index()
  	{
        $qs = new QuackService();

        if( !isset( $_SESSION[ 'username' ] ) ){
  		      header( 'Location: ' . __SITE_URL . '/index.php?rt=quack' );
            exit;
        }

        $this->registry->template->quacklist = $qs->getQuacksWithUsername( $_SESSION[ 'username' ] );
    		$this->registry->template->show( 'quacksImTaggedIn_index' );
        exit();
  	}
};

?>
