<?php
/* Smarty version 5.3.0, created on 2024-07-12 10:39:57
  from 'file:productDelete.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_6690ebdd068927_00769000',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '85017ce8131fab35cfd5b145532387fb07d33b72' => 
    array (
      0 => 'productDelete.tpl',
      1 => 1720773135,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6690ebdd068927_00769000 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/TekHub/Smarty/templates';
?><form id="formProd" method="POST" action="/TekHub/gestioneProdotti/eliminaProdotto/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['id_prodotto']), ENT_QUOTES, 'UTF-8');?>
">
    <div id="confirmationProdPopup" class="popup">
        <div class="popup-content">
            <h2>Conferma eliminazione prodotto</h2>
            <p>Per confermare l'eliminazione del prodotto, digitare "CONFERMA" nel campo sottostante e cliccare sul pulsante "Conferma"</p>
            <input type="text" id="confirmProdInput" placeholder="Digitare CONFERMA" required>
            <div class="bottoni">
                <button type="submit" href="" class="btn btn-danger btn-block" id="confirmProdBtn">Conferma</button>
                <button type="button" class="btn btn-danger btn-block" id="cancelProdBtn">Annulla</button>
            </div>
        </div>
    </div>
</form><?php }
}
