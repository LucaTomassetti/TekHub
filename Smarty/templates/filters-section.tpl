
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
                                <option value="1">Indifferente</option>
                                <option value="2">Categoria 2</option>
                                <option value="3">Categoria 3</option>
                                <option value="4">Categoria 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="marcaFilter">Marca</label>
                            <select id="marcaFilter" class="form-control">
                                <option value="1">Indifferente</option>
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
            <script>
                function updatePriceValue(value) {
                    const priceValue = document.getElementById('priceValue');
                    priceValue.textContent = value+"€";
                    if(priceValue.textContent == "5000€"){
                        priceValue.textContent = value+"€ e più";
                    }
                }
            </script>