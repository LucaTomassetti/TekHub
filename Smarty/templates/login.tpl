<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <style>
    .login-container {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-box {
      max-width: 400px;
      width: 100%;
      padding: 2rem;
      box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body>
<form method="POST" action="/TekHub/utente/login">
  <div class="login-container">
    <div class="login-box">
      <h1 class="title has-text-centered">Login</h1>
      {if $errore!="false"}
        <div class="notification is-danger">
          <button class="delete"></button>
          Username vuoto!
        </div>
      {/if}
        
        <div class="field">
          <label class="label">Username</label>
          <div class="control">
            <input name="username" class="input" type="text" placeholder="Enter your username">
          </div>
        </div>

        <div class="field">
          <label class="label">Password</label>
          <div class="control">
            <input name="password" class="input" type="password" placeholder="Enter your password">
          </div>
        </div>

        <div class="field">
          <div class="control">
            <button type="submit" class="button is-primary is-fullwidth">Login</button>
          </div>
        </div>

        <div class="has-text-centered">
          <a href="#">Forgot password?</a>
        </div>
    </div>
  </div>
</form>
</body>
</html>
