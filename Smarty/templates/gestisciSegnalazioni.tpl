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

    <div class="container mt-5">

    {block name="admin_content"}
    <h2>Gestione Segnalazioni</h2>

    {if isset($message)}
        <div class="alert alert-success">{$message}</div>
    {/if}
    {if isset($error)}
        <div class="alert alert-danger">{$error}</div>
    {/if}

    <form method="post" action="/TekHub/admin/filterSegnalazioni">
        <div class="form-group">
            <label for="id_venditore">Filter by Venditore ID:</label>
            <input type="text" class="form-control" id="venditore_id" name="venditore_id">
        </div>
        <button type="submit" class="btn btn-primary">Filtra</button>
    </form>

    {if isset($segnalazioni) && !empty($segnalazioni.items)}
        <table class="table">
            <thead>
                <tr>
                    <th>ID Segnalazione</th>
                    <th>Motivo</th>
                    <th>Venditore ID</th>
                    <th>Venditore Nome</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {foreach $segnalazioni.items as $segnalazione}
                    <tr>
                        <td>{$segnalazione.id_segnalazione|default:'N/A'}</td>
                        <td>{$segnalazione.motivo|default:'N/A'}</td>
                        <td>{$segnalazione.venditore_id|default:'N/A'}</td>
                        <td>{$segnalazione.venditore_nome|default:'N/A'}</td>
                        <td>
                            {if isset($segnalazione.id_segnalazione)}
                                <form method="post" action="/TekHub/admin/risolviSegnalazione/{$segnalazione.id_segnalazione}" style="display:inline;">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sicuro di voler risolvere la segnalazione?');">Risolvi</button>
                                </form>
                            {/if}
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>

        <!-- Pagination -->
        {if isset($segnalazioni.currentPage) && isset($segnalazioni.totalPages)}
            <ul class="reviews-pagination">
                {if $segnalazioni.currentPage > 1}
                    <li><a href="?page={$segnalazioni.currentPage-1}"><i class="fa fa-angle-left"></i></a></li>
                {/if}

                {for $page=1 to $segnalazioni.totalPages}
                    <li {if $page == $segnalazioni.currentPage}class="active"{/if}><a href="?page={$page}">{$page}</a></li>
                {/for}

                {if $segnalazioni.currentPage < $segnalazioni.totalPages}
                    <li><a href="?page={$segnalazioni.currentPage+1}"><i class="fa fa-angle-right"></i></a></li>
                {/if}
            </ul>
        {/if}
    {else}
        <p>Nessuna segnalazione da visualizzare.</p>
    {/if}
    {/block}
    </div>
</body>
</html>