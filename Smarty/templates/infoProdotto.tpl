<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Info Prodotto: {$nomeProdotto}</title>

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

<!-- SECTION -->
<div class="section">
<!-- container -->
<div class="container">
	<!-- row -->
	<div class="row">
		<!-- Product main img -->
		<div class="col-md-5 col-md-push-2">
			<div id="product-main-img">
				<img id="immagine-principale" src="data:{$immagini[0].type};base64,{$immagini[0].imageData}" alt="Immagine Prodotto">
			</div>
		</div>
		<!-- /Product main img -->

		<!-- Product thumb imgs -->
		<div class="col-md-2  col-md-pull-5">
			<div id="product-imgs">
				{foreach from=$immagini item=immagine}
					<div class="product-preview">
					<div class="thumbnail-image-container">
						<img class="thumbnail-image" src="data:{$immagine.type};base64,{$immagine.imageData}" alt="Immagine Prodotto">
					</div>
				</div>
            	{/foreach}
			</div>
		</div>
		<!-- /Product thumb imgs -->

		<!-- Product details -->
		<div class="col-md-5">
			<div class="product-details">
				<h2 class="product-name">{$nomeProdotto}</h2>
				<div>
					<div class="product-rating">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-o"></i>
					</div>
					<a class="review-link" href="#">10 Review(s) | Add your review</a>
				</div>
				<div>
					{if $isProdottoNuovo == 1}
					<h3 class="product-price">€{$prezzo_fisso}</h3>
					<span class="product-available">In Stock: {$quantita_disp}</span>
					{else}
					<h3 class="product-price">Prezzo di partenza: €{$floor_price}</h3><br>
					<div class="padding-top-20"><span>Data inizio asta: {$data_inizio_asta}</span></div>
					<div class="padding-top-20"><span>Data fine asta: {$data_fine_asta}</span></div>
					{/if}
				</div>

				<ul class="product-links">
					<li>Categoria:</li>
					<li>{$categoria}</li>
				</ul>

				{if $isProdottoNuovo == 1}
				<div class="add-to-cart padding-top-20">
					<div class="tab-content">
						<div class="row">
							<div class="col-md-12">
								<p>{$descrizione}</p>
							</div>
						</div>
					</div>
					<form id="gestioneAcquisti" action="/TekHub/gestioneAcquisto/aggiungiAlCarrello/{$productId}" method="POST">
						{if $quantita_disp > 0}
						<select class="input-select margin-bottom-20" id="quantity" name="quantity">
						<!-- Controllo la quantità disp quando è minore di 10,
							Se è minore di 10, mettere tanti option quanto è le quantità 
							altrimenti fisso la quantità max a 10 -->
							{if $quantita_disp >= 10}
								{for $i=1 to 10}
									<option value="{$i}">Quantità: {$i}</option>
								{/for}
							{else}
								{for $i=1 to $quantita_disp}
									<option value="{$i}">Quantità: {$i}</option>
								{/for}
							{/if}
						</select>
						{/if}
			
						<div class="mt-3">
						{if $quantita_disp == 0}
							<p class="card-text"><i>Questo prodotto è attualmente terminato</i></p>
						{elseif $quantita_disp > 0}
							<button class="add-to-cart-btn" type="submit"><i class="fas fa-table"></i> Aggiungi al Carrello</button>
						{/if}
						</div>
					</form>
				</div>
				{else}
				<div class="add-to-cart padding-top-20">
					<h3 class="product-price">Offerta attuale: </h3>
					<input class="input padding-top-20" type="number" min="1" placeholder="Offri..." required></input>
					<button class="add-to-cart-btn padding-top-20" type="submit"><i class="fas fa-hand-holding-usd"></i> Conferma offerta</button>
				</div>
				{/if}

			</div>
		</div>
		<!-- /Product details -->

		<!-- Product tab -->
		<div class="col-md-12">
			<div id="product-tab">
				<!-- product tab nav -->
				<ul class="tab-nav">
					<li class="active"><a data-toggle="tab" href="#tab1">Descrizione</a></li>
					<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
				</ul>
				<!-- /product tab nav -->

				<!-- product tab content -->
				<div class="tab-content">
					<!-- tab1  -->
					<div id="tab1" class="tab-pane fade in active">
						<div class="row">
							<div class="col-md-12">
								<p>{$descrizione}</p>
							</div>
						</div>
					</div>
					<!-- /tab1  -->

					<!-- tab3  -->
					<div id="tab3" class="tab-pane fade in">
						<div class="row">
							<!-- Rating -->
							<div class="col-md-3">
								<div id="rating">
									<div class="rating-avg">
										<span>4.5</span>
										<div class="rating-stars">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o"></i>
										</div>
									</div>
									<ul class="rating">
										<li>
											<div class="rating-stars">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
											</div>
											<div class="rating-progress">
												<div style="width: 80%;"></div>
											</div>
											<span class="sum">3</span>
										</li>
										<li>
											<div class="rating-stars">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-o"></i>
											</div>
											<div class="rating-progress">
												<div style="width: 60%;"></div>
											</div>
											<span class="sum">2</span>
										</li>
										<li>
											<div class="rating-stars">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
											</div>
											<div class="rating-progress">
												<div></div>
											</div>
											<span class="sum">0</span>
										</li>
										<li>
											<div class="rating-stars">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
											</div>
											<div class="rating-progress">
												<div></div>
											</div>
											<span class="sum">0</span>
										</li>
										<li>
											<div class="rating-stars">
												<i class="fa fa-star"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
											</div>
											<div class="rating-progress">
												<div></div>
											</div>
											<span class="sum">0</span>
										</li>
									</ul>
								</div>
							</div>
							<!-- /Rating -->

							<!-- Reviews -->
							<div class="col-md-6">
								<div id="reviews">
									<ul class="reviews">
										<li>
											<div class="review-heading">
												<h5 class="name">John</h5>
												<p class="date">27 DEC 2018, 8:0 PM</p>
												<div class="review-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
												</div>
											</div>
											<div class="review-body">
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
											</div>
										</li>
										<li>
											<div class="review-heading">
												<h5 class="name">John</h5>
												<p class="date">27 DEC 2018, 8:0 PM</p>
												<div class="review-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
												</div>
											</div>
											<div class="review-body">
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
											</div>
										</li>
										<li>
											<div class="review-heading">
												<h5 class="name">John</h5>
												<p class="date">27 DEC 2018, 8:0 PM</p>
												<div class="review-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
												</div>
											</div>
											<div class="review-body">
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
											</div>
										</li>
									</ul>
									<ul class="reviews-pagination">
										<li class="active">1</li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
									</ul>
								</div>
							</div>
							<!-- /Reviews -->

							<!-- Review Form -->
							<div class="col-md-3">
								<div id="review-form">
									<form class="review-form">
										<input class="input" type="text" placeholder="Your Name">
										<input class="input" type="email" placeholder="Your Email">
										<textarea class="input" placeholder="Your Review"></textarea>
										<div class="input-rating">
											<span>Your Rating: </span>
											<div class="stars">
												<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
												<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
												<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
												<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
												<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
											</div>
										</div>
										<button class="primary-btn">Submit</button>
									</form>
								</div>
							</div>
							<!-- /Review Form -->
						</div>
					</div>
					<!-- /tab3  -->
				</div>
				<!-- /product tab content  -->
			</div>
		</div>
		<!-- /product tab -->
	</div>
	<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
<!-- container -->
<div class="container">
	<!-- row -->
	<div class="row">

		<div class="col-md-12">
			<div class="section-title text-center">
				<h3 class="title">Prodotti simili</h3>
			</div>
			{if $same_cat_products['n_prodotti'] == 1}
				<div class="alert-w alert-warning">
					Non ci sono prodotti simili!
				</div>
			{/if}
		</div>

		{if $same_cat_products['n_prodotti'] > 1}
			<!-- Pagination -->
			<ul class="reviews-pagination">
			{if $same_cat_products['currentPage'] > 1}
				<li><a href="?page={$same_cat_products['currentPage']-1}"><i class="fa fa-angle-left"></i></a></li>
			{/if}

			{for $page=1 to $same_cat_products['totalPages']}
			<li {if $page == $same_cat_products['currentPage']}class="active"{/if}><a href="?page={$page}">
				{$page}
			</a></li>
			{/for}

			{if $same_cat_products['currentPage'] < $same_cat_products['totalPages']}
				<li><a href="?page={$same_cat_products['currentPage']+1}"><i class="fa fa-angle-right"></i></a></li>
			{/if}
			</ul>
			<!-- /Pagination -->
		{/if} 

		<!-- product -->
		{foreach from=$same_cat_products['prodotti'] item=same_cat_prodotto}
		<div class="col-md-3 col-xs-6">
			<div class="product">
				<div class="product-img">
					{if isset($same_cat_prodotto->getImmagini()->last()->getImageData()) && isset($same_cat_prodotto->getImmagini()->last()->getType())}
						<img src="data:{$same_cat_prodotto->getImmagini()->last()->getType()};base64,{$same_cat_prodotto->getImmagini()->last()->getEncodedData()}" alt="Immagine">
					{else}
						<p>Immagine non trovata</p>
					{/if}        
				</div>
				<div class="product-body">
					<p class="product-category">{$same_cat_prodotto->getCategoryName()->getNomeCategoria()}</p>
					<h3 class="product-name">{$same_cat_prodotto->getNome()}</h3>
						{if $same_cat_prodotto instanceof EUsato}
							<h4 class="product-price">€{$same_cat_prodotto->getFloorPrice()}</h4>
						{elseif $same_cat_prodotto instanceof ENuovo}
							<h4 class="product-price">€{$same_cat_prodotto->getPrezzoFisso()}</h4>
						{/if}
				
					<form class="product-btns" method="GET" action="/TekHub/gestioneAcquisto/vediProdotto/{$same_cat_prodotto->getIdProdotto()}">											
						<button type="submit" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">vedi prodotto</span></button>
					</form>
				</div>
			</div>
		</div>
		{/foreach}
		<!-- /product --> 
	</div>
	<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /Section -->
<!-- FOOTER -->
<footer id="footer">
<!-- bottom footer -->
<div id="bottom-footer" class="section">
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12 text-center">
				<ul class="footer-payments">
					<li><a href="#"><i class="fab fa-cc-visa" style="color: #ffffff;"></i></a></li>
					<li><a href="#"><i class="fab fa-cc-paypal" style="color: #ffffff;"></i></a></li>
					<li><a href="#"><i class="fab fa-cc-mastercard" style="color: #ffffff;"></i></a></li>
					<li><a href="#"><i class="fab fa-cc-discover" style="color: #ffffff;"></i></a></li>
					<li><a href="#"><i class="fab fa-cc-amex" style="color: #ffffff;"></i></a></li>
				</ul>
				<span class="copyright">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</span>
			</div>
		</div>
			<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /bottom footer -->
</footer>
<!-- /FOOTER -->
<script>
    var immaginePrincipale = document.getElementById('immagine-principale');
    var thumbnailImages = document.getElementsByClassName('thumbnail-image');

    for (var i = 0; i < thumbnailImages.length; i++) {
        thumbnailImages[i].addEventListener('click', function() {
        immaginePrincipale.src = this.src;
        });
    }
</script>
<script>
    function cambiaAzione(action) {
        document.getElementById('gestioneAcquisti').action = action;
    }
</script>
<script src="/TekHub/skin/electro-master/js/scripts-for-template.js"></script>
<script src="/TekHub/skin/electro-master/js/jquery.min.js"></script>
<script src="/TekHub/skin/electro-master/js/bootstrap.min.js"></script>
<script src="/TekHub/skin/electro-master/js/nouislider.min.js"></script>
<script src="/TekHub/skin/electro-master/js/main.js"></script>

</body>
</html>