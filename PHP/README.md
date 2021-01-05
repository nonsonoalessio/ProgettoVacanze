# Implementazione di un database in PHP
`Bruno` e `Alessio` hanno riprodotto utilizzando PHP e in particolare la sua OOP delle classi per permettere di lavorare con un database

## Cosa è stato utilizzato? 
Avendo `Bruno` esperienza con Laravel abbiamo utilizzato come libreria vlucas, il quale permette lo storage delle informazioni in un file .env , segreto.
La restante parte del progetto è puro codice scritto a mano.

## Struttura del progetto
* PHP 
  * app : cartella centrale dello sviluppo
    * methodsDb : qui troviamo i metodi del database per poter effettuare delle query
    * traits : cartella dove troviamo ramificate le varie funzioni utilizzate, rendendo il codice più leggibile
    * app.php : è l'applicazione dove avviene il bootstrap delle chiamate , richiama tutti i file necessari.
  * config : cartella delle impostazioni 
    * database : file in cui abbiamo le informazioni sensibili del db
    * tables : le tabelle che verranno create
  * vendor : cartella che contiene le librerie utilizzate 
  * .env.example :  semplice file di testo da cui prendere spunto per creare il proprio file .env
  * .env :  file da creare manualmente in cui inserire le informazioni per connettersi al db
  * composer.json : insererire le librerie da installare mediante il comando `composer install`
  * main.php : è il file da aprire per poter permettere l'avviamento dell'intera applicazione

## Decentramento
E' stata la **parola chiave** del nostro progetto, il nostro file principale utilizza una sola stringa , il secondo file di decentramento poco più di 10.
Come in un progetto o in un framework dalle grandi ambizioni abbiamo ragionato rendendo più pulito il nostro codice dividendolo in classi e sottoclassi ( è stata utilizzato PDO difatti per la connesione al database). Un esempio è appunto la cartella `config/tables.php` in cui , mediante funzioni statiche , sono state implementate le tabelle, ottenendo un codice chiaro e leggibile ma allo stesso tempo sicuro.
Di seguito un estratto :
```php
 'clienti' => [

            'nome' =>  DB::Varchar() . DB::NotNull(), 
            'cognome' => DB::Varchar() . DB::NotNull(),
            'data_di_nascita' => DB::Date() . DB::NotNull() . DB::CheckDateDiff('data_di_nascita',18),
            'codiceFiscale' => DB::Varchar() . DB::PrimaryKey(),
            'luogoNascita' => DB::Varchar() . DB::NotNull(),
            'sesso' => DB::Enum(['m' , 'f']) . DB::NotNull(),
            'numero_telefono' => DB::Integer(10),
            'email' => DB::Varchar(150) . DB::CheckIfIn('@','email'),
            'immagine_documento_scannerizzato' => DB::Varchar(200) . DB::NotNull() . DB::CheckIfIn('.pdf','immagine_documento_scannerizzato')

    ],  
```

## Funzioni Statiche del Database
Come possiamo notare tutte gli attributi delle varie colonne vengono specificate mediante la classe `DB` , la quale ritorna gli attributi desiderati.
Notiamo per esempio la funzione **CheckIfIn** , la quale specifica un **vincolo esplicito** per la colonna/tupla : deve contenere il simbolo @ per essere valido.

## Mind-set

Nel momento in cui viene avviato il file main.js e l'utente ha creato manualmente il file .env attingendo dal file .env.example la richiesta viene spedita al file `app.php` il quale avvia la creazione delle tabelle: 
* La funzione statica prende in esame le tabelle create nel `config` e vengono definite come stringhe
* Questa stringa viene eseguita da `executeQuery` che provvede a ottenere un pointer per la connessione al db
* La connessione avviene mediante la tecnologia `PDO` che ottiene tutti i database sul server e cerca quello specificato dall'utente nel file .env
* Semmai non ci fosse allora ne crea uno tutto suo e rimanda il pointer alla funzione `executeQuery` la quale aziona la query e crea le tabelle

