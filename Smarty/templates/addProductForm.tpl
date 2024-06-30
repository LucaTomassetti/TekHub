
    {if $errorImageUpload == 1}
        <div class="mt-5">
            <div class="alert alert-danger" role="alert">
                Errore nell'upload delle immagini! Size troppo grande o tipo del file diverso da jpeg/png !
            </div>
        </div>
    {/if}

<div class="form-container width-90">
        <h2>Metti in vendita un prodotto</h2>
        <form id="registrationForm" method="POST" action="/TekHub/utente/addProduct" enctype="multipart/form-data">
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
                    <select name="categoria" id="categoria" class="form-control" required>
                        <option value="Smartphone">Smartphone</option>
                        <option value="Notebook">Notebook</option>
                        <option value="TV">TV</option>
                        <option value="PC fisso">PC fisso</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="images">Aggiungi un massimo di 10 immagini:</label>
                    <input name="images[]" type="file" multiple required>
                </div>
                <div class="form-group price-for-new">
                    <label for="price">Prezzo</label>
                    <input type="text" name="pricefornew" id="pricefornew" placeholder="€####">
                </div>
            </div>

            <div class="right-column">
                <fieldset>
                    <legend>Specifice dell'oggetto</legend>

                    <label for="brand">Marca</label>
                    <input type="text" name="brand" id="brand" required>

                    <label for="model">Modello</label>
                    <input type="text" name="model" id="model" required>

                    <label for="quantity">Quantità</label>
                    <input type="number" name="quantita_disp" id="quantita_disp" required>

                    <label for="color">Colore</label>
                    <input type="text" name="color" id="color" required>
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
                    <input type="text" name="prezzo-asta" id="prezzo-asta" placeholder="Inserisci prezzo di partenza...">
                </div>
                <div class="form-group data-asta">
                    <label for="auction_date">Data fine asta</label>
                    <input type="text" name="data-asta" id="data-asta" placeholder="es. 10/05/2024">
                </div>

                <button type="submit" class="btn btn-primary">Aggiungi</button>
            </div>

        </form>
    </div>