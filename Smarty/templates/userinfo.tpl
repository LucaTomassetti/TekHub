<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Area utente</title>

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
    <!-- Contenuto principale -->
    <main>
        <div class="content-area">
            {if $userDataForm == 1}
                {include file='userDataForm.tpl'}
            {elseif $userHistoryOrders == 1}
                {include file='userHistoryOrders.tpl'}
            {elseif $changepass == 1}
                {include file='change-pass.tpl'}
            {elseif $userDataSection == 1}
                {include file='userDataSection.tpl'}
            {/if}
        </div>
    </main>

<script src="/TekHub/skin/electro-master/js/scripts-for-template.js"></script>
<script src="/TekHub/skin/electro-master/js/jquery.min.js"></script>
<script src="/TekHub/skin/electro-master/js/bootstrap.min.js"></script>
<script src="/TekHub/skin/electro-master/js/slick.min.js"></script>
<script src="/TekHub/skin/electro-master/js/nouislider.min.js"></script>
<script src="/TekHub/skin/electro-master/js/jquery.zoom.min.js"></script>
<script src="/TekHub/skin/electro-master/js/main.js"></script>

</body>
</html>