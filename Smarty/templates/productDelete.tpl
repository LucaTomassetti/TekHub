<form id="formProd" method="POST" action="/TekHub/gestioneProdotti/eliminaProdotto/{$prodotto->getIdProdotto()}">
    <div id="confirmationProdPopup" class="popup">
        <div class="popup-content">
            <h2>Conferma eliminazione prodotto</h2>
            <p>Per confermare l'eliminazione del prodotto, digitare "CONFERMA" nel campo sottostante e cliccare sul pulsante "Conferma"</p>
            <input type="text" id="confirmProdInput" placeholder="Digitare CONFERMA" required>
            <div class="bottoni">
                <button type="submit" href="" class="btn btn-danger btn-block" id="confirmProdBtn">Conferma</button>
                <button type="button" class="btn btn-danger btn-block" id="cancelProdBtn">Annulla</button>
            </div>
        </div>
    </div>
</form>