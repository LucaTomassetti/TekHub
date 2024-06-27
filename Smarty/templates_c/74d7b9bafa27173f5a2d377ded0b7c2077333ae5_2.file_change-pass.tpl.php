<?php
/* Smarty version 5.3.0, created on 2024-06-27 20:41:03
  from 'file:change-pass.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_667db23f085163_61491386',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '74d7b9bafa27173f5a2d377ded0b7c2077333ae5' => 
    array (
      0 => 'change-pass.tpl',
      1 => 1719513658,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_667db23f085163_61491386 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?><div class="form-container">
    <h2 class="text-center">Modifica la password</h2>
    <?php if ($_smarty_tpl->getValue('equalpassworderr') == 1) {?>
        <div class="mt-5">
            <div class="alert alert-danger" role="alert">
                La nuova password non può essere uguale a qualla vecchia!
            </div>
        </div>
    <?php }?>
    
    <?php if ($_smarty_tpl->getValue('errorpassupdate') == 1) {?>
        <div class="mt-5">
            <div class="alert alert-danger" role="alert">
                Le nuove password non coincidono! Riprovare
            </div>
        </div>
    <?php }?>

    <?php if ($_smarty_tpl->getValue('erroroldpass') == 1) {?>
        <div class="mt-5">
            <div class="alert alert-danger" role="alert">
                La vecchia password è sbagliata!
            </div>
        </div>
    <?php }?>

    <form id="registrationForm" method="POST" action="/TekHub/utente/changePass">
        <div class="form-group">
            <input name="password" type="password" class="form-control" id="password" placeholder="Vecchia password..."
                required>
        </div>
        <div class="form-group">
            <input name="new-password" type="password" class="form-control" id="new-password"
                placeholder="Nuova password..." required>
        </div>
        <div class="form-group">
            <input name="new-confirm-password" type="password" class="form-control" id="new-confirm-password"
                placeholder="Conferma password..." required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Conferma</button>
    </form>
</div><?php }
}
