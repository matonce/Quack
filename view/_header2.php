<!-- ?php
echo '$_SESSION:';  print_r( $_SESSION );    echo "</br></br>";
echo '$_POST:';  print_r( $_POST );   echo "</br></br>";
echo '$_GET:';  print_r( $_GET );   echo "</br></br>";
 ?> -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quack!</title>
	<link rel="stylesheet" href="<?php echo __SITE_URL;?>/css/style.css">
</head>
<body id="other">
	  <h2>Quack!</h2>
	  <div id="username">@<?php echo $_SESSION['username'];?></br>
			<a href="<?php echo __SITE_URL; ?>/index.php?rt=logout">logout</a></div>
