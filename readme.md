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
* clienti:
attraverso questa tabella raccogliamo il codice fiscale (chiave primaria, ogni codice fiscale identifica in modo univoco ogni persona), nome, cognome, sesso, la data di nascita, il luogo di nascita e il percorso nella rete locale dell'albergo della scansione del documento di identità.

*Il cliente `effettua` almeno una **prenotazione** [associazione  1, N]*

* prenotazioni:
qui salviamo il codice della prenotazione (chiave primaria), in modo da individuare in modo univoco ogni prenotazione [per far sì che sia univoco, si può creare un criterio che prevede, ad esempio, di concatenare il codice fiscale del cliente con il codice della stanza o, in alternativa, con il riferimento temporale relativo alla data in cui viene effettuata la prenotazione], data di inizio e data di fine della prenotazione, il costo della prenotazione, il mezzo con cui la prenotazione viene saldata (carta o contanti) e dei riferimenti presi da altre tabelle [Foreign keys], come da chi viene affettuata la prenotazione (si riferisce al codice fiscale del cliente), da chi viene lavorata la prenotazione (l'id del dipendente) e la stanza che viene assegnata a quella prenotazione (il codice univoco della stanza);

*Un **dipendente** `prende` in carico e lavora una prenotazione [associazione 1, N]*

* dipendenti:
torna utile avere una panoramica dell'organico/personale, di cui salviamo l'id del lavoratore [primary key, può corrispondere al numero del badge di accesso o al codice fiscale], il nome, il cognome, l'email qualora bisogni inviare qualche comunicazione, gli estremi temporali (inizio e fine) di ogni turno lavorativo, lo stipendio e il giorno libero nella settimana

*Ogni prenotazione `contiene` una **stanza** [associazione 1, 1]:

* stanze:
qui raccogliamo il codice univoco della stanza [primary key], la capienza della stanza e la foreign key dell'id del piano, per poterla localizzare nella struttura

*Ogni **piano** `ha` almeno una stanza [associazione 1, N]*:

* piani:
del piano ci serve sapere l'id, che può corrispondere al livello della struttura, costoBaseStanza24??? e il giorno della settimana in cui si puliscono tutte le camere del piano abitualmente

*Lo stipendio dei lavoratori e le entrate dalle prenotazioni `formano` il **bilancio** [Associazione ?]*:

* tracciamentiEconomiciMensili:
In questa tabella raccogliamo tutto ciò che riguarda il bilancio, mese per mese; assegniamo un id al mese (può essere assegnato magari concatenando il numero del mese con l'anno di riferimento), si annotano entrate, spese, guadagno, il mese e l'anno.

Abbiamo costruito lo schema concettuale (diagramma ER):
![modello concettuale](<blockquote class="imgur-embed-pub" lang="en" data-id="a/Ckm8Cjw" data-context="false" ><a href="//imgur.com/a/Ckm8Cjw"></a></blockquote><script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>)



_Nessun membro di StackOverflow è stato violentato per la realizzazione di questo programma._
