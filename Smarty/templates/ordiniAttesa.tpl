<!-- row -->
<div class="row">
    {if $array_ordini['n_ordini'] == 0}
        <div class="alert alert-warning">
            Non ci sono ordini!
        </div>
    {/if}

    {if $array_ordini['n_ordini'] > 0}
    <!-- Pagination -->
    <nav aria-label="Pagination">
        <ul class="pagination">
            {if $array_ordini['currentPage'] > 1}
                <li class="page-item">
                    <a class="page-link" href="?orderPage={$array_ordini['currentPage']-1}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            {/if}

            {for $page=1 to $array_ordini['totalPages']}
            <li class="page-item {if $page == $array_ordini['currentPage']}active{/if}">
                <a class="page-link" href="?orderPage={$page}">{$page}</a>
            </li>
            {/for}

            {if $array_ordini['currentPage'] < $array_ordini['totalPages']}
                <li class="page-item">
                    <a class="page-link" href="?orderPage={$array_ordini['currentPage']+1}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            {/if}
        </ul>
    </nav>
    <!-- /Pagination -->
    {/if}

    {foreach from=$array_ordini['ordini'] item=ordine}
        <!-- order -->
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="order mb-3">
                <div class="order-details">
                    <h4 class="order-id">Ordine: {$ordine->getIdOrdine()}</h4>
                    <p class="order-acquirente">Nome acquirente: {$ordine->()}</p>
                    <p class="order-prodotto">Nome prodotto: {$ordine->()}</p>
                    <p class="order-indirizzo">Indirizzo: {$ordine->()}</p>
                    <p class="order-quantity">Quantità: {$ordine->getQuantitaProdotto()}</p>
                    <p class="order-total">Importo Totale: €{$ordine->getImportoTot()}</p>
                    <p class="order-IBAN">IBAN acquirente: {$ordine->()}</p>
                </div>
                <div class="order-actions">
                    <a class="btn btn-info" href="/TekHub/gestioneOrdini/dettagli/{$ordine->getIdOrdine()}"><i class="fas fa-info-circle"></i> Dettagli</a>
                    <form style="display:inline;" method="POST" action="/TekHub/gestioneOrdini/prendiInCarico/{$ordine->getIdOrdine()}" onsubmit="return confirm('Sei sicuro di voler prendere in carico questo ordine?');">
                        <button class="btn btn-warning" type="submit"><i class="fas fa-edit"></i> Prendi in carico</button>
                    </form>
                </div>
            </div>
        </div>
        <!--/order -->
    {/foreach}
</div>
