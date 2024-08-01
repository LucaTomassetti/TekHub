{if $addedProductSuccess == 1}
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Aggiunta del prodotto avvenuta con successo!
        </div>
    </div>
{/if}
{if $modifiedProductSuccess == 1}
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Modifica del prodotto avvenuta con successo!
        </div>
    </div>
{/if}
{if $deletedProductSuccess == 1}
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Eliminazione del prodotto avvenuta con successo!
        </div>
    </div>
{/if}
<form class="container-fluid text-center" method="GET" action="/TekHub/gestioneProdotti/addProduct">
    <button type="submit" class="btn btn-primary">Aggiungi un nuovo prodotto</button>
</form>
    <!-- row -->
    <div class="row">
        {if $array_prodotti['n_prodotti'] == 0}
            <div class="alert alert-warning">
                Non ci sono prodotti! Aggiungi i prodotti dal tasto in alto
            </div>
        {/if}

        {if $array_prodotti['n_prodotti'] > 0} 
            <!-- Pagination -->
            <ul class="reviews-pagination">
            {if $array_prodotti['currentPage'] > 1}
                <li><a href="?page={$array_prodotti['currentPage']-1}"><i class="fa fa-angle-left"></i></a></li>
            {/if}

            {for $page=1 to $array_prodotti['totalPages']}
            <li {if $page == $array_prodotti['currentPage']}class="active"{/if}><a href="?page={$page}">
                {$page}
            </a></li>
            {/for}

            {if $array_prodotti['currentPage'] < $array_prodotti['totalPages']}
                <li><a href="?page={$array_prodotti['currentPage']+1}"><i class="fa fa-angle-right"></i></a></li>
            {/if}
            </ul>
            <!-- /Pagination -->
        {/if} 
                {foreach from=$array_prodotti['prodotti'] item=prodotto}
                    <!-- product -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="product">
                        <div class="product-img">
                            {if isset($prodotto->getImmagini()->last()->getImageData()) && isset($prodotto->getImmagini()->last()->getType())}
                                <img src="data:{$prodotto->getImmagini()->last()->getType()};base64,{$prodotto->getImmagini()->last()->getEncodedData()}" alt="Immagine">
                            {else}
                                <p>Immagine non trovata</p>
                            {/if}         
                        </div>
                        <div class="product-body">
                            <p class="product-category">{$prodotto->getCategoryName()->getNomeCategoria()}</p>
                            <h3 class="product-name">{$prodotto->getNome()}</h3>
                                {if $prodotto instanceof EUsato}
                                    <h4 class="product-price">€{$prodotto->getFloorPrice()}</h4>
                                {elseif $prodotto instanceof ENuovo}
                                    <h4 class="product-price">€{$prodotto->getPrezzoFisso()}</h4>
                                {/if}
                        </div>
                        <div class="add-to-cart">
                            <form style="display:inline;" method="GET" action="/TekHub/gestioneProdotti/modificaProdotto/{$prodotto->getIdProdotto()}">
                                <button class="add-to-cart-btn"><i class="fas fa-table"></i> Modifica</button>
                            </form>
                            <button id="{$prodotto->getIdProdotto()}" class="deleteProdBtns add-to-cart-btn"><i class="fas fa-trash-alt"></i> Elimina</button>
                        </div>
                    </div>
                    </div>
                    <!-- /product -->
                {/foreach}
    </div>
    {include file = 'productDelete.tpl'}
