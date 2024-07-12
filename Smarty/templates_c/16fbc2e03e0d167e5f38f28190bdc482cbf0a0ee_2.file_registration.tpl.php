<?php
/* Smarty version 5.3.0, created on 2024-07-12 11:05:30
  from 'file:registration.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_6690f1da69f163_38814269',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16fbc2e03e0d167e5f38f28190bdc482cbf0a0ee' => 
    array (
      0 => 'registration.tpl',
      1 => 1720775095,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6690f1da69f163_38814269 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/TekHub/Smarty/templates';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
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
<h2 class="text-center">Registrazione</h2>
<?php if ($_smarty_tpl->getValue('errore_r') == 1) {?>
    <div class="mt-5">
    <div class="alert alert-danger" role="alert">
        Email già esistente! Registrati con un'altra email!
    </div>
</div>
<?php }?>

<?php if ($_smarty_tpl->getValue('check_pass') == 1) {?>
<div class="mt-5">
    <div class="alert alert-danger" role="alert">
        Le password non coincidono! Riprovare
    </div>
</div>
<?php }?>
<div class="card-body">
  <form method="POST" action="/TekHub/utente/signUp">
      <div class="form-group">
      <label for="userType" class="form-label">Sei un venditore o un acquirente?</label>
      <div class="form-check">
          <input class="form-check-input" type="radio" name="userType" id="acquirente" value="acquirente" required>
          <label class="form-check-label" for="acquirente">
              Acquirente
          </label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="radio" name="userType" id="venditore" value="venditore" required>
          <label class="form-check-label" for="venditore">
              Venditore
          </label>
      </div>
      </div>

      <div class="form-group">
          
          <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome..." required>
      </div>
      <div class="form-group">
          
          <input name="cognome" type="text" class="form-control" id="cognome" placeholder="Cognome..." required>
      </div>
      <div class="form-group">
          
          <input name="username" type="text" class="form-control" id="username" placeholder="Username..." required>
      </div>
      <div class="form-group">
          
          <input name="cellulare" type="tel" class="form-control" id="cellulare" placeholder="es. 3456789333" pattern="[0-9]+" maxlength="10" required>
      </div>
      <div class="form-group">
          
          <input name="email" type="email" class="form-control" id="email" placeholder="es. prova@example.com" required>
      </div>

      <div class="seller-fields">
          <div id="società_div" class="mb-3 seller-field">
              <input name="società" type="text" class="form-control" id="società" placeholder="Società...">
          </div>
          <div id="partita_iva_div" class="mb-3 seller-field">
              <input name="partita_iva" type="text" class="form-control" id="partita_iva" placeholder="p.IVA es. 08100750010" pattern="[0-9]+" maxlength="11">
          </div>
      </div>

      <div class="form-group">
          
          <input name="password" type="password" class="form-control" id="password" placeholder="Password..." required>
      </div>
      <div class="form-group">
          
          <input name="confirm-password" type="password" class="form-control" id="confirm-password" placeholder="Conferma password..." required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Registrati</button>
      <br>
      <a href="/TekHub/utente/login" id="linkpass">Hai già un account? Accedi</a>
  </form>
  </div>
</div>
    <?php echo '<script'; ?>
 src="/TekHub/skin/electro-master/js/scripts-for-template.js"><?php echo '</script'; ?>
>
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
