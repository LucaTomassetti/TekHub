<?php
/* Smarty version 5.3.0, created on 2024-06-28 12:57:39
  from 'file:header_section.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_667e97230ff3b4_15602085',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '865963af9ff487a66b8dbfc323e093391d8a98dc' => 
    array (
      0 => 'header_section.tpl',
      1 => 1719572196,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_667e97230ff3b4_15602085 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?><!-- HEADER -->
<header>

<!-- MAIN HEADER -->
<div id="header">
    <!-- container -->
    <div class="container-fluid text-center">
        <!-- row -->
        <div class="row justify-content-evenly">
            <!-- LOGO -->
            <div class="col-lg-4 col-md-3 col-sm-3 col-xs-2">
                <div class="header-logo">
                    <a href="/TekHub/utente/home" class="logo">
                        <img src="/TekHub/skin/electro-master/img/Logo_TekHub.png" alt="">
                    </a>
                </div>
            </div>
            <!-- /LOGO -->

            <!-- SEARCH BAR -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                <div class="header-search">
                    <form>
                        <select class="input-select">
                            <option value="0">Categorie</option>
                            <option value="1">Categoria 01</option>
                            <option value="1">Categoria 02</option>
                        </select>
                        <input class="input" placeholder="Cerca il prodotto...">
                        <button class="search-btn">Cerca</button>
                    </form>
                </div>
            </div>
            <!-- /SEARCH BAR -->

            <!-- ACCOUNT -->
            <div class="col-lg-4 col-md-3 col-sm-3 col-xs-4">
                <div class="header-ctn">
                <!-- My Account -->
                        <?php if ($_smarty_tpl->getValue('check_login') == 1) {?>
                            <div>
                                <a href="/TekHub/utente/logout">
                                    <i class="fas fa-sign-out-alt" style="color: #ffffff;"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        <?php } else { ?>
                            <div>
                                <a href="/TekHub/utente/login">
                                    <i class="fas fa-sign-in-alt" style="color: #ffffff;"></i>
                                    <span>Accedi</span>
                                </a>
                            </div>
                        <?php }?>

                    <?php if ($_smarty_tpl->getValue('check_login_acquirente') == 1 || $_smarty_tpl->getValue('check_login') == 0) {?>
                    <!-- Cart -->
                    <div class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <i class="fas fa-shopping-cart" style="color: #ffffff;"></i>
                            <span>Carrello</span>
                            <!-- Per visualizzare la quantità
                            <div class="qty">3</div>
                            -->
                        </a>
                        <div class="cart-dropdown">
                            <div class="cart-list">
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="/TekHub/skin/electro-master/img/product01.png" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                        <h4 class="product-price"><span class="qty">1x</span>€980.00</h4>
                                    </div>
                                    <button class="delete"><i class="fa fa-close"></i></button>
                                </div>

                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="/TekHub/skin/electro-master/img/product02.png" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                        <h4 class="product-price"><span class="qty">3x</span>€980.00</h4>
                                    </div>
                                    <button class="delete"><i class="fa fa-close"></i></button>
                                </div>
                            </div>
                            <div class="cart-summary">
                                <small>3 Item(s) selected</small>
                                <h5>SUBTOTAL: €2940.00</h5>
                            </div>
                            <div class="cart-btns">
                                <a href="#">Vai al carrello</a>
                                <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /Cart -->
                    <?php }?>
                    <!-- Menu Toogle -->
                    <div class="menu-toggle">
                        <a href="#">
                            <i class="fa fa-bars"></i>
                            <span>Menu</span>
                        </a>
                    </div>
                    <!-- /Menu Toogle -->
                </div>
            </div>
            <!-- /ACCOUNT -->
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</div>
<!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
<nav id="navigation">
<!-- container -->
<div class="container">
    <!-- responsive-nav -->
    <div id="responsive-nav">
        <!-- NAV -->
        <?php if ($_smarty_tpl->getValue('check_login_acquirente') == 1) {?>
        <ul class="main-nav nav navbar-nav">
            <li><a href="/TekHub/utente/userDataSection">Profilo</a></li>
            <li><a href="/TekHub/utente/userHistoryOrders">Stato ordini</a></li>
            <li><a href="#">Recensioni</a></li>
            <li><a href="#">Offerte effettuate</a></li>
            <li><a href="#">Gestione resi</a></li>
        </ul>
        <?php } elseif ($_smarty_tpl->getValue('check_login_venditore') == 1) {?>
        <ul class="main-nav nav navbar-nav">
        <li><a href="/TekHub/utente/home">Profilo</a></li>
            <li><a href="#">Gestione prodotti</a></li>
            <li><a href="#">Ordini in attesa</a></li>
            <li><a href="/TekHub/utente/userHistoryOrders">Stato ordini</a></li>
            <li><a href="#">Gestione resi</a></li>
            <li><a href="#">Recensioni</a></li>
        </ul>
        <?php }?>
        <!-- /NAV -->
    </div>
    <!-- /responsive-nav -->
</div>
<!-- /container -->
</nav>
<!-- /NAVIGATION --><?php }
}
