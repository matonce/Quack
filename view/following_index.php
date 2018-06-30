<?php require_once __SITE_PATH . '/view/_header2.php';
require_once __SITE_PATH . '/view/menu.php';
require_once __SITE_PATH . '/view/error.php';
require_once __SITE_PATH . '/view/listOfQuacks.php';
?>

<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=following/newfollow">
	<input type="text" name="new_follow" placeholder="I'd like to follow a new duck!"/>
	<button type="submit" name="new_follow_button">Follow!</button>
</form>

<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=following/deletefollow">
	<input type="text" name="stop_following" placeholder="One duck is getting on my nerves..."/>
	<button type="submit" name="stop_following_button">Stop following!</button>
</form>

<?php
require_once __SITE_PATH . '/view/_footer.php';
?>
