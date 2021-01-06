# Progetto Vacanze
## Cos'è questo?
Questo è il repo GitHub su cui è hostato il progetto di **Giura Alessio Donato, Carchia Bruno, Grasso Mario, Serluca Noemi, Trofimets Antonio** [V B S.A. @ __Liceo Pietro Paolo Parazese__, A. S. 2020/21] per le vacanze di Natale, sui databases.

## Cosa contiene?
Su questo repo vi sono diversi file, tra cui:
* la cartella `Risorse` con tutte le risorse (le immagini incorporate in questo README.md, i modelli fisico e logici in formato pdf, queries SQL per la creazione di tabelle in PHPMyAdmin);
* il file `README.md` (che state leggendo già ora), attraverso il quale si presenta il lavoro svolto e si risponde alle consegne del lavoro;
* la cartella `PHP`, con una demo di un programma che implementa i databases appena creati;
* file vari per la gestione del repo, necessari per clonarlo ed eseguire la demo.

# Analisi della situazione
## Cosa è rappresentato nel db?
Attraverso questo lavoro, andiamo a rappresentare l'intera struttura di un hotel, tenendo conto di due fattori:
* ciò che riguarda le relazioni con il pubblico (clienti, prenotazioni);
* ciò che riguarda la struttura organizzativa di un albergo (gestione dei dipendenti, stanze, piani).
Mediante questo database, andiamo a salvare i dati necessari ogni cliente (generalità anagrafiche e recapiti) che effettua una prenotazione, di cui andiamo a salvare tutti gli estremi (il codice, da chi è stata effettuata e quando, la durata del pernottamento, quale stanza viene assegnata); analogamente, ci conviene raccogliere i dati dei dipendenti per avere un quadro completo dell'organico (generalità, salario, informazioni sui tuni lavorativi, recapiti) e ciò che è affine alle stanze, come ad esempio dettagli su quando viene pulita settimanalmente, se è occupata o meno e da chi, su quale piano si trova, qual è la tariffa di base per quella stanza in base agli optional presenti al piano.
Attraverso questo database intendiamo, quindi, semplificare la gestione di un albergo per agevolare la gestione delle prenotazioni.

## Tabelle
Quindi, andiamo a creare le tabelle:
* Clienti:
attraverso questa tabella raccogliamo il codice fiscale (chiave primaria, ogni codice fiscale identifica in modo univoco ogni persona), nome, cognome, sesso, la data di nascita, il luogo di nascita e il percorso nella rete locale dell'albergo della scansione del documento di identità.

*Il cliente `effettua` almeno una **prenotazione** [associazione  1, N]*

* Prenotazioni:
qui salviamo il codice della prenotazione (chiave primaria), in modo da individuare in modo univoco ogni prenotazione [per far sì che sia univoco, si può creare un criterio che prevede, ad esempio, di concatenare il codice fiscale del cliente con il codice della stanza o, in alternativa, con il riferimento temporale relativo alla data in cui viene effettuata la prenotazione], data di inizio e data di fine della prenotazione, il costo della prenotazione, il mezzo con cui la prenotazione viene saldata (carta o contanti) e dei riferimenti presi da altre tabelle [Foreign keys], come da chi viene affettuata la prenotazione (si riferisce al codice fiscale del cliente), da chi viene lavorata la prenotazione (l'id del dipendente) e la stanza che viene assegnata a quella prenotazione (il codice univoco della stanza);

*Un **dipendente** `prende` in carico e lavora una prenotazione [associazione 1, N]*

* Dipendenti:
torna utile avere una panoramica dell'organico/personale, di cui salviamo l'id del lavoratore [primary key, può corrispondere al numero del badge di accesso o al codice fiscale], il nome, il cognome, l'email qualora bisogni inviare qualche comunicazione, gli estremi temporali (inizio e fine) di ogni turno lavorativo, lo stipendio e il giorno libero nella settimana

*Ogni prenotazione `contiene` una **stanza** [associazione 1, 1]:

* Stanze:
qui raccogliamo il codice univoco della stanza [primary key], la capienza della stanza e la foreign key dell'id del piano, per poterla localizzare nella struttura

*Ogni **piano** `ha` almeno una stanza [associazione 1, N]*:

* Piani:
del piano ci serve sapere l'id, che può corrispondere al livello della struttura, la tariffa di base della stanza in base agli optional presenti su quel piano e il giorno della settimana in cui si puliscono tutte le camere del piano abitualmente

Abbiamo costruito lo schema concettuale (diagramma ER):

![modello concettuale](https://i.imgur.com/mnGfvc9.png)


## Vincoli di integrità
Abbiamo individuato 10 vincoli di integrità tra i vari attributi:
*N.B: tutti gli attribuiti posseggono il vincolo implicito `NOT NULL`, in quanto abbiamo ritenuto che nessun campo della tabella possa assumere un valore nullo.*
* `V1 : ( Prenotazioni.costo_totale_da_pagare > 0 );`:
Il costo della prenotazione non può essere minore od uguale di zero [euro], altrimenti l'albergo non avrebbe nemmeno entrate lorde!

* `V2 : ( Dipendenti.stipendio > 0 );`:
Analogamente a quanto avviene per la prenotazione, il salario di un dipendente non può essere minore od uguale a zero [euro], altrimenti sarebbe una prassi simile allo sfruttamento!

* `V3 : ( DATEDIFF( now(), Clienti.data_di_nascita) >= ( 18 * 365 ) )`: 
Attraverso la funzione di SQL `DATEDIFF()`, calcoliamo la differenza in giorni tra due date; applichiamo questa funzione sulla data di nascita del cliente e verifichiamo che abbia almeno diciotto anni, l'età minima secondo la legislazione italiana per prenotare una camera d'albergo.

* `V4 : ( Dipendenti.data_fine_turno > Clienti.data_inizio_turno ))`:
Ci assicuriamo che la data di fine della prenotazione non sia antecendente alla data di inizio prenotazione; sarebbe impossibile far terminare una prenotazione ancor prima che essa inizi.

* `V5 : ( Prenotazioni.data_fine_prenotazione > Prenotazioni.data_inizio_prenotazione )`:
Ci assicuriamo che la data di fine della prenotazione non sia antecendente alla data di inizio prenotazione; sarebbe impossibile far terminare una prenotazione ancor prima che essa inizi.

* `V6 : ( LOCATE(‘.pdf’ ,Clienti.immagine_documento_scannerizzato) != 0)`:
Attraverso questo costrutto, ci assicuriamo che il documento di identità scannerizzato abbia estensione .pdf.

* `V7 : ( Stanze.capienza_massima > 0 )`:
La capienza massima di ciascuna stanza non può essere minore od uguale a zero, altrimenti non ci sarebbe spazio per nessun ospite!

* `V8 : (Piani.costo_base_stanza_24h > 0 )`:
Il costo di base (anche tariffa) di una stanza, a prescindere dagli optional presenti sul piano non può, in ogni modo, essere uguale o minore di zero [euro], altrimenti nessuna stanza frutterebbe entrate lorde all'albergo!

* `V9 : ( LOCATE("@", Dipendenti.email ) != 0) ) `:
Adoperando la funzione `LOCATE()`, possiamo effettuare un controllo all'interno dell'email che ci consente di trovare il carattere '@', per assicurarci che l'indirizzo email abbia un formato corretto.
Questo vincolo si riferisce all'attributo `email` della tabella `Dipendente`.

* `V10 : ( LOCATE("@", Clienti.email ) != 0) ) `:
Allo stesso modo di come abbiamo fatto nel vincolo precedente, effettuiamo lo stesso controllo per l'attributo `email` ma per i record nella tabella `Clienti` questa volta.

## Tipi dati usati
*Tabella Clienti*:
* `codiceFiscale` è una sequenza alfanumerica: la rappresentiamo mediante il tipo `VARCHAR` di lunghezza 16 caratteri, esattamente tanti quanti quelli richiesti da un codice fiscale;
* `nome`, `cognome`, `luogoNascita`, `email` sono campi composti da una sequenza alfanumerica: scegliamo il tipo dato `VARCHAR` con una lunghezza di 100 caratteri, in quanto sono dati non eccessivamente lunghi;
* `immagine_documento_scannerizzato` è il percorso di un file che, analogamente ai campi sopra citati, è rappresentato da una sequenza di caratteri alfa-simbolico-numerica; anche in questo caso, si può ricorrere al tipo `VARCHAR` ma, dal momento in cui il path di un file può essere piuttosto lungo, aumentiamo la lunghezza a 250 caratteri, il massimo per questo tipo dato in SQL; 
* `data_di_nascita` è una data, che può essere rappresentata in SQL con il tipo dato `DATE` (ci consente di raccogliere in un unico attributo giorno, mese ed anno);
* `numero_telefono` è il recapito telefonico, cellulare, di un cliente; non sappiamo la quantità di numeri da aspettarci in quanto l'ospite potrebbe provenire da un diverso stato , di conseguenza non imponiamo un vincolo
* `sesso`: una persona (non tenendo conto delle definizione non-binarie dei sessi) può essere di sesso maschile o femmile: possiamo scegliere quindi il tipo dato `ENUM` che ci consente di inserire un vincolo implicito: questo campo può essere riempito solo con il valore *m* o *f*-

*Tabella Piani*:
* `id` è un identificatore universale utilizzato formalmente per rendere univoco ogni record; si tratta di un `INTEGER` che viene incrementato automaticamente di riga in riga, di 1 unità
* `costo_base_stanza_24`: la tariffa di base di una stanza non deve, necessariamente, corrispondere ad un importo intero e, per questo, ricorriamo al tipo `FLOAT`; in questo caso, abbiamo a disposizione, eventualemente, 7 cifre intere e 3 cifre decimali, il che ci consentirebbe di fare eventuali dovuti arrotondamenti;
* `giorno_pulizie` è il singolo giorno della settimana in cui viene effettuata la pulizia di tutte le camere, occupate o non, in tutto il piano; dal momento in cui si tratta di un singolo giorno della settimana, possiamo scegliere il tipo `ENUM`: il campo potrà essere riempito con il nome del giorno della settimana desiderato.

*Taabella Stanze*:
* `codiceStanza` è un `INTEGER` che viene incrementato di riga in riga; ha funzione analoga a `Piani.id`;
* `capienza_massima` può essere rappresentato da un numero intero, in quanto una persona può essere contenuta interamente o, alternativamente, per nulla in una camera; il tipo dato scelto è quindi `INTEGER`.

*Tabella Prenotazioni*:
* `codicePrenotazione` lo rappresentiamo mediante un numero intero e scegliamo il tipo `INTEGER`;
* `data_inzio_prenotazione` e `data_fine_prenotazione` sono entrambi due date, di cui andiamo andare a raccogliere anche l'ora per check-in e il check-out e scegliamo il tipo `DATETIME`;
* `costo_totale_da_pagare` non necessariamente è intera come somma, quindi optiamo per il tipo `FLOAT`, con 8 cifre intere e due decimali;
* `mezzo_di_pagamento` può essere carta o contante ed optiamo per il tipo `ENUM` con le due possibilità appena citate.

*Tabella Dipendenti*:
* `nome`, `cognome`, `email`, `numero_telefono` seguono lo stesso dictat dei rispettivi nella tabella `Clienti`: scegliamo il tipo `VARCHAR` con lunghezza 100 per `nome` e `cognome`, `VARCHAR` con lunghezza 150 per `email`, `INTEGER` con OdG 9 per `numero_telefono`;
* `data_inizio_turno` e `data_fine_turno` sono date di cui ci interessa salvare anche l'orario e scegliamo il tipo `DATETIME`;
* `giorno_settimanale_festivo` è uno per settimana e possiamo sfruttare il tipo `ENUM` per indicare il nome giorno della settimana;
* `stipendio` non è necessariamente una cifra intera e la rappresentiamo mediante un attributo di tipo `FLOAT` con 8 cifre intere e 2 decimali.


# Modello fisico e logico
![generati da phpmyadmin](https://i.imgur.com/rJpETqQ.png)
Per mezzo di PhpMyAdmin abbiamo realizzato un modello unico che racchiuda sia le informazioni del modello fisico che logico. Difatti abbiamo specificato le relazioni tra le varie tabelle per mezzo di **Foreign Key** e di **Primary Key** e la **tipizzazione dei dati** , dando per implicito il fatto che siano tutti richiesti. 
### Descrizione
*Modello Logico* è il seguente:
* Clienti ( codiceFiscale ,nome, cognome, data_di_nascita,luogoNascita, sesso , immagine_documento_scannerizzato, numero_telefono,email )
* Piani ( id , costo_base_stanza24h , giorno_pulizie )
* Stanze ( codiceStanza , capienza_massima ,**piano** )
    * FK : piano → Piani → id
* Dipendenti ( id , stipendio , giorno_settimanale_festivo , nome , cognome , email ,data_inizio_turno, data_fine_turno )
* Prenotazioni ( codicePrenotazione , **effettuataDa** , **codiceStanza**, data_inizio_prenotazone , data_fine_prenotazione , costo_totale_da_pagare , **prenotazionePresaDa** , mezzo_di_pagamento ) 
     *  FK : effettuataDa → Clienti → codiceFiscale ;
     *  FK : codiceStanza → Stanze → codiceStanza; 
     *  FK : prenotazionePresaDa  → Dipendenti → id;

*Modello Fisico* è il seguente: 
[Click per aprire.](https://docs.google.com/document/d/1RtvWrxvSnwynyRu9r80vmf9DQGJqRmg0ZO0YQxk06R4/edit?usp=sharing)

*Modello Logico* è il seguente:
[Click per aprire.](https://docs.google.com/document/d/1bXvJ-hhxGYCI4qzMHaf7Hb1Cin-xGO2dTw-dzgIYeUw/edit?usp=sharing)
## Creazione del database con PHPMyAdmin
![phpmyadmin](https://i.imgur.com/LF7JQ7s.png)


## Punto bonus: realizzazione database mediamente codice PHP
In aggiunta alla tabella creata manualmente mediante queries SQL su PHPMyAdmin, il nostro gruppo ha deciso di implementare un programma PHP in grado di collegarsi in remoto al database e creare le tabelle o modificarle qualora esistano già. Tale codice è nella cartella  `PHP` del repository e ci consente di ottenere un risultato del tutto identico alla realizzazione mediante queries SQL da XAMPP.


_Nessun membro di StackOverflow è stato violentato per la realizzazione di questo programma._
