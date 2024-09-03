<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Recensioni dei tuoi prodotti</title>

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
    <h2>Recensioni dei tuoi prodotti</h2>

    {if isset($success)}
        <div class="alert alert-success">{$success}</div>
    {/if}

    {if isset($error)}
        <div class="alert alert-danger">{$error}</div>
    {/if}
    
    {if $recensioni['n_recensioni'] > 1}
        <!-- Pagination -->
        <ul class="reviews-pagination">
        {if $recensioni['currentPage'] > 1}
            <li><a href="?recensioni_page={$recensioni['currentPage']-1}"><i class="fa fa-angle-left"></i></a></li>
        {/if}

        {for $page=1 to $recensioni['totalPages']}
        <li {if $page == $recensioni['currentPage']}class="active"{/if}><a href="?recensioni_page={$page}">
            {$page}
        </a></li>
        {/for}

        {if $recensioni['currentPage'] < $recensioni['totalPages']}
            <li><a href="?recensioni_page={$recensioni['currentPage']+1}"><i class="fa fa-angle-right"></i></a></li>
        {/if}
        </ul>
        <!-- /Pagination -->
    {/if}
    <br>
    {if $recensioni['n_recensioni'] == 0}
        <div class="alert alert-warning">
            Non ci sono recensioni per i tuoi prodotti!
        </div>
    {else}
        <div class="row">
            {foreach from=$recensioni['items'] item=recensione}
                <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Recensione per {$recensione->getProdotto()->getNome()}</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Acquirente:</strong> {$recensione->getAcquirente()->getUsername()}</p>
                        <p><strong>Valutazione:</strong> {$recensione->getValutazione()} / 5</p>
                        <p><strong>Testo:</strong> {$recensione->getTesto()}</p>
                        
                        {if $recensione->getRispostaVenditore()}
                            <div class="mt-3 p-3 border">
                                <h5>La tua risposta:</h5>
                                <p>{$recensione->getRispostaVenditore()}</p>
                            </div>
                        {else}
                            <form method="POST" action="/TekHub/gestioneRecensioni/rispondi/{$recensione->getId()}">
                                <div class="form-group">
                                    <label for="risposta">Rispondi alla recensione:</label>
                                    <textarea class="form-control" id="risposta" name="risposta" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Invia Risposta</button>
                            </form>
                        {/if}
                        
                        {if !$recensione->getSegnalazione()}
                            <form method="POST" action="/TekHub/gestioneRecensioni/segnala/{$recensione->getId()}" class="mt-3">
                                <div class="form-group">
                                    <label for="motivo">Motivo della segnalazione:</label>
                                    <textarea class="form-control" id="motivo" name="motivo" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-warning">Segnala Recensione</button>
                            </form>
                        {else}
                            <br>
                            <div class="mt-3 p-3 border">
                                <h5>Segnalazione inviata</h5>
                            </div>
                        {/if}
                    </div>
                </div>
                </div>
                <hr>
            {/foreach}
        </div>
    {/if}
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