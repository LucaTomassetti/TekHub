<div class="container mt-5">
    <h2>Dettaglio Ordine #{$ordine->getId_ordine()}</h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Informazioni Ordine</h4>
            <p><strong>Data:</strong> {$ordine->getData_ordine()->format('d/m/Y')}</p>
            <p><strong>Stato:</strong> {$ordine->getStato_ordine()}</p>
            <p><strong>Importo totale:</strong> €{$ordine->getImporto_tot()|string_format:"%.2f"}</p>
        </div>
        <div class="col-md-6">
            <h4>Indirizzo di Spedizione</h4>
            <p>{$ordine->getIndirizzo_spedizione()->getIndirizzo()}</p>
            <p>{$ordine->getIndirizzo_spedizione()->getCap()}</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <h4>Metodo di Pagamento</h4>
            <p><strong>Carta di Credito:</strong> **** **** **** {$ordine->getCarta_ordine()->getNumero_carta()|substr:-4}</p>
            <p><strong>Titolare:</strong> {$ordine->getCarta_ordine()->getNome_titolare()} {$ordine->getCarta_ordine()->getCognome_titolare()}</p>
            <p><strong>Scadenza:</strong> {$ordine->getCarta_ordine()->getData_scadenza()}</p>
        </div>
    </div>
    <h4 class="mt-4">Prodotti Ordinati</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Prodotto</th>
                <th>Quantità</th>
                <th>Prezzo Unitario</th>
                <th>Totale</th>
            </tr>
        </thead>
        <tbody>
            {foreach $ordine->getQProdottoOrdine() as $ordineProdotto}
                <tr>
                    <td>{$ordineProdotto->getProdottoId()->getNome()}</td>
                    <td>{$ordineProdotto->getQuantitaOrdinataProdotto()}</td>
                    <td>€{$ordineProdotto->getProdottoId()->getPrezzoFisso()|string_format:"%.2f"}</td>
                    <td>€{($ordineProdotto->getQuantitaOrdinataProdotto() * $ordineProdotto->getProdottoId()->getPrezzoFisso())|string_format:"%.2f"}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</div>