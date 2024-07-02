<?php
/* Smarty version 5.3.0, created on 2024-07-02 18:11:35
  from 'file:listaProdotti.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_668426b7ad3634_77314935',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1337d5dd1ba1348b9ac7bba9fdef3c9329a11ccb' => 
    array (
      0 => 'listaProdotti.tpl',
      1 => 1719936657,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_668426b7ad3634_77314935 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?><form class="container-fluid text-center" method="GET" action="/TekHub/gestioneProdotti/addProduct">
    <button type="submit" class="btn btn-primary">Aggiungi un nuovo prodotto</button>
</form>
<?php if ($_smarty_tpl->getValue('addedProductSuccess') == 1) {?>
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Aggiunta del prodotto avvenuta con successo!
        </div>
    </div>
<?php }?>
    <!-- row -->
    <div class="row">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('array_prodotti'), 'prodotto');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('prodotto')->value) {
$foreach0DoElse = false;
?>
                    <!-- product -->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="product">
                        <div class="product-img">
                            <?php if ((null !== ($_smarty_tpl->getValue('prodotto')['images']['imageData'] ?? null)) && (null !== ($_smarty_tpl->getValue('prodotto')['images']['type'] ?? null))) {?>
                                <img src="data:<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['images']['type']), ENT_QUOTES, 'UTF-8');?>
;base64,<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['images']['imageData']), ENT_QUOTES, 'UTF-8');?>
" alt="Immagine">
                            <?php } else { ?>
                                <p>Immagine non trovata</p>
                            <?php }?>        
                        </div>
                        <div class="product-body">
                            <p class="product-category"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['nome_categoria']), ENT_QUOTES, 'UTF-8');?>
</p>
                            <h3 class="product-name"><a href="#"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['nome']), ENT_QUOTES, 'UTF-8');?>
</a></h3>
                                <?php if ((null !== ($_smarty_tpl->getValue('prodotto')['floor_price'] ?? null))) {?>
                                    <h4 class="product-price">€<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['floor_price']), ENT_QUOTES, 'UTF-8');?>
</h4>
                                <?php } elseif ((null !== ($_smarty_tpl->getValue('prodotto')['prezzo_fisso'] ?? null))) {?>
                                    <h4 class="product-price">€<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['prezzo_fisso']), ENT_QUOTES, 'UTF-8');?>
</h4>
                                <?php }?>
                        </div>
                        <div class="add-to-cart">
                            <button class="add-to-cart-btn"><i class="fas fa-table"></i> Modifica</button>
                            <button class="add-to-cart-btn"><i class="fas fa-trash-alt"></i> Elimina</button>
                        </div>
                    </div>
                    </div>
                    <!-- /product -->
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
<?php }
}
