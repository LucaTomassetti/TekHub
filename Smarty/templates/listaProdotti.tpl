<form class="container-fluid text-center" method="GET" action="/TekHub/gestioneProdotti/addProduct">
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
                {foreach from=$array_prodotti item=prodotto}
                    <!-- product -->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="product">
                        <div class="product-img">
                            {if isset($prodotto.images.imageData) && isset($prodotto.images.type)}
                                <img src="data:{$prodotto.images.type};base64,{$prodotto.images.imageData}" alt="Immagine">
                            {else}
                                <p>Immagine non trovata</p>
                            {/if}        
                        </div>
                        <div class="product-body">
                            <p class="product-category">{$prodotto.nome_categoria}</p>
                            <h3 class="product-name"><a href="#">{$prodotto.nome}</a></h3>
                                {if isset($prodotto.floor_price)}
                                    <h4 class="product-price">€{$prodotto.floor_price}</h4>
                                {elseif isset($prodotto.prezzo_fisso)}
                                    <h4 class="product-price">€{$prodotto.prezzo_fisso}</h4>
                                {/if}
                        </div>
                        <div class="add-to-cart">
                            <button class="add-to-cart-btn"><i class="fas fa-table"></i> Modifica</button>
                            <button class="add-to-cart-btn"><i class="fas fa-trash-alt"></i> Elimina</button>
                        </div>
                    </div>
                    </div>
                    <!-- /product -->
                {/foreach}
    </div>
