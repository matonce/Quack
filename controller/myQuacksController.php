<?php

class MyQuacksController extends BaseController
{
  	public function index()
  	{
        $qs = new QuackService();

        if( !isset( $_SESSION[ 'username' ] ) ){
  		      header( 'Location: ' . __SITE_URL . '/index.php?rt=quack' );
            exit;
        }

        if( isset( $_POST[ 'new_quack_button' ] ) )
            if( isset( $_POST[ 'new_quack' ] ) && $_POST[ 'new_quack' ] !== '' )
            {
                $quack = $_POST[ 'new_quack' ];
                if( strlen($quack) > 140  )
                    $this->registry->template->message = "The quack is too big.";
                else
                {
                    $this->registry->template->sound = true;
                    $qs->addQuack( $_SESSION[ 'user_id' ], $quack );
                    unset( $_POST[ 'new_quack_button' ] );
                }
            }
            else
                $this->registry->template->message = "You cannot whisper a quack!";

        $this->registry->template->quacklist = $qs->getQuacksByUserId( $_SESSION[ 'user_id' ], $_SESSION[ 'username' ] );
        $this->registry->template->show( 'myQuacks_index' );
        exit();
  	}
};

?>
