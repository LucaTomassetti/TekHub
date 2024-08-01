<?php
/* Smarty version 5.3.0, created on 2024-08-01 20:39:13
  from 'file:userDataSection.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_66abd651c7dca4_52096767',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c06497b80d5493866396f4c58df6bb08e9237150' => 
    array (
      0 => 'userDataSection.tpl',
      1 => 1719513694,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:accountDelete.tpl' => 1,
  ),
))) {
function content_66abd651c7dca4_52096767 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
if ($_smarty_tpl->getValue('changepasswordsucces') == 1) {?>
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Modifica della password avvenuta con successo!
        </div>
    </div>
<?php }
if ($_smarty_tpl->getValue('changeuserdatasucces') == 1) {?>
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Modifica dati personali avvenuta con successo!
        </div>
    </div>
<?php }?>
<div class="section-container">
<h2 class="text-center">I miei dati personali</h2>
<br>
    <div class="summary-item">
        <label>Nome: </label><span id="summary-name"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('nome')), ENT_QUOTES, 'UTF-8');?>
</span>
    </div>
    <br>
    <div class="summary-item">
        <label>Cognome: </label><span id="summary-name"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('cognome')), ENT_QUOTES, 'UTF-8');?>
</span>
    </div>
    <br>
    <div class="summary-item">
        <label>Username: </label><span id="summary-name"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('username')), ENT_QUOTES, 'UTF-8');?>
</span>
    </div>
    <br>
    <div class="summary-item">
        <label>Numero di telefono: </label><span id="summary-name"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('cellulare')), ENT_QUOTES, 'UTF-8');?>
</span>
    </div>
    <br>
    <div class="summary-item">
        <label>E-mail: </label><span id="summary-name"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('email')), ENT_QUOTES, 'UTF-8');?>
</span>
    </div>
    <a href="/TekHub/utente/userDataForm" class="btn btn-primary btn-block">Modifica</a>

    <?php $_smarty_tpl->renderSubTemplate('file:accountDelete.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</div><?php }
}
