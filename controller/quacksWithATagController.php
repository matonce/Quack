<?php

class QuacksWithATagController extends BaseController
{
  	public function index()
  	{
    		$qs = new QuackService();

        if( !isset( $_SESSION[ 'user_id' ] ) ){
  		      header( 'Location: ' . __SITE_URL . '/index.php?rt=quack' );
            exit;
        }

        if( isset( $_GET[ 'hashtag' ] ) ){
          if ( empty( $this->registry->template->quacklist = $qs->getQuacksWithTag( "#" . $_GET[ 'hashtag' ] ) ) ){
              $this->registry->template->tag = $_GET[ 'hashtag' ];
              $this->registry->template->message = "No quacks with such tag.";
            }
        }

        else if( isset( $_POST[ "tag_button" ] ) )
    				if( !isset( $_POST[ "tag" ] ) || !preg_match("/#[a-zA-Z_][a-zA-Z_0-9]*/", $_POST[ "tag" ] ) )
    						$this->registry->template->message = "You must enter a valid tag.";
            else if ( empty( $this->registry->template->quacklist = $qs->getQuacksWithTag( $_POST[ "tag" ] ) ) )
        				$this->registry->template->message = "No quacks with such tag.";
            else
                $this->registry->template->tag = $_POST[ "tag" ];

      	$this->registry->template->show( 'quacksWithATag_index' );
        exit();
  	}
};

?>
