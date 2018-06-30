<?php
	if( isset( $sound ) && $sound === true)
		 echo "<audio autoplay> <source src=\"sound.mp3\" type=\"audio/mpeg\"> </audio></br>";
	require_once __SITE_PATH . '/view/_header2.php';
	require_once __SITE_PATH . '/view/menu.php';
	require_once __SITE_PATH . '/view/error.php';
	require_once __SITE_PATH . '/view/listOfQuacks.php';
?>

<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=myQuacks">
	<input type="text" name="new_quack" placeholder="I want to quack about something..."/>
	<button type="submit" name="new_quack_button">Quack!</button>
</form>

<?php
require_once __SITE_PATH . '/view/_footer.php';
?>
