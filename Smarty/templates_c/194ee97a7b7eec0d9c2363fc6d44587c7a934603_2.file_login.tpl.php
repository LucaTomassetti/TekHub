<?php
/* Smarty version 5.3.0, created on 2024-06-19 18:23:19
  from 'file:login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_667305f79d2e80_91487108',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '194ee97a7b7eec0d9c2363fc6d44587c7a934603' => 
    array (
      0 => 'login.tpl',
      1 => 1718814073,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_667305f79d2e80_91487108 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?><!DOCTYPE html>
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
      box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body>
<form method="POST" action="/TekHub/utente/login">
  <div class="login-container">
    <div class="login-box">
      <h1 class="title has-text-centered">Login</h1>

      <?php if ($_smarty_tpl->getValue('errore_log') == 1) {?>
        <div class="notification is-danger">
          <button class="delete"></button>
          Username o password non corretti!
        </div>
      <?php }?>
        
        <div class="field">
          <label class="label">Email</label>
          <div class="control">
            <input name="email-log" class="input" type="text" placeholder="Inserisci email...">
          </div>
        </div>

        <div class="field">
          <label class="label">Password</label>
          <div class="control">
            <input name="password-log" class="input" type="password" placeholder="Inserisci la password...">
          </div>
        </div>

        <div class="field">
          <div class="control">
            <button type="submit" class="button is-primary is-fullwidth">Login</button>
          </div>
        </div>

        <div class="has-text-centered">
          <a href="/TekHub/utente/signUp">Non sei registrato? Registrati!</a>
        </div>
    </div>
  </div>
</form>
</body>
</html>
<?php }
}
