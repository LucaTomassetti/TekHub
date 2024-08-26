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

        <!-- row -->
        <div class="row">
            {if $array_ordini['n_ordini'] == 0}
                <div class="alert alert-warning">
                    Non ci sono ordini!
                </div>
            {/if}

            {if $array_ordini['n_ordini'] > 0}
            <!-- Pagination -->
            <nav aria-label="Pagination">
                <ul class="pagination">
                    {if $array_ordini['currentPage'] > 1}
                        <li class="page-item">
                            <a class="page-link" href="?orderPage={$array_ordini['currentPage']-1}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    {/if}

                    {for $page=1 to $array_ordini['totalPages']}
                    <li class="page-item {if $page == $array_ordini['currentPage']}active{/if}">
                        <a class="page-link" href="?orderPage={$page}">{$page}</a>
                    </li>
                    {/for}

                    {if $array_ordini['currentPage'] < $array_ordini['totalPages']}
                        <li class="page-item">
                            <a class="page-link" href="?orderPage={$array_ordini['currentPage']+1}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    {/if}
                </ul>
            </nav>
            <!-- /Pagination -->
            {/if}

            {foreach from=$array_ordini['ordini'] item=ordine}
                <!-- order -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="order mb-3">
                        <div class="order-details">
                            <h4 class="order-id">Ordine: </h4>
                            <p class="order-acquirente">Nome acquirente: </p>
                            <p class="order-prodotto">Nome prodotto: </p>
                            <p class="order-indirizzo">Indirizzo: </p>
                            <p class="order-quantity">Quantità: </p>
                            <p class="order-total">Importo Totale: €</p>
                        </div>
                        <div class="order-actions">
                            <a class="btn btn-info" href="/TekHub/gestioneOrdini/dettagli/{$ordine->getIdOrdine()}"><i class="fas fa-info-circle"></i> Dettagli</a>
                            <form style="display:inline;" method="POST" action="/TekHub/gestioneOrdini/prendiInCarico/{$ordine->getIdOrdine()}" onsubmit="return confirm('Sei sicuro di voler prendere in carico questo ordine?');">
                                <button class="btn btn-warning" type="submit"><i class="fas fa-edit"></i> Prendi in carico</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--/order -->
            {/foreach}
        </div>

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