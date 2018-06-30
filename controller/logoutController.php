<?php

session_start();

session_unset();
session_destroy();

header( 'Location: ' . __SITE_URL . '/index.php?rt=quack' );
exit();

?>
