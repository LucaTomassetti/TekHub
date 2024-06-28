<?php
/* Smarty version 5.3.0, created on 2024-06-28 13:23:54
  from 'file:userinfo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_667e9d4a3cd230_31237029',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea170b9416ffd88355818116817d4eab78b7165f' => 
    array (
      0 => 'userinfo.tpl',
      1 => 1719573830,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header_section.tpl' => 1,
    'file:userDataForm.tpl' => 1,
    'file:userHistoryOrders.tpl' => 1,
    'file:change-pass.tpl' => 1,
    'file:userDataSection.tpl' => 1,
    'file:listaProdotti.tpl' => 1,
  ),
))) {
function content_667e9d4a3cd230_31237029 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Area utente</title>

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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
    
<?php $_smarty_tpl->renderSubTemplate('file:header_section.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    <!-- Contenuto principale -->
    <main>
        <div class="content-area">
            <?php if ($_smarty_tpl->getValue('userDataForm') == 1) {?>
                <?php $_smarty_tpl->renderSubTemplate('file:userDataForm.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
            <?php } elseif ($_smarty_tpl->getValue('userHistoryOrders') == 1) {?>
                <?php $_smarty_tpl->renderSubTemplate('file:userHistoryOrders.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
            <?php } elseif ($_smarty_tpl->getValue('changepass') == 1) {?>
                <?php $_smarty_tpl->renderSubTemplate('file:change-pass.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
            <?php } elseif ($_smarty_tpl->getValue('userDataSection') == 1) {?>
                <?php $_smarty_tpl->renderSubTemplate('file:userDataSection.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
			<?php } elseif ($_smarty_tpl->getValue('listaProdotti') == 1) {?>
				<?php $_smarty_tpl->renderSubTemplate('file:listaProdotti.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
            <?php }?>
        </div>
    </main>

<?php echo '<script'; ?>
 src="/TekHub/skin/electro-master/js/scripts-for-template.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/TekHub/skin/electro-master/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/TekHub/skin/electro-master/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/TekHub/skin/electro-master/js/slick.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/TekHub/skin/electro-master/js/nouislider.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/TekHub/skin/electro-master/js/jquery.zoom.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/TekHub/skin/electro-master/js/main.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
