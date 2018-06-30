<?php require_once __SITE_PATH . '/view/_header2.php';
require_once __SITE_PATH . '/view/menu.php';

if( isset( $tag ) && $tag !== '' ) echo "<p id='tag'>" . $tag . "</p>";
else if( isset($_GET['hashtag']) && $_GET['hashtag']!=='' ) echo "<p id='tag'>#" . $_GET['hashtag'] . "</p>";
require_once __SITE_PATH . '/view/listOfQuacks.php';
?>

<form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=quacksWithATag">
	<input type="text" name="tag" placeholder="#tag"/>
	<button type="submit" name="tag_button">Search!</button>
</form>

<?php
require_once __SITE_PATH . '/view/error.php';
require_once __SITE_PATH . '/view/_footer.php';
?>
