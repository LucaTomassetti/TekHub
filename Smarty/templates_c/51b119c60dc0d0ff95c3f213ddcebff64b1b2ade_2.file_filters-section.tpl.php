<?php
/* Smarty version 5.3.0, created on 2024-08-25 19:25:00
  from 'file:filters-section.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_66cb68ec7f8076_28475596',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51b119c60dc0d0ff95c3f213ddcebff64b1b2ade' => 
    array (
      0 => 'filters-section.tpl',
      1 => 1724606697,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_66cb68ec7f8076_28475596 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?>
            <!-- Filter Section -->
                <div class="form-container">
                <form method="GET" action="/TekHub/<?php if ($_smarty_tpl->getValue('check_login_venditore') == 1 || $_smarty_tpl->getValue('check_login_admin')) {?>gestioneProdotti<?php } else { ?>gestioneAcquisto<?php }?>/<?php if ($_smarty_tpl->getValue('check_login_venditore') == 1 || $_smarty_tpl->getValue('check_login_admin')) {?>listaProdotti<?php } else { ?>shop<?php }?>" id="filterForm">
                    <input type="hidden" name="query" id="hiddenQuery" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('filtri_applicati')['query']), ENT_QUOTES, 'UTF-8');?>
">
                <h2>Sezione filtri</h2>
                <div class="form-group">
                    <label for="categoryFilter">Categoria</label>
                    <select id="categoryFilter" name="categoria" class="form-control">
                        <option value="">Tutte le categorie</option>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('array_categorie'), 'categoria');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('categoria')->value) {
$foreach0DoElse = false;
?>
                        <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('categoria')['nome_categoria']), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->getValue('filtri_applicati')['categoria'] == $_smarty_tpl->getValue('categoria')['nome_categoria']) {?>selected<?php }?>><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('categoria')['nome_categoria']), ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="marcaFilter">Marca</label>
                    <select id="marcaFilter" name="marca" class="form-control">
                        <option value="">Tutte le marche</option>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('marche'), 'marca');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('marca')->value) {
$foreach1DoElse = false;
?>
                        <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('marca')), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->getValue('filtri_applicati')['marca'] == $_smarty_tpl->getValue('marca')) {?>selected<?php }?>><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('marca')), ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="priceRange">Prezzo massimo: <span id="priceValue">€<?php if ((null !== ($_GET['prezzo_max'] ?? null))) {
echo htmlspecialchars((string) ($_GET['prezzo_max']), ENT_QUOTES, 'UTF-8');
} else { ?>5000<?php }?></span></label>
                    <input type="range" class="form-control-range" id="priceRange" name="prezzo_max" min="0" max="5000" value="<?php if ((null !== ($_GET['prezzo_max'] ?? null))) {
echo htmlspecialchars((string) ($_GET['prezzo_max']), ENT_QUOTES, 'UTF-8');
} else { ?>5000<?php }?>" oninput="updatePriceValue(this.value)">
                </div>
                <div class="form-group">
                    <label>Condizione</label>
                    <div class="form-check">
                        <input type="checkbox" name="condizione[]" value="nuovo" <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('in_array')('nuovo',$_smarty_tpl->getValue('filtri_applicati')['condizione'])) {?>checked<?php }?>>
                        <label class="form-check-label" for="nuovoCheck">Nuovo</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="condizione[]" value="usato" <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('in_array')('usato',$_smarty_tpl->getValue('filtri_applicati')['condizione'])) {?>checked<?php }?>>
                        <label class="form-check-label" for="usatoCheck">Usato (in asta)</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Applica filtri</button>
            </form>
                </div>
            <?php echo '<script'; ?>
>
                function updatePriceValue(value) {
                    const priceValue = document.getElementById('priceValue');
                    priceValue.textContent = value+"€";
                    if(priceValue.textContent == "5000€"){
                        priceValue.textContent = value+"€ e più";
                    }
                }
            <?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
>
            document.addEventListener('DOMContentLoaded', function() {
                // Trova l'input di ricerca nella barra di navigazione
                var searchInput = document.querySelector('input[name="query"]');
                var hiddenQuery = document.getElementById('hiddenQuery');
                var filterForm = document.getElementById('filterForm');
            
                // Aggiorna il valore nascosto quando l'utente digita nella barra di ricerca
                searchInput.addEventListener('input', function() {
                    hiddenQuery.value = this.value;
                });
            
                // Aggiorna il valore nascosto prima dell'invio del form
                filterForm.addEventListener('submit', function() {
                    hiddenQuery.value = searchInput.value;
                });
            });
            <?php echo '</script'; ?>
><?php }
}
