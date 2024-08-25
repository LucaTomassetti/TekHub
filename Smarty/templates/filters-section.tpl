
            <!-- Filter Section -->
                <div class="form-container">
                <form method="GET" action="/TekHub/{if $check_login_venditore == 1 || $check_login_admin}gestioneProdotti{else}gestioneAcquisto{/if}/{if $check_login_venditore == 1 || $check_login_admin}listaProdotti{else}shop{/if}" id="filterForm">
                    <input type="hidden" name="query" id="hiddenQuery" value="{$filtri_applicati.query}">
                <h2>Sezione filtri</h2>
                <div class="form-group">
                    <label for="categoryFilter">Categoria</label>
                    <select id="categoryFilter" name="categoria" class="form-control">
                        <option value="">Tutte le categorie</option>
                        {foreach from=$array_categorie item=categoria}
                        <option value="{$categoria.nome_categoria}" {if $filtri_applicati.categoria == $categoria.nome_categoria}selected{/if}>{$categoria.nome_categoria}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label for="marcaFilter">Marca</label>
                    <select id="marcaFilter" name="marca" class="form-control">
                        <option value="">Tutte le marche</option>
                        {foreach from=$marche item=marca}
                        <option value="{$marca}" {if $filtri_applicati.marca == $marca}selected{/if}>{$marca}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label for="priceRange">Prezzo massimo: <span id="priceValue">€{if isset($smarty.get.prezzo_max)}{$smarty.get.prezzo_max}{else}5000{/if}</span></label>
                    <input type="range" class="form-control-range" id="priceRange" name="prezzo_max" min="0" max="5000" value="{if isset($smarty.get.prezzo_max)}{$smarty.get.prezzo_max}{else}5000{/if}" oninput="updatePriceValue(this.value)">
                </div>
                <div class="form-group">
                    <label>Condizione</label>
                    <div class="form-check">
                        <input type="checkbox" name="condizione[]" value="nuovo" {if in_array('nuovo', $filtri_applicati.condizione)}checked{/if}>
                        <label class="form-check-label" for="nuovoCheck">Nuovo</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="condizione[]" value="usato" {if in_array('usato', $filtri_applicati.condizione)}checked{/if}>
                        <label class="form-check-label" for="usatoCheck">Usato (in asta)</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Applica filtri</button>
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
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Trova l'input di ricerca nella barra di navigazione
                var searchInput = document.querySelector('input[name="query"]');
                var hiddenQuery = document.getElementById('hiddenQuery');
                var filterForm = document.getElementById('filterForm');
            
                // Aggiorna il valore nascosto quando l'utente digita nella barra di ricerca
                searchInput.addEventListener('input', function() {
                    hiddenQuery.value = this.value;
                });
            
                // Aggiorna il valore nascosto prima dell'invio del form
                filterForm.addEventListener('submit', function() {
                    hiddenQuery.value = searchInput.value;
                });
            });
            </script>