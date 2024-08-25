<div class="form-container">
    <h2 class="text-center">Aggiungi una carta di credito</h2>

    {if isset($errors) && !empty($errors)}
        <div class="alert alert-danger">
            <ul>
                {foreach $errors as $error}
                    <li>{$error}</li>
                {/foreach}
            </ul>
        </div>
    {/if}

    <form id="creditCardForm" method="POST" action="/TekHub/utente/aggiungiCarte">
        <div class="form-group">
            <label>Nome titolare</label>
            <input name="nome" type="text" class="form-control" id="nome" placeholder="es. Mario" required>
        </div>
        <div class="form-group">
            <label>Cognome titolare</label>
            <input name="cognome" type="text" class="form-control" id="cognome" placeholder="es. Rossi" required>
        </div>
        <div class="form-group">
            <label>Numero Carta</label>
            <input name="numeroCarta" type="text" class="form-control" id="numeroCarta" placeholder="es. 5432123412341234" required>
        </div>
        <div class="form-group">
            <label>Scadenza</label>
            <input name="scadenza" type="text" class="form-control" id="scadenza" placeholder="es. 01/25" required>
        </div>
        <div class="form-group">
            <label>CCV</label>
            <input name="ccv" type="text" class="form-control" id="ccv" placeholder="es. 111" required>
        </div>
        <div class="form-group">
            <label>Gestore</label>
            <input name="gestore" type="text" class="form-control" id="gestore" placeholder="es. Visa" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Aggiungi</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>