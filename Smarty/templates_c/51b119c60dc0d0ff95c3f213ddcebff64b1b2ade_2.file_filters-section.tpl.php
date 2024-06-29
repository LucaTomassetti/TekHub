<?php
/* Smarty version 5.3.0, created on 2024-06-29 13:01:52
  from 'file:filters-section.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_667fe9a014d272_82167635',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51b119c60dc0d0ff95c3f213ddcebff64b1b2ade' => 
    array (
      0 => 'filters-section.tpl',
      1 => 1719658908,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_667fe9a014d272_82167635 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\TekHub\\Smarty\\templates';
?>
            <!-- Filter Section -->
                <div class="form-container">
                    <form method="POST" action="">
                    <h2>Sezione filtri</h2>
                        <button type="submit" class="btn btn-primary btn-block">Applica filtri</button>
                        <div class="form-group">
                        <label for="userType" class="form-label">Seleziona il tipo di id da cercare</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="userType" id="acquirente" value="acquirente" required>
                            <label class="form-check-label" for="acquirente">
                                Acquirente
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="userType" id="venditore" value="venditore" required>
                            <label class="form-check-label" for="venditore">
                                Ordine
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="userType" id="venditore" value="venditore" required>
                            <label class="form-check-label" for="venditore">
                                Prodotto
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="userType" id="venditore" value="venditore" required>
                            <label class="form-check-label" for="venditore">
                                Recensione
                            </label>
                        </div>
                        </div>

                        <div class="form-group">
                            
                            <input name="id" type="text" class="form-control" id="id" placeholder="ID..." required>
                        </div>
                        <div class="form-group">
                            <label for="categoryFilter">Categoria</label>
                            <select id="categoryFilter" class="form-control">
                                <option value="1">Categoria 1</option>
                                <option value="2">Categoria 2</option>
                                <option value="3">Categoria 3</option>
                                <option value="4">Categoria 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="marcaFilter">Marca</label>
                            <select id="marcaFilter" class="form-control">
                                <option value="1">Marca 1</option>
                                <option value="2">Marca 2</option>
                                <option value="3">Marca 3</option>
                                <option value="4">Marca 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="priceRange">Prezzo: <span id="priceValue">0</span></label>
                            <input type="range" class="form-control-range" id="priceRange" min="0" max="5000" value="0" oninput="updatePriceValue(this.value)">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="filter1">
                            <label class="form-check-label" for="filter1">
                                Filtri Opzione 1
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="filter2">
                            <label class="form-check-label" for="filter2">
                                 Filtri Opzione 2
                            </label>
                        </div>
                    </form>
                </div>
            <?php echo '<script'; ?>
>
                function updatePriceValue(value) {
                    const priceValue = document.getElementById('priceValue');
                    priceValue.textContent = value+"€";
                    if(priceValue.textContent == "5000€"){
                        priceValue.textContent = value+"€ e più";
                    }
                }
            <?php echo '</script'; ?>
><?php }
}
