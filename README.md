# Documentazione del progetto TekHub

## Panoramica
![Screenshot 2024-09-06 231229](https://github.com/user-attachments/assets/4df01e92-1de5-4e7d-af7b-3bf1ba071108)

TekHub è una piattaforma di e-commerce specializzata in prodotti tecnologici, che offre sia la vendita diretta di prodotti nuovi che un sistema di aste per prodotti usati. La piattaforma supporta diversi tipi di utenti e offre una vasta gamma di funzionalità per gestire prodotti, ordini, aste e interazioni tra utenti.

## Tipi di utenti

1. **Acquirente**: Può acquistare prodotti, partecipare alle aste, gestire il proprio profilo, scrivere le recensioni e visualizzare lo storico degli ordini.
2. **Venditore**: Può mettere in vendita prodotti nuovi, gestire le aste per prodotti usati, rispondere o segnalare le recensioni e gestire gli ordini ricevuti.
3. **Admin**: Ha accesso a funzionalità di gestione avanzate per prodotti, utenti e segnalazioni.
4. **Utente non registrato**: Può visualizzare i prodotti e recensioni ma deve registrarsi per effettuare acquisti.

## Funzionalità principali

### Per tutti gli utenti:
- Registrazione e login
- Visualizzazione dei prodotti e ricerca avanzata
- Visualizzazione delle informazioni dettagliate dei prodotti
- Visualizzazione delle recensioni scritte dagli altri utenti sui prodotti

### Per Acquirenti:
- Aggiunta di prodotti al carrello
- Gestione del carrello (aggiunta, rimozione, modifica quantità)
- Completamento degli ordini
- Partecipazione alle aste effettuando offerte per prodotti usati
- Gestione del profilo personale
- Visualizzazione dello storico ordini
- Recensioni solo per i prodotti acquistati
- Aggiunta e gestione di indirizzi di spedizione
- Aggiunta e gestione di carte di credito

### Per Venditori:
- Aggiunta di nuovi prodotti nuovi
- Gestione del catalogo prodotti (modifica, eliminazione)
- Creazione e gestione di aste per prodotti usati
- Gestione degli ordini ricevuti
- Aggiornamento dello stato degli ordini

### Per Admin:
- Gestione completa dei prodotti
- Gestione degli utenti
- Gestione delle segnalazioni

## Interfacce principali

1. **Homepage**: Mostra prodotti in evidenza, categorie e barra di ricerca.
2. **Pagina di login/registrazione**: Per l'accesso e la creazione di nuovi account.
3. **Catalogo prodotti**: Visualizzazione di tutti i prodotti con opzioni di filtro.![Screenshot 2024-09-06 231258](https://github.com/user-attachments/assets/20a17447-657c-4bc2-99cd-eff37cb1b0a0)
4. **Pagina dettaglio prodotto**: Informazioni complete sul prodotto, opzioni di acquisto o partecipazione all'asta.
5. **Carrello**: Riepilogo dei prodotti selezionati per l'acquisto.![Screenshot 2024-09-06 231351](https://github.com/user-attachments/assets/8c1c4ce7-742c-4830-b17e-27ff2eb65ba7)
6. **Checkout**: Processo di finalizzazione dell'ordine.
7. **Profilo utente**: Gestione delle informazioni personali, indirizzi e carte di credito.
8. **Dashboard venditore**: Gestione dei prodotti e degli ordini per i venditori.
9. **Dashboard amministrazione**: Interfaccia per le funzionalità admin.


## Struttura del progetto

Il progetto segue un'architettura MVC (Model-View-Controller) e utilizza la libreria Smarty per la gestione dei template e Doctrine come ORM. Ecco una panoramica dei principali componenti:

### Controllers:
- `CAsta`: Gestisce le funzionalità relative alle aste.
- `CFrontController`: Gestisce il routing delle richieste.
- `CGestioneAcquisto`: Gestisce il processo di acquisto e il carrello.
- `CGestioneOrdiniInAttesa`: Gestisce gli ordini dal lato venditore.
- `CGestioneProdotti`: Gestisce l'aggiunta e la modifica dei prodotti.
- `CGestioneSegnalazioni`: Gestisce le segnalazioni degli utenti.
- `CUtente`: Gestisce l'autenticazione e le funzionalità relative all'utente.

### Models:
- Varie classi per rappresentare entità mappate tramite Doctrine come `EAcquirente`, `EVenditore`, `EProdotto`, `EOrdine`, ecc.
- Classi Foundation centralizzate nel PersistentManager per l'interazione con il database, come `FAcquirente`, `FProdotto`, ecc.

### Views:
- `VAsta`: Vista per le funzionalità relative alle aste.
- `VGestioneAcquisto`: Vista per il processo di acquisto.
- `VGestioneOrdiniInAttesa`: Vista per la gestione degli ordini lato venditore.
- `VGestioneProdotti`: Vista per la gestione dei prodotti.
- `VUtente`: Vista per le funzionalità relative all'utente.

## Tecnologie utilizzate

- PHP per il backend
- MySQL per il database
- Smarty per il templating
- Doctrine per la gestione e mappatura delle classi entità nel DB
- HTML, CSS e JavaScript per il frontend
- Bootstrap per lo styling

## Sicurezza

- Autenticazione e autorizzazione basata su ruoli
- Hashing delle password
- Validazione degli input lato server
- Protezione contro SQL injection
