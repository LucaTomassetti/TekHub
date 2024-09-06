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
    {if $check_login_acquirente == 1 || $check_login_venditore == 1}
    <div class="summary-item">
    <label>Username: </label><span id="summary-name">{$username}</span>
    </div>
    <br>
    <div class="summary-item">
    <label>Numero di telefono: </label><span id="summary-name">{$cellulare}</span>
    </div>
    {/if}
    <br>
    <div class="row d-flex justify-content-center">
        {if $check_login_admin == 0 && $check_login_venditore == 0}
            <div class="col-md-4">
                <a href="/TekHub/utente/userDataForm" class="btn btn-primary btn-block">Modifica dati personali</a>
            </div>
            <div class="col-md-4">
                <a href="/TekHub/utente/indirizzi" class="btn btn-primary btn-block">I miei indirizzi</a>
            </div>
            <div class="col-md-4">
                <a href="/TekHub/utente/carteCredito" class="btn btn-primary btn-block">Le mie carte di credito</a>
            </div>
        {else}
            <div class="col">
                <a href="/TekHub/utente/userDataForm" class="btn btn-primary btn-block">Modifica dati personali</a>
            </div>
        {/if}
    </div>
    {if $check_login_admin==0}
    {include file = 'accountDelete.tpl'}
    {/if}
</div>