<?php
/* Smarty version 5.3.0, created on 2024-07-12 12:57:52
  from 'file:addProductForm.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.0',
  'unifunc' => 'content_66910c307aa270_38556549',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '41d47ad79d62d4f960c0191de9aa959546f49c2c' => 
    array (
      0 => 'addProductForm.tpl',
      1 => 1720781638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_66910c307aa270_38556549 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/TekHub/Smarty/templates';
?>
    <?php if ($_smarty_tpl->getValue('errorImageUpload') == 1) {?>
        <div class="mt-5">
            <div class="alert alert-danger" role="alert">
                Errore nell'upload delle immagini! Size troppo grande o tipo del file diverso da jpeg/png !
            </div>
        </div>
    <?php }?>

<div class="form-container width-90">
        <h2>Metti in vendita un prodotto</h2>
        <form class="registrationForm" id="addProductForm" method="POST" action="/TekHub/gestioneProdotti/addProduct" enctype="multipart/form-data">
            <div class="left-column">
                <div class="form-group">
                    <label>Titolo prodotto</label>
                    <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome..." required>
                </div>
                
                <div class="form-group">
                <label>Descrizione</label>
                <br>
                    <textarea name="descrizione" id="description" rows="10" cols="57" required></textarea>
                </div>
                <div class="form-group">
                <label>Categoria</label>
                <select name="categoria" id="categoria" required>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('array_categorie'), 'categoria');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('categoria')->value) {
$foreach0DoElse = false;
?>
                    <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('categoria')['nome_categoria']), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('categoria')['nome_categoria']), ENT_QUOTES, 'UTF-8');?>
</option>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </select>
                </div>

                <div class="form-group">
                <label for="images">Aggiungi un massimo di 10 immagini:</label>
                    <input id="images" name="images[]" type="file" multiple required>
                </div>

                <div class="image-preview" id="imagePreview">
                </div>

                <div class="form-group price-for-new">
                    <label for="price">Prezzo</label>
                    <input type="text" name="prezzo-nuovo" id="pricefornew" min="1" step="0.01" placeholder="€####">
                </div>
            </div>

            <div class="right-column">
                <fieldset>
                    <legend>Specifice dell'oggetto</legend>

                    <label for="brand">Marca</label>
                    <input type="text" name="marca" id="brand" required>

                    <label for="model">Modello</label>
                    <input type="text" name="modello" id="model" required>

                    <label for="quantity">Quantità</label>
                    <input type="number" name="quantita_disp" id="quantita_disp" min="1" step="1" required>

                    <label for="color">Colore</label>
                    <input type="text" name="colore" id="color" required>
                </fieldset>

                <fieldset>
                    <legend>Condizione prodotto</legend>
                    <div class="form-group">
                    <label for="productType" class="form-label">Seleziona il tipo di prodotto:</label>
                                    <div class="form-check inline-block">
                                        <label class="form-check-label">
                                            Nuovo
                                        </label>
                                        <input class="form-check-input" type="radio" name="productType" id="nuovo" value="nuovo" required>
                                    </div>
                                    <div class="form-check inline-block">
                                        <label class="form-check-label">
                                            Usato
                                        </label>
                                        <input class="form-check-input" type="radio" name="productType" id="usato" value="usato" required>
                                    </div>
                    </div>
                </fieldset>
                <div class="form-group prezzo-asta">
                    <label for="starting_price">Prezzo di partenza</label>
                    <input type="number" name="prezzo-asta" id="prezzo-asta" min="1" step="0.01" placeholder="Inserisci prezzo di partenza..." required>
                </div>
                <div class="form-group data-inizio-asta">
                    <label for="auction_date">Data inizio asta</label>
                    <input type="text" name="data-inizio-asta" id="data-inizio-asta" pattern="^(\d\d\d\d)-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]) ([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$" disabled>
                </div>
                <div class="form-group data-fine-asta">
                    <label for="auction_date">Data fine asta</label>
                    <input type="text" name="data-fine-asta" id="data-fine-asta" pattern="^(\d\d\d\d)-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]) ([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$" placeholder="YYYY-MM-DD HH:MM:SS" required>
                </div>

                <button type="submit" class="btn btn-primary">Aggiungi</button>
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
        // Ottieni la data attuale
        var now = new Date();

        // Formatta la data in YYYY-MM-DD HH:MM:SS
        var day = String(now.getDate()).padStart(2, '0');
        var month = String(now.getMonth() + 1).padStart(2, '0'); // Gennaio è 0!
        var year = now.getFullYear();

        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var seconds = String(now.getSeconds()).padStart(2, '0');

        var formattedDateTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

        // Assegna la data e ora formattata al value dell'input
        document.getElementById('data-inizio-asta').value = formattedDateTime;
        
        document.getElementById('addProductForm').addEventListener('submit', function(event) {
            
            var startDateValue = document.getElementById('data-inizio-asta').value;
            var endDateValue = document.getElementById('data-fine-asta').value;
            
            // Verifica che la data di fine non sia precedente alla data di inizio
            if (new Date(endDateValue) < new Date(startDateValue)) {
                alert("La data di fine asta non può essere precedente alla data di inizio asta.");
                event.preventDefault(); // Blocca l'invio del form
            }
        });
<?php echo '</script'; ?>
><?php }
}
