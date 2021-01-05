# Progetto Vacanze
Le immagini si inseriscono con (sia tramite link che tramite path locale (path da verificare))
## Cos'è questo?
Questo è il repo GitHub su cui è hostato il progetto di **Giura Alessio Donato, Carchia Bruno, Grasso Mario, Serluca Noemi, Trofimets Antonio** [V B S.A. @ __Liceo Pietro Paolo Parazese__, A. S. 2020/21] per le vacanze di Natale, sui databases.

## Cosa contiene?
Su questo repo vi sono diversi file, tra cui:
* la cartella `Risorse` con tutte le risorse (schemi, immagini...);
* il file `README.md` (che state leggendo già ora), attraverso il quale si presenta il lavoro svolto e si risponde a consegne non strettamente pratiche attinenti al lavoro. In questo file, sono, ad ogni modo, inclusi tutti i file presenti in risorse (salvo se non opportunamente specificato);
* la cartella `PHP`, con una demo di un programma che implementa i databases appena creati;
* file vari per la gestione del repo, necessari per clonarlo ed eseguire la demo.

# Analisi della situazione
## Cosa è rappresentato nel db?
Attraverso questo lavoro, andiamo a rappresentare l'intera struttura di un hotel, tenendo conto di due fattori:
* ciò che riguarda le relazioni con il pubblico (clienti, prenotazioni, stanze);
* ciò che riguarda la struttura organizzativa di un albergo (pulizie, gestione dei dipendenti, tracciamento profitti).

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
del piano ci serve sapere l'id, che può corrispondere al livello della struttura, costoBaseStanza24??? e il giorno della settimana in cui si puliscono tutte le camere del piano abitualmente

Abbiamo costruito lo schema concettuale (diagramma ER):

![modello concettuale](https://i.imgur.com/mnGfvc9.png)


## Vincoli di integrità
Abbiamo individuato 10 vincoli di integrità tra i vari attributi:
* `V1 : ( Prenotazioni.costo_totale_da_pagare > 0 );`:
Il costo della prenotazione non può essere minore od uguale di zero [euro], altrimenti l'albergo non avrebbe nemmeno entrate lorde!

* `V2 : ( Dipendenti.stipendio > 0 );`:
Analogamente a quanto avviene per la prenotazione, il salario di un dipendente non può essere minore od uguale a zero [euro], altrimenti sarebbe una prassi simile allo sfruttamento!

* `V3 : ( DATEDIFF( now(), Clienti.data_di_nascita) >= ( 18 * 365 ) )`: 
Attraverso la funzione di SQL `DATEDIFF`, calcoliamo la differenza in giorni tra due date; applichiamo questa funzione sulla data di nascita del cliente e verifichiamo che abbia almeno diciotto anni, l'età minima secondo la legislazione italiana per prenotare una camera d'albergo.

* `V4 : ( Dipendenti.data_fine_turno > Clienti.data_inizio_turno ))`:
Ci assicuriamo che la data di fine della prenotazione non sia antecendente alla data di inizio prenotazione; sarebbe impossibile far terminare una prenotazione ancor prima che essa inizi.

* `V5 : ( Prenotazioni.data_fine_prenotazione > Prenotazioni.data_inizio_prenotazione )`:
Ci assicuriamo che la data di fine della prenotazione non sia antecendente alla data di inizio prenotazione; sarebbe impossibile far terminare una prenotazione ancor prima che essa inizi.

* `V6 : ( LOCATE(‘.pdf’ ,Clienti.immagine_documento_scannerizzato) != 0)`:
Attraverso questo costrutto, ci assicuriamo che il documento di identità scannerizzato abbia estensione .pdf.

* `V7 : ( Stanze.capienza_massima > 0 )`:
La capienza massima di ciascuna stanza non può essere minore od uguale a zero, altrimenti non ci sarebbe spazio per nessun ospite!

* `V8 : (Piani.costo_base_stanza_24h > 0 )`:


* `V9 : ( LOCATE(“@’’ ,Dipendenti.email ) != 0) ) `:


* `V10 : ( LOCATE(“@’’ ,Clienti.email ) != 0) ) `:


_Nessun membro di StackOverflow è stato violentato per la realizzazione di questo programma._
