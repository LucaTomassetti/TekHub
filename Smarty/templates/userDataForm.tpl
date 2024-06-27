<div class="form-container">
    <h2 class="text-center">I miei dati personali</h2>

    <form id="registrationForm" method="POST" action="/TekHub/utente/changeUserData">
        <div class="form-group">
            <label>Nome</label>
            <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome..." value={$nome} required>
        </div>
        <div class="form-group">
        <label>Cognome</label>
            <input name="cognome" type="text" class="form-control" id="cognome" placeholder="Cognome..." value={$cognome} required>
        </div>
        <div class="form-group">
        <label>Nome utente</label>
            <input name="username" type="text" class="form-control" id="username" placeholder="Username..." value={$username} required>
        </div>
        <div class="form-group">
        <label>Numero di telefono</label>
            <input name="cellulare" type="tel" class="form-control" id="cellulare" placeholder="es. 3456789333" pattern="[0-9]+" maxlength="10" value={$cellulare} required>
        </div>
        <div class="form-group">
        <label>E-mail</label>
            <input name="email" type="email" class="form-control" id="email" value={$email} disabled>
            <h6 class="attention-note">*Attenzione: non è possibile modificare l'E-mail</h6>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Modifica</button>
        <br>
        <a id="linkpass" href="/TekHub/utente/changePass">Modifica la password</a>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>