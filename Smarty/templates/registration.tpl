<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrati</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <style>
    .registration-container {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .registration-box {
      max-width: 400px;
      width: 100%;
      padding: 2rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    #error-message {
      display: none; /* Nasconde il messaggio di errore inizialmente */
    }
  </style>
</head>
<body>
<form id="registrationForm" method="POST" action="/TekHub/utente/signup">
  <div class="registration-container">
    <div class="registration-box">
      <h1 class="title has-text-centered">Registrati</h1>

      {if $errore_r == 1}
        <div class="notification is-danger">
          <button class="delete"></button>
          Email già esistente! Registrati con un'altra email!
        </div>
      {/if}
        <div id="error-message" class="notification is-danger">
          <button class="delete"></button>
          Le password non corrispondono!
        </div>
        <div class="field">
          <div class="control">
          <input name="nome" type="text" class="input" id="nome" placeholder="Nome..." required>
          </div>
        </div>

        <div class="field">
          <div class="control">
          <input name="cognome" type="text" class="input" id="cognome" placeholder="Cognome..." required>
          </div>
        </div>

        <div class="field">
          <div class="control">
          <input name="username" type="text" class="input" id="username" placeholder="Username..." required>
          </div>
        </div>

        <div class="field">
          <div class="control">
          <input name="cellulare" type="tel" class="input" id="cellulare" placeholder="es. 3456789333" pattern="[0-9]+" maxlength="10" required>
          </div>
        </div>

        <div class="field">
          <div class="control">
          <input name="email" type="email" class="input" id="email" placeholder="es. prova@example.com" required>
          </div>
        </div>

        <div class="field">
          <div class="control">
          <input name="password" type="password" class="input" id="password" placeholder="Password..." required>
          </div>
        </div>

        <div class="field">
          <div class="control">
          <input name="confirm-password" type="password" class="input" id="confirm-password" placeholder="Conferma password..." required>
          </div>
        </div>

        <div class="field">
          <div class="control">
            <button type="submit" class="button is-primary is-fullwidth">Registrati</button>
          </div>
        </div>

        <div class="has-text-centered">
          <a href="/TekHub/utente/login">Hai già un account? Accedi</a>
        </div>
    </div>
  </div>
</form>

  <script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
      var password = document.getElementById('password').value;
      var confirmPassword = document.getElementById('confirm-password').value;
      var errorMessage = document.getElementById('error-message');

      if (password !== confirmPassword) {
        event.preventDefault(); // Prevent form from submitting
        errorMessage.style.display = 'block'; // Show error message
      } else {
        errorMessage.style.display = 'none'; // Hide error message if they match
      }
    });
  </script>
</body>
</html>
