<?php

require_once  __DIR__ . "/../template-parts/header.php";


$email = '';
$password = '';

if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $userMgr = new UserManager();

  $userObj = $userMgr->login($email, $password);

  if ($userObj) {
    $_SESSION['user'] = serialize($userObj);
    if (isset($_SESSION['client_id'])) {
      $cartMgr = new CartManager();
      //var_dump($_SESSION); die;
      $cartMgr->mergeCarts();
    }
    echo "<script>location.href='".ROOT_URL."user?page=dashboard';</script>";
    exit;
  } else {
    global $alertMsg;
    $alertMsg = 'login_err';
  }
}
?>


<div style="text-align: center;">
  <img src="<?php echo ROOT_URL; ?>img/r.png" alt="logo" style="width: 90px; height: auto; margin-left: auto; margin-right: auto;">
</div>

<div class="login-header" style="text-align: center;">
    <h1 style="font-size: 50px;">𝐋𝐨𝐠𝐢𝐧</h1>
</div>





<form method="post" class="mb-4">
  <div class="form-group">
    <label for="email">Email</label>
    <input name="email" id="email" type="text" class="form-control" value="<?php echo $email; ?>">
  </div>
  <div class="form-group">
    <label for="name">Password</label>
    <input name="password" id="password" type="password" class="form-control" value="<?php echo $password; ?>">
  </div>
  <input class="btn btn-primary" type="submit" value="login" name="login">
  <a class="underline" href="<?php echo ROOT_URL; ?>auth?page=register">Non hai un account? Registrati</a>
</form>