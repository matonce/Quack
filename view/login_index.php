<?php require_once __SITE_PATH . '/view/_header1.php'; ?>
    <h1>Quack!</h1>

  <form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=quack/login">
    <div class="imgcontainer">
      <img src="ducks.gif" alt="ducks swimming" class="ducks">
    </div>
    <div class="container">
      <div class="unit">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username">
      </div>

      <div class="unit">
      <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password">
      </div>

      <?php require_once __SITE_PATH . '/view/error.php'; ?>

      <button type="submit" clas="unit" name="login">Log in</button>
      <div class="link unit"><a href="<?php echo __SITE_URL; ?>/index.php?rt=quack/signup">Sign up</a></div>
    </div>
  </form>




<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
