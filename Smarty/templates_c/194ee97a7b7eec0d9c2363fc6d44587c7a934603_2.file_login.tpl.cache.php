<?php
/* Smarty version 5.3.0, created on 2024-06-08 13:47:51
  from 'file:login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_666444e7e99697_33791576',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '194ee97a7b7eec0d9c2363fc6d44587c7a934603' => 
    array (
      0 => 'login.tpl',
      1 => 1717847178,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_666444e7e99697_33791576 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
$_smarty_tpl->getCompiled()->nocache_hash = '1057193304666444e7e63143_93747142';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <style>
    .login-container {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-box {
      max-width: 400px;
      width: 100%;
      padding: 2rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
<form method="POST" action="homepage">
  <div class="login-container">
    <div class="login-box">
      <h1 class="title has-text-centered">Login</h1>
      <form>
        <div class="field">
          <label class="label">Email</label>
          <div class="control">
            <input class="input" type="email" placeholder="Enter your email" required>
          </div>
        </div>

        <div class="field">
          <label class="label">Password</label>
          <div class="control">
            <input class="input" type="password" placeholder="Enter your password" required>
          </div>
        </div>

        <div class="field">
          <div class="control">
            <button type="submit" class="button is-primary is-fullwidth">Login</button>
          </div>
        </div>

        <div class="has-text-centered">
          <a href="#">Forgot password?</a>
        </div>
      </form>
    </div>
  </div>
</form>
</body>
</html>
<?php }
}
