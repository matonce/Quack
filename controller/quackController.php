<?php

class QuackController extends BaseController
{
		public function index()
		{
				if( isset( $_GET['niz'] ) && preg_match( '/^[a-z]{20}$/', $_GET['niz'] ) )
				{
						$as = new AuthenticationService();
						if( $as->registerUser( $_GET[ 'niz' ] ) === true )
						{
								$this->registry->template->message = 'Registration completed!';
								$this->registry->template->show( 'login_index' );
								exit();
						}
						else
						{
								$this->registry->template->message = "This registration array doesn't belong to one and only one duck.";
								$this->registry->template->show( 'login_index' );
								exit();
						}
				}

				if( isset( $_SESSION['username'] ) )
				{
						header( 'Location: ' . __SITE_URL . '/index.php?rt=myQuacks' );
						exit();
				}

				$this->registry->template->show( 'login_index' );
				exit();
		}

		public function login()
		{
				if( isset( $_POST[ 'login' ] ) )
				{
						if( isset( $_POST[ 'username' ] ) && isset( $_POST[ 'password' ] )  )
						{
								if( !preg_match( '/^\w{1,50}$/', $_POST['username'] ) )
										$this->registry->template->message = "That is not a proper name for a duck!";
								else
								{
										$as = new AuthenticationService();

										$user = $as->validateUser( $_POST["username"], $_POST["password"]);

										switch( $user )
										{
												case 0:
														$this->registry->template->message = "You don't exist.";
														break;
												case -1:
														$this->registry->template->message = 'Wrong password.';
														break;
												case -2:
														$this->registry->template->message = "You haven't registered yet, silly duck!";
														break;
												case 1:
														$_SESSION[ 'user_id' ] = $user->id;
														$_SESSION[ 'username' ] = $user->username;
														header( 'Location: ' . __SITE_URL . '/index.php?rt=myQuacks' );
														exit();
										}
								}
						}
						else
								$this->registry->template->message = 'Enter both username and password.';
				}
				else if( isset( $_SESSION[ 'username' ] ) ){
						header( 'Location: ' . __SITE_URL . '/index.php?rt=myquacks' );
						exit();
				}

				$this->registry->template->show( 'login_index' );
				exit();
		}

		public function signup()
		{
			if( isset( $_POST[ 'signup' ] ) )
			{
					if( isset( $_POST[ 'username' ] ) && isset( $_POST[ 'password' ] ) && isset( $_POST[ 'email' ] )
					&& $_POST[ 'username' ] !== '' && $_POST[ 'password' ] !== '' && $_POST[ 'email' ] !== '' )
					{
							if( !preg_match( '/^\w{1,50}$/', $_POST['username'] ) )
									$this->registry->template->message = "That is not a proper name for a duck!";
							else if( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) )
									$this->registry->template->message = "Enter valid e-mail address!";

							$as = new AuthenticationService();

							$user = $as->signupUser( $_POST[ 'username' ], $_POST[ 'password' ], $_POST[ 'email' ] );

							switch( $user )
							{
									case 0:
											$this->registry->template->message = "This username is taken!";
											break;
									case -1:
											$this->registry->template->message = "E-mail couldn't have been sent!";
											break;
									case 1:
											$this->registry->template->message = "You've just signed up!";
							}
					}
					else
							$this->registry->template->message = 'Enter username, password and e-mail address!';
			}
			else if( isset( $_SESSION[ 'username' ] ) )
			{
					header( 'Location: ' . __SITE_URL . '/index.php?rt=myquacks' );
					exit();
			}

			$this->registry->template->show( 'signup_index' );
			exit();
		}
};

?>
