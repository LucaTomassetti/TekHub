/*
// Funzione per aggiornare il numero quando si fa clic sul pulsante
function Aggiungi() {
    var numeroAttuale = parseInt(document.getElementById("numeroAcquisti").innerText);
    var nuovoNumero = numeroAttuale + 1;
    document.getElementById("numeroAcquisti").innerText = nuovoNumero;
}
*/
document.addEventListener('DOMContentLoaded', function () {
    const confirmationPopup = document.getElementById('confirmationPopup');
    const confirmInput = document.getElementById('confirmInput');
    const confirmBtn = document.getElementById('confirmBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const deleteBtn = document.getElementById('deleteBtn');

    deleteBtn.addEventListener('click', function () {
        confirmationPopup.style.display = 'flex';
    });

    cancelBtn.addEventListener('click', function () {
        confirmationPopup.style.display = 'none';
    });

    confirmBtn.addEventListener('click', function (event) {
        
        if (confirmInput.value === 'CONFERMA') {
            alert('Account eliminato definitivamente.');
            confirmationPopup.style.display = 'none';
        } else {
            alert('Per favore, digita "CONFERMA" correttamente.');
            event.preventDefault();
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    $('.alert-success').click(function() {
        $(this).fadeOut('slow', function() {
            $('.alert-success').remove(); // Rimuove il div dal DOM dopo il fade out
        });
    });
});