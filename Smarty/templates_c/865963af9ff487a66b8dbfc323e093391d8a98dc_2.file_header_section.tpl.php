<?php
/* Smarty version 5.3.0, created on 2024-08-25 18:48:05
  from 'file:header_section.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_66cb6045cd2838_86112812',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '865963af9ff487a66b8dbfc323e093391d8a98dc' => 
    array (
      0 => 'header_section.tpl',
      1 => 1724604482,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_66cb6045cd2838_86112812 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?><!-- HEADER -->
<header>

<!-- MAIN HEADER -->
<div id="header">
    <!-- container -->
    <div class="container-fluid text-center">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class="col-lg-4 col-md-3">
                <div class="header-logo">
                    <a href="/TekHub/utente/home" class="logo">
                        <img src="/TekHub/skin/electro-master/img/Logo_TekHub.png" alt="">
                    </a>
                </div>
            </div>
            <!-- /LOGO -->

            
            <!-- SEARCH BAR -->
            <div class="col-lg-4 col-md-6 col-sm-9 col-xs-9">
            <?php if ($_smarty_tpl->getValue('search_bar') == 1) {?>
                <div class="header-search">
                    <form action="/TekHub/gestioneAcquisto/shop" method="GET">
                        <select class="input-select" name="categoria">
                            <option value="">Tutte le categorie</option>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('array_categorie'), 'categoria');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('categoria')->value) {
$foreach0DoElse = false;
?>
                                <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('categoria')['nome_categoria']), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('categoria')['nome_categoria']), ENT_QUOTES, 'UTF-8');?>
</option>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </select>
                        <input class="input" name="query" id="searchInput" placeholder="Cerca il prodotto...">
                        <button class="search-btn" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            <?php }?>
            </div>
            <!-- /SEARCH BAR -->

            <!-- ACCOUNT -->
            <div class="col-lg-4 col-md-3 col-sm-2 col-xs-2">
                <div class="header-ctn">
                <!-- My Account -->
                        <?php if ($_smarty_tpl->getValue('utente_non_loggato') == 0) {?>
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

                    <?php if ($_smarty_tpl->getValue('check_login_acquirente') == 1 || $_smarty_tpl->getValue('utente_non_loggato') == 1) {?>
                    <!-- Cart -->
                    <div class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <i class="fas fa-shopping-cart" style="color: #ffffff;"></i>
                            <span>Carrello</span>
                            <div class="qty"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('cart_quantity')), ENT_QUOTES, 'UTF-8');?>
</div>
                        </a>
                        <div class="cart-dropdown">
                            <div class="cart-list">
                            <?php if ($_smarty_tpl->getValue('prodotti_carrello') != 0) {?>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('prodotti_carrello'), 'prodotto');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('prodotto')->value) {
$foreach1DoElse = false;
?>
                                <div class="product-widget">
                                    <div class="product-img">
                                        <?php if ((null !== ($_smarty_tpl->getValue('prodotto')['prodotto']->getImmagini()->last()->getImageData() ?? null)) && (null !== ($_smarty_tpl->getValue('prodotto')['prodotto']->getImmagini()->last()->getType() ?? null))) {?>
                                            <img src="data:<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['prodotto']->getImmagini()->last()->getType()), ENT_QUOTES, 'UTF-8');?>
;base64,<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['prodotto']->getImmagini()->last()->getEncodedData()), ENT_QUOTES, 'UTF-8');?>
" alt="Immagine">
                                        <?php } else { ?>
                                            <p>Immagine non trovata</p>
                                        <?php }?>  
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['prodotto']->getNome()), ENT_QUOTES, 'UTF-8');?>
</h3>
                                        <h4 class="product-price"><span class="qty"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['quantita']), ENT_QUOTES, 'UTF-8');?>
x</span>€<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['prodotto']->getPrezzoFisso()), ENT_QUOTES, 'UTF-8');?>
</h4>
                                    </div>
                                    <form action="/TekHub/gestioneAcquisto/rimuoviDalCarrello/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prodotto')['prodotto']->getIdProdotto()), ENT_QUOTES, 'UTF-8');?>
">
                                        <button class="delete"><i class="fas fa-times-circle"></i></button>
                                    </form>
                                </div>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            <?php } else { ?>
                                <div class="product-widget">
                                    <h5>Non ci sono prodotti nel carrello!</h5>
                                </div>
                            <?php }?>
                            </div>
                            <div class="cart-summary">
                                <small><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('cart_quantity')), ENT_QUOTES, 'UTF-8');?>
 prodotti/o selezionati</small>
                                <h5>SUBTOTAL: €<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('subtotal')), ENT_QUOTES, 'UTF-8');?>
</h5>
                            </div>
                            <div class="cart-btns">
                                <a href="/TekHub/gestioneAcquisto/vediCarrello">Vai al carrello</a>
                                <a href="/TekHub/gestioneAcquisto/effettuaCheckout">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
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
<div class="container prodotti-container">
    <!-- responsive-nav -->
    <div id="responsive-nav">
        <!-- NAV -->
        <ul class="main-nav nav navbar-nav">
        <?php if ($_smarty_tpl->getValue('check_login_acquirente') == 1) {?>
            <li><a href="/TekHub/utente/userDataSection">Profilo</a></li>
            <li><a href="/TekHub/utente/userHistoryOrders">Stato ordini</a></li>
            <li><a href="#">Recensioni</a></li>
            <li><a href="#">Offerte effettuate</a></li>
            <li><a href="#">Gestione resi</a></li>
        <?php } elseif ($_smarty_tpl->getValue('check_login_venditore') == 1) {?>
        <li><a href="/TekHub/utente/userDataSection">Profilo</a></li>
            <li><a href="/TekHub/gestioneProdotti/listaProdotti">Gestione prodotti</a></li>
            <li><a href="#">Ordini in attesa</a></li>
            <li><a href="/TekHub/utente/userHistoryOrders">Stato ordini</a></li>
            <li><a href="#">Gestione resi</a></li>
            <li><a href="#">Recensioni</a></li>
        <?php } elseif ($_smarty_tpl->getValue('check_login_admin') == 1) {?>
            <li><a href="/TekHub/utente/userDataSection">Profilo</a></li>
                <li><a href="#">Gestione prodotti</a></li>
                <li><a href="#">Gestione utenti registrati</a></li>
                <li><a href="#">Segnalazioni</a></li>
        <?php }?>

        <?php if ($_smarty_tpl->getValue('utente_non_loggato') == 1) {?>
            <li><a href="/TekHub/utente/login"><i class="fas fa-sign-in-alt"></i><span> Accedi</span></a></li>
            <li><a href="/TekHub/gestioneAcquisto/vediCarrello"><span> Carrello</span></a></li>  
        <?php } elseif ($_smarty_tpl->getValue('utente_non_loggato') == 0 && $_smarty_tpl->getValue('check_login_acquirente') == 1) {?>
            <li><a href="/TekHub/gestioneAcquisto/vediCarrello"><span> Carrello</span></a></li>  
            <li><a href="/TekHub/utente/logout"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a></li>   
        <?php }?>
        </ul>
        <!-- /NAV -->
    </div>
    <!-- /responsive-nav -->
</div>
<!-- /container -->
</nav>
<!-- /NAVIGATION --><?php }
}
