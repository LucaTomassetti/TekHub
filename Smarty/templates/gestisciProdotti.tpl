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

<h2> AREA GESTIONE PRODOTTI </h2>


<div class="col-lg-3 col-md-3 col-sm-4">

<div class="form container">
<h2>Cerca tramite ID</h2>
    <form action="/TekHub/utente/searchProducts" method="post">
        <input type="text" name="search" placeholder="inserisci id">
        <input type="submit" value="Search">
    </form>
</div>

	{if isset($search_results)}
    <h2>Search Results</h2>
    {if $products|@count > 0}
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Color</th>
            </tr>
            {foreach $products as $product}
                <tr>
                    <td>{$product->getIdProdotto()}</td>
                    <td>{$product->getNome()}</td>
                    <td>{$product->getDescrizione()}</td>
                    <td>{$product->getMarca()}</td>
                    <td>{$product->getModello()}</td>
                    <td>{$product->getColore()}</td>
					<td>
                    {if $show_delete_button}
                        <form action="/TekHub/utente/deleteProduct/{$product->getIdProdotto()}" method="post">
                            <button type="submit" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto?');">Elimina</button>
                        </form>
                    {/if}
                </td>
                </tr>
            {/foreach}
        </table>
    {else}
        <p>No products found.</p>
    {/if}
{/if}


</div>


</body>
</html>