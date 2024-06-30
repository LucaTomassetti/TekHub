<form class="container-fluid text-center"method="GET" action="/TekHub/utente/addProduct">
    <button type="submit" class="btn btn-primary">Aggiungi un nuovo prodotto</button>
</form>
{if $addedProductSuccess == 1}
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Aggiunta del prodotto avvenuta con successo!
        </div>
    </div>
{/if}
    <!-- row -->
    <div class="row">
                <!-- product -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="product">
                    <div class="product-img">
                        <img src="/TekHub/skin/electro-master/img/product05.png" alt="">
                    </div>
                    <div class="product-body">
                        <p class="product-category">Categoria</p>
                        <h3 class="product-name"><a href="#">Nome prodotto</a></h3>
                        <h4 class="product-price">€980.00</h4>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fas fa-table"></i> Modifica</button>
                        <button class="add-to-cart-btn"><i class="fas fa-trash-alt"></i> Elimina</button>
                    </div>
                </div>
                </div>
                <!-- /product -->

                <!-- product -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="product">
                    <div class="product-img">
                        <img src="/TekHub/skin/electro-master/img/product05.png" alt="">
                    </div>
                    <div class="product-body">
                        <p class="product-category">Categoria</p>
                        <h3 class="product-name"><a href="#">Nome prodotto</a></h3>
                        <h4 class="product-price">€980.00</h4>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fas fa-table"></i> Modifica</button>
                        <button class="add-to-cart-btn"><i class="fas fa-trash-alt"></i> Elimina</button>
                    </div>
                </div>
                </div>
                <!-- /product -->

                <!-- product -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="product">
                    <div class="product-img">
                        <img src="/TekHub/skin/electro-master/img/product05.png" alt="">
                    </div>
                    <div class="product-body">
                        <p class="product-category">Categoria</p>
                        <h3 class="product-name"><a href="#">Nome prodotto</a></h3>
                        <h4 class="product-price">€980.00</h4>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fas fa-table"></i> Modifica</button>
                        <button class="add-to-cart-btn"><i class="fas fa-trash-alt"></i> Elimina</button>
                    </div>
                </div>
                </div>
                <!-- /product -->
    </div>
