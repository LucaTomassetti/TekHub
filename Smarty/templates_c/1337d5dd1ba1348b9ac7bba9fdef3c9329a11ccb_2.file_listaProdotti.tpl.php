<?php
/* Smarty version 5.3.0, created on 2024-08-01 20:39:16
  from 'file:listaProdotti.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_66abd654943178_70335375',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1337d5dd1ba1348b9ac7bba9fdef3c9329a11ccb' => 
    array (
      0 => 'listaProdotti.tpl',
      1 => 1722537513,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:productDelete.tpl' => 1,
  ),
))) {
function content_66abd654943178_70335375 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
if ($_smarty_tpl->getValue('addedProductSuccess') == 1) {?>
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Aggiunta del prodotto avvenuta con successo!
        </div>
    </div>
<?php }
if ($_smarty_tpl->getValue('modifiedProductSuccess') == 1) {?>
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Modifica del prodotto avvenuta con successo!
        </div>
    </div>
<?php }
if ($_smarty_tpl->getValue('deletedProductSuccess') == 1) {?>
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Eliminazione del prodotto avvenuta con successo!
        </div>
    </div>
<?php }?>
<form class="container-fluid text-center" method="GET" action="/TekHub/gestioneProdotti/addProduct">
    <button type="submit" class="btn btn-primary">Aggiungi un nuovo prodotto</button>
</form>
    <!-- row -->
    <div class="row">
        <?php if ($_smarty_tpl->getValue('array_prodotti')['n_prodotti'] == 0) {?>
            <div class="alert alert-warning">
                Non ci sono prodotti! Aggiungi i prodotti dal tasto in alto
            </div>
        <?php }?>

        <?php if ($_smarty_tpl->getValue('array_prodotti')['n_prodotti'] > 0) {?> 
            <!-- Pagination -->
            <ul class="reviews-pagination">
            <?php if ($_smarty_tpl->getValue('array_prodotti')['currentPage'] > 1) {?>
                <li><a href="?page=<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('array_prodotti')['currentPage']-1), ENT_QUOTES, 'UTF-8');?>
"><i class="fa fa-angle-left"></i></a></li>
            <?php }?>

            <?php
$_smarty_tpl->assign('page', null);$_smarty_tpl->tpl_vars['page']->step = 1;$_smarty_tpl->tpl_vars['page']->total = (int) ceil(($_smarty_tpl->tpl_vars['page']->step > 0 ? $_smarty_tpl->getValue('array_prodotti')['totalPages']+1 - (1) : 1-($_smarty_tpl->getValue('array_prodotti')['totalPages'])+1)/abs($_smarty_tpl->tpl_vars['page']->step));
if ($_smarty_tpl->tpl_vars['page']->total > 0) {
for ($_smarty_tpl->tpl_vars['page']->value = 1, $_smarty_tpl->tpl_vars['page']->iteration = 1;$_smarty_tpl->tpl_vars['page']->iteration <= $_smarty_tpl->tpl_vars['page']->total;$_smarty_tpl->tpl_vars['page']->value += $_smarty_tpl->tpl_vars['page']->step, $_smarty_tpl->tpl_vars['page']->iteration++) {
$_smarty_tpl->tpl_vars['page']->first = $_smarty_tpl->tpl_vars['page']->iteration === 1;$_smarty_tpl->tpl_vars['page']->last = $_smarty_tpl->tpl_vars['page']->iteration === $_smarty_tpl->tpl_vars['page']->total;?>
            <li <?php if ($_smarty_tpl->getValue('page') == $_smarty_tpl->getValue('array_prodotti')['currentPage']) {?>class="active"<?php }?>><a href="?page=<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('page')), ENT_QUOTES, 'UTF-8');?>
">
                <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('page')), ENT_QUOTES, 'UTF-8');?>

            </a></li>
            <?php }
}
?>

            <?php if ($_smarty_tpl->getValue('array_prodotti')['currentPage'] < $_smarty_tpl->getValue('array_prodotti')['totalPages']) {?>
                <li><a href="?page=<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('array_prodotti')['currentPage']+1), ENT_QUOTES, 'UTF-8');?>
"><i class="fa fa-angle-right"></i></a></li>
            <?php }?>
            </ul>
            <!-- /Pagination -->
        <?php }?> 
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('array_prodotti')['prodotti'], 'prodotto');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('prodotto')->value) {
$foreach0DoElse = false;
?>
                    <!-- product -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="product">
                        <div class="product-img">
                            <?php if ((null !== ($_smarty_tpl->getValue('prodotto')->getImmagini()->last()->getImageData() ?? null)) && (null !== ($_smarty_tpl->getValue('prodotto')->getImmagini()->last()->getType() ?? null))) {?>
                                <img src="data:<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')->getImmagini()->last()->getType()), ENT_QUOTES, 'UTF-8');?>
;base64,<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')->getImmagini()->last()->getEncodedData()), ENT_QUOTES, 'UTF-8');?>
" alt="Immagine">
                            <?php } else { ?>
                                <p>Immagine non trovata</p>
                            <?php }?>         
                        </div>
                        <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')->getCategoryName()->getNomeCategoria()), ENT_QUOTES, 'UTF-8');?>
</p>
                            <h3 class="product-name"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')->getNome()), ENT_QUOTES, 'UTF-8');?>
</h3>
                                <?php if ($_smarty_tpl->getValue('prodotto') instanceof EUsato) {?>
                                    <h4 class="product-price">€<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')->getFloorPrice()), ENT_QUOTES, 'UTF-8');?>
</h4>
                                <?php } elseif ($_smarty_tpl->getValue('prodotto') instanceof ENuovo) {?>
                                    <h4 class="product-price">€<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')->getPrezzoFisso()), ENT_QUOTES, 'UTF-8');?>
</h4>
                                <?php }?>
                        </div>
                        <div class="add-to-cart">
                            <form style="display:inline;" method="GET" action="/TekHub/gestioneProdotti/modificaProdotto/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')->getIdProdotto()), ENT_QUOTES, 'UTF-8');?>
">
                                <button class="add-to-cart-btn"><i class="fas fa-table"></i> Modifica</button>
                            </form>
                            <button id="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')->getIdProdotto()), ENT_QUOTES, 'UTF-8');?>
" class="deleteProdBtns add-to-cart-btn"><i class="fas fa-trash-alt"></i> Elimina</button>
                        </div>
                    </div>
                    </div>
                    <!-- /product -->
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
    <?php $_smarty_tpl->renderSubTemplate('file:productDelete.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}
