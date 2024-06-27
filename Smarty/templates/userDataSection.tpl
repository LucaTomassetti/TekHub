{if $changepasswordsucces == 1}
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Modifica della password avvenuta con successo!
        </div>
    </div>
{/if}
{if $changeuserdatasucces == 1}
    <div class="mt-5">
        <div class="alert alert-success" role="alert">
            Modifica dati personali avvenuta con successo!
        </div>
    </div>
{/if}
<div class="section-container">
<h2 class="text-center">I miei dati personali</h2>
<br>
    <div class="summary-item">
        <label>Nome: </label><span id="summary-name">{$nome}</span>
    </div>
    <br>
    <div class="summary-item">
        <label>Cognome: </label><span id="summary-name">{$cognome}</span>
    </div>
    <br>
    <div class="summary-item">
        <label>Username: </label><span id="summary-name">{$username}</span>
    </div>
    <br>
    <div class="summary-item">
        <label>Numero di telefono: </label><span id="summary-name">{$cellulare}</span>
    </div>
    <br>
    <div class="summary-item">
        <label>E-mail: </label><span id="summary-name">{$email}</span>
    </div>
    <a href="/TekHub/utente/userDataForm" class="btn btn-primary btn-block">Modifica</a>

    {include file = 'accountDelete.tpl'}
</div>