
{if $errorImageUpload == 1}
    <div class="mt-5">
        <div class="alert alert-danger" role="alert">
            Errore nell'upload delle immagini! Size troppo grande o tipo del file diverso da jpeg/png !
        </div>
    </div>
{/if}

<div class="form-container width-90">
    <h2>Modifica il prodotto</h2>
    <form class="registrationForm" id="modifyProductForm" method="POST" action="/TekHub/gestioneProdotti/modificaProdotto/{$productId}" enctype="multipart/form-data">
        <div class="left-column">
            <div class="form-group">
                <label>Titolo prodotto</label>
                <input name="nome" type="text" class="form-control" id="nome" value="{$nomeProdotto}" placeholder="Nome..." required>
            </div>
            
            <div class="form-group">
            <label>Descrizione</label>
            <br>
                <textarea name="descrizione" id="description" rows="10" cols="57" required>{$descrizione}</textarea>
            </div>
            <div class="form-group">
            <label>Categoria</label>
                <select name="categoria" id="categoria" class="form-control" disabled>
                    <option value="{$categoria}">{$categoria}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="images">Aggiungi al massimo 10 immagini (le immagini attuali saranno eliminate) :</label>
                    <input id="images" name="images[]" type="file" multiple>
            </div>

            <div class="image-preview" id="imagePreview">
                {foreach from=$immagini item=immagine}
                    <div class="image-container">
                        <img src="data:{$immagine.type};base64,{$immagine.imageData}" alt="Immagine">
                        <button type="button" class="remove-button">Immagine attuale</button>
                    </div>
                {/foreach}
            </div>

        </div>

        <div class="right-column">
            <fieldset>
                <legend>Specifice dell'oggetto</legend>

                <label for="brand">Marca</label>
                <input type="text" name="marca" id="brand" value="{$marca}" required>

                <label for="model">Modello</label>
                <input type="text" name="modello" id="model" value="{$modello}" required>

                {if $isProdottoNuovo == 1}
                <label for="quantity">Quantità</label>
                <input type="number" name="quantita_disp" value={$quantita_disp} min="1" step="1" id="quantita_disp" required>
                {/if}
                <label for="color">Colore</label>
                <input type="text" name="colore" id="color" value="{$colore}" required>
            </fieldset>

            {if $isProdottoNuovo == 1}
                <div class="form-group">
                    <label for="price">Prezzo</label>
                    <input type="number" name="prezzo-nuovo" id="pricefornew" value={$prezzo_fisso} min="1" step="0.01" placeholder="€####" required>
                </div>
            {elseif $isProdottoNuovo == 0}
                <div class="form-group">
                    <label for="starting_price">Prezzo di partenza</label>
                    <input type="text" id="prezzo-asta" value={$floor_price} min="1" step="0.01" disabled>
                </div>
                <div class="form-group">
                    <label for="auction_date">Data inizio asta</label>
                    <input type="text" id="data-inizio-asta-mod" value="{$data_inizio_asta}" pattern="^(\d\d\d\d)-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]) ([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$" disabled>
                </div>
                <div class="form-group">
                    <label for="auction_date">Data fine asta</label>
                    <input type="text" name="data-fine-asta" id="data-fine-asta-mod" value="{$data_fine_asta}" pattern="^(\d\d\d\d)-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]) ([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$" placeholder="YYYY-MM-DD HH:MM:SS" required>
                </div>
            {/if}

            <button type="submit" class="btn btn-primary">Modifica</button>
        </div>

    </form>
</div>
<script>
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
</script>
<script>
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
</script>