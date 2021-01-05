# Implementazione di un database in PHP
Bruno e Alessio hanno riprodotto utilizzando PHP e in particolare la sua OOP delle classi per permettere di lavorare con un database

## Cosa è stato utilizzato? 
Avendo Bruno esperienza con Laravel abbiamo utilizzato come libreria vlucas, il quale permette lo storage delle informazioni in un file .env , segreto.
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
