<?php
/* Smarty version 5.3.0, created on 2024-06-08 13:28:52
  from 'file:login.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCached()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_6664407483d5f2_45593762',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2da1a35544102362af8f4851dea934670209707b' => 
    array (
      0 => 'login.html',
      1 => 1717846085,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 3600,
))) {
function content_6664407483d5f2_45593762 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
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
            <label class="checkbox">
              <input type="checkbox">
              Remember me
            </label>
          </div>
        </div>

        <div class="field">
          <div class="control">
            <button class="button is-primary is-fullwidth">Login</button>
          </div>
        </div>

        <div class="has-text-centered">
          <a href="#">Forgot password?</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
<?php }
}
