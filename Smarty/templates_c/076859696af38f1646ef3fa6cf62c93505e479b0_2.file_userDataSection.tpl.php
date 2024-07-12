<?php
/* Smarty version 5.3.0, created on 2024-07-12 10:39:37
  from 'file:userDataSection.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_6690ebc9e8d0c3_55165850',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '076859696af38f1646ef3fa6cf62c93505e479b0' => 
    array (
      0 => 'userDataSection.tpl',
      1 => 1719997175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:accountDelete.tpl' => 1,
  ),
))) {
function content_6690ebc9e8d0c3_55165850 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/TekHub/Smarty/templates';
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
