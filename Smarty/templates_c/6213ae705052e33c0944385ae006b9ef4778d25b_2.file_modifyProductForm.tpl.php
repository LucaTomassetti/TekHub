<?php
/* Smarty version 5.3.0, created on 2024-07-12 10:40:33
  from 'file:modifyProductForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_6690ec013eacd7_77063765',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6213ae705052e33c0944385ae006b9ef4778d25b' => 
    array (
      0 => 'modifyProductForm.tpl',
      1 => 1720773135,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6690ec013eacd7_77063765 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/TekHub/Smarty/templates';
if ($_smarty_tpl->getValue('errorImageUpload') == 1) {?>
    <div class="mt-5">
        <div class="alert alert-danger" role="alert">
            Errore nell'upload delle immagini! Size troppo grande o tipo del file diverso da jpeg/png !
        </div>
    </div>
<?php }?>

<div class="form-container width-90">
    <h2>Modifica il prodotto</h2>
    <form class="registrationForm" id="modifyProductForm" method="POST" action="/TekHub/gestioneProdotti/modificaProdotto/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('productId')), ENT_QUOTES, 'UTF-8');?>
" enctype="multipart/form-data">
        <div class="left-column">
            <div class="form-group">
                <label>Titolo prodotto</label>
                <input name="nome" type="text" class="form-control" id="nome" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('nomeProdotto')), ENT_QUOTES, 'UTF-8');?>
" placeholder="Nome..." required>
            </div>
            
            <div class="form-group">
            <label>Descrizione</label>
            <br>
                <textarea name="descrizione" id="description" rows="10" cols="57" required><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('descrizione')), ENT_QUOTES, 'UTF-8');?>
</textarea>
            </div>
            <div class="form-group">
            <label>Categoria</label>
                <select name="categoria" id="categoria" class="form-control" disabled>
                    <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('categoria')), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('categoria')), ENT_QUOTES, 'UTF-8');?>
</option>
                </select>
            </div>

            <div class="form-group">
                <label for="images">Aggiungi al massimo 10 immagini (le immagini attuali saranno eliminate) :</label>
                    <input id="images" name="images[]" type="file" multiple>
            </div>

            <div class="image-preview" id="imagePreview">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('immagini'), 'immagine');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('immagine')->value) {
$foreach0DoElse = false;
?>
                    <div class="image-container">
                        <img src="data:<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('immagine')['type']), ENT_QUOTES, 'UTF-8');?>
;base64,<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('immagine')['imageData']), ENT_QUOTES, 'UTF-8');?>
" alt="Immagine">
                        <button type="button" class="remove-button">Immagine attuale</button>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>

        </div>

        <div class="right-column">
            <fieldset>
                <legend>Specifice dell'oggetto</legend>

                <label for="brand">Marca</label>
                <input type="text" name="marca" id="brand" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('marca')), ENT_QUOTES, 'UTF-8');?>
" required>

                <label for="model">Modello</label>
                <input type="text" name="modello" id="model" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('modello')), ENT_QUOTES, 'UTF-8');?>
" required>

                <?php if ($_smarty_tpl->getValue('isProdottoNuovo') == 1) {?>
                <label for="quantity">Quantità</label>
                <input type="number" name="quantita_disp" value=<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('quantita_disp')), ENT_QUOTES, 'UTF-8');?>
 min="1" step="1" id="quantita_disp" required>
                <?php }?>
                <label for="color">Colore</label>
                <input type="text" name="colore" id="color" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('colore')), ENT_QUOTES, 'UTF-8');?>
" required>
            </fieldset>

            <?php if ($_smarty_tpl->getValue('isProdottoNuovo') == 1) {?>
                <div class="form-group">
                    <label for="price">Prezzo</label>
                    <input type="number" name="prezzo-nuovo" id="pricefornew" value=<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('prezzo_fisso')), ENT_QUOTES, 'UTF-8');?>
 min="1" step="0.01" placeholder="€####" required>
                </div>
            <?php } elseif ($_smarty_tpl->getValue('isProdottoNuovo') == 0) {?>
                <div class="form-group">
                    <label for="starting_price">Prezzo di partenza</label>
                    <input type="text" id="prezzo-asta" value=<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('floor_price')), ENT_QUOTES, 'UTF-8');?>
 min="1" step="0.01" disabled>
                </div>
                <div class="form-group">
                    <label for="auction_date">Data inizio asta</label>
                    <input type="text" id="data-inizio-asta-mod" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('data_inizio_asta')), ENT_QUOTES, 'UTF-8');?>
" pattern="^(\d\d\d\d)-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]) ([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$" disabled>
                </div>
                <div class="form-group">
                    <label for="auction_date">Data fine asta</label>
                    <input type="text" name="data-fine-asta" id="data-fine-asta-mod" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('data_fine_asta')), ENT_QUOTES, 'UTF-8');?>
" pattern="^(\d\d\d\d)-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]) ([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$" placeholder="YYYY-MM-DD HH:MM:SS" required>
                </div>
            <?php }?>

            <button type="submit" class="btn btn-primary">Modifica</button>
        </div>

    </form>
</div>
<?php echo '<script'; ?>
>
const input = document.getElementById('images');
const imagePreview = document.getElementById('imagePreview');
let imageArray = [];

input.addEventListener('change', () => {
    const files = Array.from(input.files);
    imageArray = files;

    updateImagePreview();
    updateInputFiles();
});

function updateImagePreview() {
    imagePreview.innerHTML = '';

    imageArray.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = () => {
            const imgContainer = document.createElement('div');
            imgContainer.classList.add('image-container');

            const img = document.createElement('img');
            img.src = reader.result;
            imgContainer.appendChild(img);

            const removeButton = document.createElement('button');
            removeButton.classList.add('remove-button');
            removeButton.textContent = 'Rimuovi';
            removeButton.onclick = () => {
                imageArray.splice(index, 1);
                updateImagePreview();
                updateInputFiles();
            };

            imgContainer.appendChild(removeButton);
            imagePreview.appendChild(imgContainer);
        };
        reader.readAsDataURL(file);
    });
}

function updateInputFiles() {
    const dataTransfer = new DataTransfer();
    imageArray.forEach(file => dataTransfer.items.add(file));
    input.files = dataTransfer.files;
}

function removeImage(button) {
    const index = Array.from(imagePreview.children).indexOf(button.parentElement);
    imageArray.splice(index, 1);
    updateImagePreview();
    updateInputFiles();
}
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
        // Aggiungi un evento di submit al form
        document.getElementById('modifyProductForm').addEventListener('submit', function(event) {
            var startDateValue = document.getElementById('data-inizio-asta-mod').value;
            var endDateValue = document.getElementById('data-fine-asta-mod').value;

            // Verifica che la data di fine non sia precedente alla data di inizio
            if (new Date(endDateValue) < new Date(startDateValue)) {
                alert("La data di fine asta non può essere precedente alla data di inizio asta.");
                event.preventDefault(); // Blocca l'invio del form
            }
        });
<?php echo '</script'; ?>
><?php }
}
