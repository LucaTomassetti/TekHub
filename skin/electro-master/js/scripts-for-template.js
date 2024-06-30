/*
// Funzione per aggiornare il numero quando si fa clic sul pulsante
function Aggiungi() {
    var numeroAttuale = parseInt(document.getElementById("numeroAcquisti").innerText);
    var nuovoNumero = numeroAttuale + 1;
    document.getElementById("numeroAcquisti").innerText = nuovoNumero;
}
*/
document.querySelectorAll('input[name="productType"]').forEach((elem) => {
    elem.addEventListener("change", function(event) {
      var prezzoasta = document.querySelector('.prezzo-asta');
      var dataasta = document.querySelector('.data-asta');
      var pricefornew = document.querySelector('.price-for-new');
      if (event.target.value === 'usato') {
        prezzoasta.style.display = 'block';
        dataasta.style.display = 'block';
        pricefornew.style.display = 'none';
        document.getElementById('data-asta').required = true;
        document.getElementById('prezzo-asta').required = true;
        document.getElementById('pricefornew').required = false;
      } else if((event.target.value === 'nuovo')){
        prezzoasta.style.display = 'none';
        dataasta.style.display = 'none';
        pricefornew.style.display = 'block';
        document.getElementById('data-asta').required = false;
        document.getElementById('prezzo-asta').required = false;
        document.getElementById('pricefornew').required = true;
      }
    });
  });
document.querySelectorAll('input[name="userType"]').forEach((elem) => {
    elem.addEventListener("change", function(event) {
      var sellerFields = document.querySelector('.seller-fields');
      if (event.target.value === 'venditore') {
        sellerFields.style.display = 'block';
      } else {
        sellerFields.style.display = 'none';
      }
    });
  });
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