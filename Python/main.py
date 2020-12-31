# importo i vari moduli necessari
import os
import webbrowser
import time # (uso: time.sleep(value int | float))
import sqlite3
from sqlite3 import Error

# definisco alcune funzioni usate più in avanti
# prassi di code cleanup
def connessione(db_file):
    conn = None
    try:
        conn = sqlite3.connect(db_file)
        return conn
    except Error as e:
        print('Who-ops! C\'è stato un incidente.')
        print(e)
    return conn
def scritturaDati():
    class cliente:
        def __init__(self, nome, cognome, giornoNascita, meseNascita, annoNascita, luogoNascita, sesso, codiceFiscale, codiceStanza):
            self.nome = ''
            self.cognome = ''
            self.giornoNascita = 0
            self.meseNascita = 0
            self.annoNascita = 0
            self.codiceFiscale = ''
            self.codiceStanza = 0
            self.luogoNascita = ''
            self.sesso = ''
    class stanza:
        def __init__(self, codiceStanza, capienza, occupata, occupataDa):
            self.codiceStanza = 0
            self.capienza = 0
            self.occupata = False
            self.occupataDa = ''
    class prenotazione:
        def __init__(self, codicePrenotazione, effettuataDa, codiceStanza):
            self.codicePrenotazione = ''
            self.effettuataDa = ''
            self.codiceStanza = 0    
    print('Questa è la modalità di immissione dati.')
    time.sleep(1)
    print('Immettiamo quindi una nuova voce nel nostro database (ulteriori informazioni nella guida)')
    time.sleep(1)
    disponibilitàCF = 'n'
    nomeInput = input('Immettere nome del cliente: ')
    cognomeInput = input('Immettere cognome del cliente: ')
    giornoNascitaInput = input('Immettere giorno di nascita del cliente: ')
    try:
        giornoNascitaInput = int(giornoNascitaInput)
    except ValueError:
        print('Si è verificato un errore. E\' stato immesso un carattere non convertibile in intero')
    meseNascitaInput = input('Immettere mese di nascita del cliente, formato MM: ')
    try:
        meseNascitaInput = int(cliente.meseNascitaInput)
    except ValueError:
        print('Si è verificato un errore. E\' stato immesso un carattere non convertibile in intero')
    annoNascitaInput = input('Immettere anno di nascita del cliente: ')
    try:
        annoNascitaInput = int(annoNascitaInput)
    except ValueError:
        print('Si è verificato un errore. E\' stato immesso un carattere non convertibile in intero')
    sessoInput = input('Immettere sesso del cliente (scelte consentite: f/m o F/M): ')
    # vincolo di integrità
    disponibilitàCF = input('Si dispone del codice fiscale del cliente (s/n)?')
    while disponibilitàCF != 's' and disponibilitàCF != 'n':
        if disponibilitàCF == 's':
            codiceFiscaleInput = input('Immetti il codice fiscale del cliente: ')
        elif disponibilitàCF == 'n':
            codiceFiscaleInput = calcoloCF(nomeInput, cognomeInput, annoNascitaInput, giornoNascitaInput, sessoInput, meseNascitaInput, luogoNascitaInput)
        else:
            print('Scelta non valida.')
            disponibilitàCF = input('Si dispone del codice fiscale del cliente (s/n)?')
def letturaDati():
    print('Hello world')
def creazioneTabella(conn, create_table_sql):
    try:
        c = conn.cursor()
        c.execute(create_table_sql)
    except Error as e:
        print('Who-ops! C\'è stato un incidente.')
        print(e)
def main():
    database = r"Database\database.db"
    sql_create_cliente_table = """CREATE TABLE IF NOT EXISTS cliente (
        codiceFiscale text PRIMARY KEY,
        nome text NOT NULL,
        cognome text NOT NULL,
        giornoNascita integer NOT NULL,
        meseNascita integer NOT NULL,
        annoNascita integer NOT NULL,
        codiceStanza integer NOT NULL
    );"""
    sql_create_stanza_table = """CREATE TABLE IF NOT EXISTS stanza (
        codiceStanza integer PRIMARY KEY,
        capienza integer,
        occupata integer NOT NULL,
        occupataDa text,
        FOREIGN KEY (occupataDa) REFERENCES cliente (codiceFiscale)
    );"""
    sql_create_prenotazione_table = """CREATE TABLE IF NOT EXISTS prenotazione (
        codicePrenotazione text PRIMARY KEY,
        effettuataDa text NOT NULL,
        codiceStanza integer NOT NULL,
        FOREIGN KEY (effettuataDa) REFERENCES cliente (codiceFiscale),
        FOREIGN KEY (codiceStanza) REFERENCES stanza (codiceStanza)
    );"""
    conn = connessione(database)
    if conn != None:
        creazioneTabella(conn, sql_create_cliente_table)
        creazioneTabella(conn, sql_create_stanza_table)
        creazioneTabella(conn, sql_create_prenotazione_table)
    else:
        print('Who - OPS! Si è verificato un errore')
calcoloCF(nomeInput, cognomeInput, annoNascitaInput, giornoNascitaInput, sessoInput, meseNascitaInput, luogoNascitaInput):    
    cf = ''
    return cf
# # # # # #      M  A  I  N      # # # # #
# mi collego al db
if __name__ == '__main__':
    main()
# definisco alcuni valori "notevoli" (aka costanti)
# dichiaro ed inizializzo alcuni valori da usare dopo, anche se non necessario (ma più comodo)
modalità = 0
repoLink = 'https://github.com/nonsonoalessio/ProgettoVacanze'
s = 's'
n = 'n'
inserimento = 'inserimento'
lettura = 'lettura'
guida = 'guida'

# baso il programma su due modalità: 
# * read only, per interrogare il database;
# * write through, per salvare dati nel database.
modalità = input ('Inserisci il codice della modalità. Immetti:\n"inserimento" per inserire dati\n"lettura" per leggere i dati\n"guida" per aprire la guida\nScelta: ')
while modalità != inserimento and modalità != lettura and modalità != guida:
    print('Il codice della scelta non è valido, riprovare per favore.')
    modalità = input('Inserisci il codice della modalità. Immetti:\n"inserimento" per inserire dati\n"lettura" per leggere i dati\n"guida" per aprire la guida\nScelta: ')
if modalità == guida:
    webbrowser.open(repoLink)
    while modalità != inserimento and modalità != lettura:
        modalità = input('Inserisci il codice della modalità. Immetti:\n"inserimento" per inserire dati\n"lettura" per leggere i dati\nScelta: ')
        if modalità == inserimento:
            scritturaDati()
        elif modalità == lettura:
            letturaDati()
        else:
            print('La scelta inserita non è valida')
            modalità = input('Inserisci il codice della modalità. Immetti:\n"inserimento" per inserire dati\n"lettura" per leggere i dati\nScelta: ')
elif modalità == inserimento:
    scritturaDati()
elif modalità == lettura:
    letturaDati()

rilancio = input('Programma in chiusura. Desideri rilanciarlo? Immettere "s" per rilanciare, "n" per mantenere chiuso.\n Valore immesso: ')
while rilancio != s and rilancio != n:
    print('Scelta non valida. Riprovare per favore.')
    rilancio = input('Programma in chiusura. Desideri rilanciarlo? Immettere "s" per rilanciare, "n" per mantenere chiuso.\n Valore immesso: ')
if rilancio == s:
    os.system('main.exe')
    os.system('exit')
elif rilancio == n:
    os.system('exit')
