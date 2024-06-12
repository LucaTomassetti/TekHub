<?php
/* Smarty version 5.3.0, created on 2024-06-11 11:04:23
  from 'file:error_page.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCached()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_66681317332737_69922616',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ae68f9c822cfbc94573e04ad250e42ae7c0d9d9' => 
    array (
      0 => 'error_page.tpl',
      1 => 1718031939,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 3600,
))) {
function content_66681317332737_69922616 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 Not Found</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <style>
    .hero-body {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      text-align: center;
    }
    .hero-body img {
      max-width: 300px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <!-- Hero section -->
  <section class="hero is-fullheight is-light">
    <div class="hero-body">
      <div class="container">
        <img src="img/404_image-copia.jpeg" alt="404 Error">
        <h1 class="title">
          404 Not Found
        </h1>
        <h2 class="subtitle">
          Oops! The page you are looking for does not exist.
        </h2>
        <a class="button is-primary" href="/TekHub/homepage">Go back to Home</a>
      </div>
    </div>
  </section>
</body>
</html>
<?php }
}
