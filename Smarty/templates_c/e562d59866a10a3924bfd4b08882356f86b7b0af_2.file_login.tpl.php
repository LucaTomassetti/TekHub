<?php
/* Smarty version 5.3.0, created on 2024-07-12 10:38:37
  from 'file:login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_6690eb8de9e5d6_75864606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e562d59866a10a3924bfd4b08882356f86b7b0af' => 
    array (
      0 => 'login.tpl',
      1 => 1719997175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6690eb8de9e5d6_75864606 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/TekHub/Smarty/templates';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="/TekHub/skin/electro-master/css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="/TekHub/skin/electro-master/css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="/TekHub/skin/electro-master/css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="/TekHub/skin/electro-master/css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="/TekHub/skin/electro-master/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="/TekHub/skin/electro-master/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"><?php echo '</script'; ?>
>
		  <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
		<![endif]-->
</head>
<body>
    <div class="form-container">
          <h2 class="text-center">Login</h2>
          <?php if ($_smarty_tpl->getValue('errore_log') == 1) {?>
            <div class="mt-5">
                <div class="alert alert-danger" role="alert">
                    Email o password non corretti!
                </div>
            </div>
          <?php }?>       
                    <div class="card-body">
                        <form method="POST" action="/TekHub/utente/login">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email-log" type="email" class="form-control" id="email" placeholder="ad es. prova@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password-log" type="password" class="form-control" id="password" placeholder="Password...">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                    <br>
                    <div class="card-footer text-center">
                        <a href="/TekHub/utente/signUp">Non sei registrato? Registrati!</a>
                    </div>
                    <br>
    </div>
    <?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
    <!-- Include any other JS files needed -->
</body>
</html>
<?php }
}
