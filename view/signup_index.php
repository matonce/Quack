<?php require_once __SITE_PATH . '/view/_header1.php'; ?>
    <h1>Quack!</h1>

  <form method="post" action="<?php echo __SITE_URL; ?>/index.php?rt=quack/signup">
    <div class="container">
      <div class="unit">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username">
    </div>

    <div class="unit">
      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password">
    </div>

    <div class="unit">
      <label for="email"><b>E-mail address</b></label>
      <input type="text" placeholder="Enter E-mail Address" name="email">
    </div>

      <?php require_once __SITE_PATH . '/view/error.php'; ?>

      <button class="unit" type="submit" name="signup">Sign up</button>
      <div class="link unit"><a href="<?php echo __SITE_URL; ?>/index.php?rt=quack">Go back</a></div>
    </div>
  </form>

<?php
require_once __SITE_PATH . '/view/error.php';
require_once __SITE_PATH . '/view/_footer.php';
?>
