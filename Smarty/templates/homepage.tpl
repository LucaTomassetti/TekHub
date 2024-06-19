<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-commerce Homepage</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <style>
    .hero-body {
      background: url('https://via.placeholder.com/1920x500') center/cover;
      color: white;
    }
    .product-card img {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar is-primary">
    <div class="container">
      <div class="navbar-brand">
        <a class="navbar-item" href="#">
          <strong>E-Tech</strong>
        </a>
        <span class="navbar-burger" data-target="navbarMenu">
          <span></span>
          <span></span>
          <span></span>
        </span>
      </div>
      <div id="navbarMenu" class="navbar-menu">
        <div class="navbar-end">
          <a class="navbar-item" href="#">Home</a>
          <a class="navbar-item" href="#">Products</a>
          <a class="navbar-item" href="#">About</a>
          <a class="navbar-item" href="#">Contact</a>
          {if $check_login == 1}
            <a href="/TekHub/utente/logout" class="navbar-item">Logout</a>
            
          {else}
            <a href="/TekHub/utente/login" class="navbar-item">Accedi</a>
          {/if}
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero section -->
  <section class="hero is-medium">
    <div class="hero-body has-text-centered">
      <div class="container">
        <h1 class="title">
          Welcome to E-Tech
        </h1>
        <h2 class="subtitle">
          Your one-stop shop for the latest tech products
        </h2>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="section">
    <div class="container">
      <h1 class="title has-text-centered">Featured Products</h1>
      <div class="columns is-multiline">
        <div class="column is-one-quarter">
          <div class="card product-card">
            <div class="card-image">
              <figure class="image is-4by3">
                <img src="https://via.placeholder.com/300" alt="Product 1">
              </figure>
            </div>
            <div class="card-content">
              <p class="title is-4">Product 1</p>
              <p class="subtitle is-6">$199.99</p>
              <button class="button is-primary is-fullwidth">Add to Cart</button>
            </div>
          </div>
        </div>
        <div class="column is-one-quarter">
          <div class="card product-card">
            <div class="card-image">
              <figure class="image is-4by3">
                <img src="https://via.placeholder.com/300" alt="Product 2">
              </figure>
            </div>
            <div class="card-content">
              <p class="title is-4">Product 2</p>
              <p class="subtitle is-6">$299.99</p>
              <button class="button is-primary is-fullwidth">Add to Cart</button>
            </div>
          </div>
        </div>
        <div class="column is-one-quarter">
          <div class="card product-card">
            <div class="card-image">
              <figure class="image is-4by3">
                <img src="https://via.placeholder.com/300" alt="Product 3">
              </figure>
            </div>
            <div class="card-content">
              <p class="title is-4">Product 3</p>
              <p class="subtitle is-6">$399.99</p>
              <button class="button is-primary is-fullwidth">Add to Cart</button>
            </div>
          </div>
        </div>
        <div class="column is-one-quarter">
          <div class="card product-card">
            <div class="card-image">
              <figure class="image is-4by3">
                <img src="https://via.placeholder.com/300" alt="Product 4">
              </figure>
            </div>
            <div class="card-content">
              <p class="title is-4">Product 4</p>
              <p class="subtitle is-6">$499.99</p>
              <button class="button is-primary is-fullwidth">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        <strong>E-Tech</strong> by <a href="#">Your Name</a>. The source code is licensed <a href="http://opensource.org/licenses/mit-license.php">MIT</a>.
      </p>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
      if ($navbarBurgers.length > 0) {
        $navbarBurgers.forEach(el => {
          el.addEventListener('click', () => {
            const target = el.dataset.target;
            const $target = document.getElementById(target);
            el.classList.toggle('is-active');
            $target.classList.toggle('is-active');
          });
        });
      }
    });
  </script>
</body>
</html>
