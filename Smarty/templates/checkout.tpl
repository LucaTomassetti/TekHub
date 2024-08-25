<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Checkout Page">
    <meta name="keywords" content="checkout, order, payment">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout - TekHub</title>

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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                {foreach from=$prodotti_carrello item=prodotto}
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                        {if isset($prodotto['prodotto']->getImmagini()->first()->getImageData()) && isset($prodotto['prodotto']->getImmagini()->first()->getType())}
                                            <img style="width:200px; height:auto;"
                                                src="data:{$prodotto['prodotto']->getImmagini()->first()->getType()};base64,{$prodotto['prodotto']->getImmagini()->first()->getEncodedData()}"
                                                alt="Immagine">
                                        {else}
                                            <p>Immagine non trovata</p>
                                        {/if}
                                </div>
                                <div class="col-md-8">
                                    <h5>{$prodotto['prodotto']->getNome()}</h5>
                                    <p>Quantità: {$prodotto['quantita']}</p>
                                    <p>Prezzo: €{$prodotto['prodotto']->getPrezzoFisso() * $prodotto['quantita']|string_format:"%.2f"}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
            <br>
            <div class="col-md-4 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Il tuo ordine</h3>
                </div>
                <div class="order-summary">
                    <!-- ... (mantieni il riepilogo dell'ordine esistente) ... -->
                </div>
                <form action="/TekHub/gestioneAcquisto/completaOrdine" method="POST">
                    {assign var="hasActiveAddresses" value=false}
                    {assign var="hasActiveCards" value=false}

                    <div class="form-group">
                        <label for="indirizzo">Seleziona indirizzo di spedizione:</label>
                        {foreach $indirizzi as $indirizzo}
                            {if !$indirizzo->isDeleted()}
                                {assign var="hasActiveAddresses" value=true}
                                {break}
                            {/if}
                        {/foreach}
                        
                        {if $hasActiveAddresses}
                            <select name="indirizzo" id="indirizzo" class="form-control" required>
                                {foreach $indirizzi as $indirizzo}
                                    {if !$indirizzo->isDeleted()}
                                        <option value="{$indirizzo->getIndirizzo()}|{$indirizzo->getCap()}">
                                            {$indirizzo->getIndirizzo()}, {$indirizzo->getCap()}
                                        </option>
                                    {/if}
                                {/foreach}
                            </select>
                        {else}
                            <p class="alert alert-warning">Non hai indirizzi attivi.</p>
                            <a href="/TekHub/utente/indirizzi" class="btn btn-primary">Aggiungi un indirizzo</a>
                        {/if}
                    </div>

                    <div class="form-group">
                        <label for="carta">Seleziona carta di credito:</label>
                        {foreach $carte as $carta}
                            {if !$carta->isDeleted()}
                                {assign var="hasActiveCards" value=true}
                                {break}
                            {/if}
                        {/foreach}
                        
                        {if $hasActiveCards}
                            <select name="carta" id="carta" class="form-control" required>
                                {foreach $carte as $carta}
                                    {if !$carta->isDeleted()}
                                        <option value="{$carta->getNumero_carta()}">
                                            **** **** **** {$carta->getNumero_carta()|substr:-4} - Scadenza: {$carta->getData_scadenza()}
                                        </option>
                                    {/if}
                                {/foreach}
                            </select>
                        {else}
                            <p class="alert alert-warning">Non hai carte di credito attive.</p>
                            <a href="/TekHub/utente/carteCredito" class="btn btn-primary">Aggiungi una carta di credito</a>
                        {/if}
                    </div>

                    <button type="submit" class="primary-btn order-submit" {if !$hasActiveAddresses || !$hasActiveCards}disabled{/if}>
                        Effettua l'ordine
                    </button>
                    
                    {if !$hasActiveAddresses || !$hasActiveCards}
                        <p class="text-danger mt-2">Per procedere con l'ordine, assicurati di avere almeno un indirizzo e una carta di credito attivi.</p>
                    {/if}
                </form>
            </div>
        </div>
    </div>
    <!-- Js Plugins -->
    <script src="/TekHub/skin/electro-master/js/jquery-3.3.1.min.js"></script>
    <script src="/TekHub/skin/electro-master/js/bootstrap.min.js"></script>
    <script src="/TekHub/skin/electro-master/js/jquery.nice-select.min.js"></script>
    <script src="/TekHub/skin/electro-master/js/jquery.slicknav.js"></script>
    <script src="/TekHub/skin/electro-master/js/owl.carousel.min.js"></script>
    <script src="/TekHub/skin/electro-master/js/main.js"></script>
</body>
</html>