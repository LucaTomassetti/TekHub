<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
         
         <title>Gestisci prodotti</title>

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
    <br>
    <h2>Gestione Utenti</h2>

    {if isset($message)}
        <div class="alert alert-success">{$message}</div>
    {/if}

    {if isset($error)}
        <div class="alert alert-danger">{$error}</div>
    {/if}

     <!-- FILTRO -->
     <form method="post" action="/TekHub/admin/gestisciProdotti">
        <div class="form-group">
            <label for="id_prodotto">Filter by ID:</label>
            <input type="text" class="form-control" id="id_prodotto" name="id_prodotto">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
     
     <!-- /FILTRO -->

    

    <!-- Pagination --> 
    {if $array_prodotti.totalPages > 1}
        <ul class="reviews-pagination">
            {if $array_prodotti.currentPage > 1}
                <li><a href="?page={$array_prodotti.currentPage-1}"><i class="fa fa-angle-left"></i></a></li>
            {/if}

            {for $page=1 to $array_prodotti.totalPages}
                <li {if $page == $array_prodotti.currentPage}class="active"{/if}>
                    <a href="?page={$page}">{$page}</a>
                </li>
            {/for}

            {if $array_prodotti.currentPage < $array_prodotti.totalPages}
                <li><a href="?page={$array_prodotti.currentPage+1}"><i class="fa fa-angle-right"></i></a></li>
            {/if}
        </ul>
    {/if} 
            {foreach from=$array_prodotti['prodotti'] item=prodotto}
                <!-- product -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="product">
                        <div class="product-img">
                            {if isset($prodotto->getImmagini()->last()->getImageData()) && isset($prodotto->getImmagini()->last()->getType())}
                                <img src="data:{$prodotto->getImmagini()->last()->getType()};base64,{$prodotto->getImmagini()->last()->getEncodedData()}" alt="Immagine">
                            {else}
                                <p>Immagine non trovata</p>
                            {/if}         
                        </div>
                        <div class="product-body">
                            <p class="product-category">{$prodotto->getCategoryName()->getNomeCategoria()}</p>
                            <h3 class="product-name">{$prodotto->getNome()}</h3>
                                {if $prodotto instanceof EUsato}
                                    <h4 class="product-price">In asta: €{$prodotto->getFloorPrice()}</h4>
                                {elseif $prodotto instanceof ENuovo}
                                    <h4 class="product-price">€{$prodotto->getPrezzoFisso()}</h4>
                                {/if}
                                <div class="mt-3">
                                <a href="/TekHub/gestioneAcquisto/vediProdotto/{$prodotto->getIdProdotto()}" class="btn btn-info btn-sm">Visualizza</a>
                                <a href="/TekHub/admin/deleteProduct/{$prodotto->getIdProdotto()}" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto? Questa azione non può essere annullata.');">Elimina</a>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- /product -->
            {/foreach}
</body>
</html>