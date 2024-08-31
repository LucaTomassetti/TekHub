<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
         
         <title>Gestisci segnalazioni</title>

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


{block name="admin_content"}
    <h2>Gestione Segnalazioni</h2>
    
    {if $filter_form}
        <form action="/TekHub/gestioneSegnalazioni/filterSegnalazioni" method="post">
            <label for="id_segnalazione">ID Segnalazione:</label>
            <input type="text" id="id_segnalazione" name="id_segnalazione" required>
            <button type="submit">Filtra</button>
        </form>
    {/if}
    
    {if $filtered_results}
        <table>
            <tr>
                <th>ID</th>
                <th>Descrizione</th>
                <th>Data</th>
                <th>Azioni</th>
            </tr>
            {foreach $segnalazioni as $segnalazione}
                <tr>
                    <td>{$segnalazione->getId()}</td>
                    <td>{$segnalazione->getDescrizione()}</td>
                    <td>{$segnalazione->getData()}</td>
                    <td>
                        <form action="/TekHub/gestioneSegnalazioni/deleteSegnalazione/{$segnalazione->getId()}" method="post">
                            <button type="submit" onclick="return confirm('Sei sicuro di voler eliminare questa segnalazione?');">Elimina</button>
                        </form>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}
{/block}

</body>
</html>