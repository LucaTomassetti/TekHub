<div class="form-container">
    <h2 class="text-center">Aggiungi un indirizzo</h2>

    {if isset($errors) && !empty($errors)}
        <div class="alert alert-danger">
            <ul>
                {foreach $errors as $error}
                    <li>{$error}</li>
                {/foreach}
            </ul>
        </div>
    {/if}
    
    <form id="registrationForm" method="POST" action="/TekHub/utente/aggiungiIndirizzi">
        <div class="form-group">
            <label>Indirizzo</label>
            <input name="via" type="text" class="form-control" id="via" placeholder="es. Via Roma 3" required>
        </div>
        <div class="form-group">
            <label>CAP</label>
            <input name="cap" type="text" class="form-control" id="cap" placeholder="es. 00021" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Aggiungi</button>
        <br>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>