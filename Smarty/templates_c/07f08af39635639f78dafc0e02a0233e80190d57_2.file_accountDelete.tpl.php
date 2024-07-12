<?php
/* Smarty version 5.3.0, created on 2024-07-12 10:39:37
  from 'file:accountDelete.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_6690ebc9e90162_13995356',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '07f08af39635639f78dafc0e02a0233e80190d57' => 
    array (
      0 => 'accountDelete.tpl',
      1 => 1719997175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6690ebc9e90162_13995356 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/TekHub/Smarty/templates';
?><div class="mt-4-c">
        <div class="form-group">
            <label>Desideri eliminare il tuo account?</label>
            <button type="submit" id="deleteBtn" class="btn btn-danger btn-block">Elimina Account</button>
        </div>
</div>
<form method="POST" action="/TekHub/utente/deleteAccount">
    <div id="confirmationPopup" class="popup">
        <div class="popup-content">
            <h2>Conferma eliminazione account</h2>
            <p>Per confermare l'eliminazione dell'account, digitare "CONFERMA" nel campo sottostante e cliccare sul pulsante "Conferma"</p>
            <input type="text" id="confirmInput" placeholder="Digitare CONFERMA" required>
            <div class="bottoni">
                <button type="submit" class="btn btn-danger btn-block" id="confirmBtn">Conferma</button>
                <button type="button" class="btn btn-danger btn-block" id="cancelBtn">Annulla</button>
            </div>
        </div>
    </div>
</form><?php }
}
