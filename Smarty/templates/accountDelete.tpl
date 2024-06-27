<div class="mt-4-c">
        <div class="form-group">
            <label>Desideri eliminare il tuo account?</label>
            <button type="submit" id="deleteBtn" class="btn btn-danger btn-block">Elimina Account</button>
        </div>
</div>
<form method="POST" action="/TekHub/utente/deleteAccount">
    <div id="confirmationPopup" class="popup">
        <div class="popup-content">
            <h2>Conferma eliminazione account</h2>
            <p>Per confermare l'eliminazione dell'account, digitare "CONFERMA" nel campo sottostante e cliccare sul pulsante "Conferma"</p>
            <input type="text" id="confirmInput" placeholder="Digitare CONFERMA" required>
            <div class="bottoni">
                <button type="submit" class="btn btn-danger btn-block" id="confirmBtn">Conferma</button>
                <button type="button" class="btn btn-danger btn-block" id="cancelBtn">Annulla</button>
            </div>
        </div>
    </div>
</form>