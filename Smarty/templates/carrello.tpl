<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>TekHub</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="/TekHub/skin/electro-master/css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="/TekHub/skin/electro-master/css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="/TekHub/skin/electro-master/css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="/TekHub/skin/electro-master/css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="/TekHub/skin/electro-master/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
	{include file='header_section.tpl'}

    {if $qty_updated == 1}
        <div class="mt-5 d-flex justify-content-center">
            <div class="alert alert-success" role="alert">
                Quantità aggiornata con successo
            </div>
        </div>
    {/if}

    {if $is_cart_empty == 1}
        <div class="container">
            <h2>Il tuo carrello è vuoto</h2>
            <p>Aggiungi qualche prodotto per iniziare lo shopping!</p>
            <a href="/TekHub/gestioneAcquisto/shop" class="btn btn-primary">Continua lo shopping</a>
        </div>
    {else}
        <div class="container">
            <h2>Il tuo carrello</h2>
            {foreach from=$prodotti_carrello item=prodotto}
                {assign var="p_image" value=$prodotto['prodotto']->getImmagini()->toArray()}
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="product-img">
                            {if isset($p_image[0]->getImageData()) && isset($p_image[0]->getType())}
                                <img style="width:200px; height: auto;" src="data:{$p_image[0]->getType()};base64,{$p_image[0]->getEncodedData()}" alt="Immagine">
                            {else}
                                <p>Immagine non trovata</p>
                            {/if}        
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4>{$prodotto['prodotto']->getNome()}</h4>
                        <p>{$prodotto['prodotto']->getDescrizione()|truncate:300}</p>
                    </div>
                    <div class="col-md-2">
                        <form action="/TekHub/gestioneAcquisto/aggiornaQuantita/{$prodotto['prodotto']->getIdProdotto()}" method="POST">
                            <select class="input-select margin-bottom-20" id="quantity" name="quantity">
                            <!-- Controllo la quantità disp quando è minore di 10,
                                Se è minore di 10, mettere tanti option quanto è le quantità 
                                altrimenti fisso la quantità max a 10 -->
                                {if $prodotto['prodotto']->getQuantitaDisp() >= 10}
                                    {for $i=1 to 10}
                                    <option value="{$i}" {if $carrello[$prodotto['prodotto']->getIdProdotto()] == $i}selected{/if}>
                                        Quantità: {$i}</option>
                                    {/for}
                                {else}
                                    {for $i=1 to $prodotto['prodotto']->getQuantitaDisp()}
                                    <option value="{$i}" {if $carrello[$prodotto['prodotto']->getIdProdotto()] == $i}selected{/if}>
                                        Quantità: {$i}</option>
                                    {/for}
                                {/if}
                            </select>
                            <button type="submit" class="btn btn-md btn-info ml-3"> Aggiorna quantità</button>
                        </form>
                    </div>
                    <div class="col-md-1">
                        <p>Totale: €{$prodotto['prodotto']->getPrezzoFisso() * $prodotto['quantita']}</p>
                    </div>
                    <div class="col-md-3">
                        <a href="/TekHub/gestioneAcquisto/vediProdotto/{$prodotto['prodotto']->getIdProdotto()}" class="btn btn-info">Dettagli</a>
                        <a href="/TekHub/gestioneAcquisto/rimuoviDalCarrello/{$prodotto['prodotto']->getIdProdotto()}" class="btn btn-danger mt-2">Rimuovi</a>
                    </div>
                </div>
            {/foreach}
            <div class="row mt-4 d-flex">
                <div class="col-md-6">
                    <a href="/TekHub/gestioneAcquisto/svuotaCarrello" class="btn btn-warning">Svuota carrello</a>
                </div>
                <div class="col-md-6 text-right">
                    <h3>Totale: €{$subtotal|string_format:"%.2f"}</h3>
                    <a href="/TekHub/gestioneAcquisto/effettuaCheckout" class="btn btn-primary">Procedi al checkout</a>
                </div>
            </div>
        </div>
    {/if}
    <script src="/TekHub/skin/electro-master/js/scripts-for-template.js"></script>
	<!-- jQuery Plugins -->
	<script src="/TekHub/skin/electro-master/js/jquery.min.js"></script>
	<script src="/TekHub/skin/electro-master/js/bootstrap.min.js"></script>
	<script src="/TekHub/skin/electro-master/js/slick.min.js"></script>
	<script src="/TekHub/skin/electro-master/js/nouislider.min.js"></script>
	<script src="/TekHub/skin/electro-master/js/jquery.zoom.min.js"></script>
	<script src="/TekHub/skin/electro-master/js/main.js"></script>
    </body>
</html>