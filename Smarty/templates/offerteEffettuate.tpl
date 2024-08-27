<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Offerte effettuate</title>

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
<br>
<div class="container mt-5">
    <h2>Le mie offerte</h2>
    {if isset($offerte) && !empty($offerte)}
        <table class="table">
            <thead>
                <tr>
                    <th>Prodotto</th>
                    <th>Importo offerta</th>
                    <th>Data offerta</th>
                    <th>Stato</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                {foreach $offerte as $offerta}
                    <tr>
                        <td>{$offerta->getProdotto()->getNome()}</td>
                        <td>€{$offerta->getImporto()}</td>
                        <td>{$offerta->getData()->format('d/m/Y H:i:s')}</td>
                        <td>{$offerta->getStato()}</td>
                        <td>
                            {if $offerta->getStato() == 'Superata'}
                                <a href="/TekHub/asta/rilancia/{$offerta->getIdOfferta()}" class="btn btn-primary btn-sm">Rilancia</a>
                            {elseif $offerta->getStato() == 'Prodotto aggiudicato'}
                                <span class="text-success">Hai vinto l'asta!</span>
                            {elseif $offerta->getStato() == 'Vincente'}
                                <span class="text-info">Offerta più alta al momento</span>
                            {elseif $offerta->getStato() == 'Persa'}
                                <span class="text-info">Asta persa</span>
                            {else}
                                <span class="text-info">In attesa</span>
                            {/if}
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        <p>Non hai ancora effettuato offerte.</p>
    {/if}
</div>
<script src="/TekHub/skin/electro-master/js/scripts-for-template.js"></script>
<script src="/TekHub/skin/electro-master/js/jquery.min.js"></script>
<script src="/TekHub/skin/electro-master/js/bootstrap.min.js"></script>
<script src="/TekHub/skin/electro-master/js/slick.min.js"></script>
<script src="/TekHub/skin/electro-master/js/nouislider.min.js"></script>
<script src="/TekHub/skin/electro-master/js/jquery.zoom.min.js"></script>
<script src="/TekHub/skin/electro-master/js/main.js"></script>

</body>
</html>