<?php
/* Smarty version 5.3.0, created on 2024-06-27 20:15:56
  from 'file:userDataForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_667dac5c159a96_39137437',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3bd3f533dfc278dca2c08c4028e0220ef45915b2' => 
    array (
      0 => 'userDataForm.tpl',
      1 => 1719512122,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_667dac5c159a96_39137437 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?><div class="form-container">
    <h2 class="text-center">I miei dati personali</h2>

    <form id="registrationForm" method="POST" action="/TekHub/utente/changeUserData">
        <div class="form-group">
            <label>Nome</label>
            <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome..." value=<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('nome')), ENT_QUOTES, 'UTF-8');?>
 required>
        </div>
        <div class="form-group">
        <label>Cognome</label>
            <input name="cognome" type="text" class="form-control" id="cognome" placeholder="Cognome..." value=<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('cognome')), ENT_QUOTES, 'UTF-8');?>
 required>
        </div>
        <div class="form-group">
        <label>Nome utente</label>
            <input name="username" type="text" class="form-control" id="username" placeholder="Username..." value=<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('username')), ENT_QUOTES, 'UTF-8');?>
 required>
        </div>
        <div class="form-group">
        <label>Numero di telefono</label>
            <input name="cellulare" type="tel" class="form-control" id="cellulare" placeholder="es. 3456789333" pattern="[0-9]+" maxlength="10" value=<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('cellulare')), ENT_QUOTES, 'UTF-8');?>
 required>
        </div>
        <div class="form-group">
        <label>E-mail</label>
            <input name="email" type="email" class="form-control" id="email" value=<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('email')), ENT_QUOTES, 'UTF-8');?>
 disabled>
            <h6 class="attention-note">*Attenzione: non è possibile modificare l'E-mail</h6>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Modifica</button>
        <br>
        <a id="linkpass" href="/TekHub/utente/changePass">Modifica la password</a>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.5.1.slim.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"><?php echo '</script'; ?>
><?php }
}
