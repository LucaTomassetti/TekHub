<?php
/* Smarty version 5.3.0, created on 2024-06-29 17:52:30
  from 'file:listaProdotti.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_66802dbe8a4673_19202310',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1337d5dd1ba1348b9ac7bba9fdef3c9329a11ccb' => 
    array (
      0 => 'listaProdotti.tpl',
      1 => 1719676175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_66802dbe8a4673_19202310 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?><form class="container-fluid text-center"method="GET" action="/TekHub/utente/addProduct">
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
                <!-- product -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="product">
                    <div class="product-img">
                        <img src="/TekHub/skin/electro-master/img/product05.png" alt="">
                    </div>
                    <div class="product-body">
                        <p class="product-category">Categoria</p>
                        <h3 class="product-name"><a href="#">Nome prodotto</a></h3>
                        <h4 class="product-price">€980.00</h4>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fas fa-table"></i> Modifica</button>
                        <button class="add-to-cart-btn"><i class="fas fa-trash-alt"></i> Elimina</button>
                    </div>
                </div>
                </div>
                <!-- /product -->

                <!-- product -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="product">
                    <div class="product-img">
                        <img src="/TekHub/skin/electro-master/img/product05.png" alt="">
                    </div>
                    <div class="product-body">
                        <p class="product-category">Categoria</p>
                        <h3 class="product-name"><a href="#">Nome prodotto</a></h3>
                        <h4 class="product-price">€980.00</h4>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fas fa-table"></i> Modifica</button>
                        <button class="add-to-cart-btn"><i class="fas fa-trash-alt"></i> Elimina</button>
                    </div>
                </div>
                </div>
                <!-- /product -->

                <!-- product -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="product">
                    <div class="product-img">
                        <img src="/TekHub/skin/electro-master/img/product05.png" alt="">
                    </div>
                    <div class="product-body">
                        <p class="product-category">Categoria</p>
                        <h3 class="product-name"><a href="#">Nome prodotto</a></h3>
                        <h4 class="product-price">€980.00</h4>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fas fa-table"></i> Modifica</button>
                        <button class="add-to-cart-btn"><i class="fas fa-trash-alt"></i> Elimina</button>
                    </div>
                </div>
                </div>
                <!-- /product -->
    </div>
<?php }
}
