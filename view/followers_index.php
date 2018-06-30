<?php require_once __SITE_PATH . '/view/_header2.php';
require_once __SITE_PATH . '/view/menu.php';
?>

<div id='ducklings'>
  <?php
		if ( isset( $duckList ) && !empty( $duckList ) )
			foreach( $duckList as $duck )
				echo "<p>" . $duck->username . "</p>";
		else
			echo "<p>No one is following you... :(</p>";
	?>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
