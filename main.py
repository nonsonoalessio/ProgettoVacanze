# importo i vari moduli necessari
import os
import webbrowser
import time # (uso: time.sleep(value int | float))

# definisco alcune funzioni usate più in avanti
# prassi di code cleanup
def eccezioneValueError():
    print('E\' stato inserito un valore non valido che ha causato l\'eccezione ValueError.\nRiavvio il programma...\n')
    os.system('main.exe')
    os.system('exit')
def scritturaDati():
    print('Hello world')
def letturaDati():
    print('Hello world')

# # # # # #      M  A  I  N      # # # # #
# definisco alcuni valori "notevoli" (aka costanti)
# dichiaro ed inizializzo alcuni valori da usare dopo, anche se non necessario (ma più comodo)
modalità = 0
repoLink = 'https://github.com/nonsonoalessio/ProgettoVacanze'
s = 's'
n = 'n'

# baso il programma su due modalità: 
# * read only, per interrogare il database;
# * write through, per salvare dati nel database;
modalità = input ('Inserisci il codice della modalità:\n1) inserimento dati\2) lettura dati\n3) apri guida\nScelta: ')
try:
    modalità = int(modalità)
except ValueError:
    eccezioneValueError()
while modalità != 1 & modalità != 2 & modalità != 3:
    print('Il codice della scelta non è valido, riprovare per favore.')
    modalità = input ('Inserisci il codice della modalità:\n1) inserimento dati\2) lettura dati\n3) apri guida\nScelta: ')
    try:
        modalità = int(modalità)
    except ValueError:
        eccezioneValueError()
if modalità == 3:
    webbrowser.open(repoLink)
elif modalità == 1:
    scritturaDati()
elif modalità == 2:
    letturaDati()

rilancio = input('Programma in chiusura. Desideri rilanciarlo? Immettere "s" per rilanciare, "n" per mantenere chiuso.\n Valore immesso: ')
while rilancio != s & rilancio != n:
    print('Scelta non valida. Riprovare per favore.')
    rilancio = input('Programma in chiusura. Desideri rilanciarlo? Immettere "s" per rilanciare, "n" per mantenere chiuso.\n Valore immesso: ')
if rilancio == s:
    os.system('main.exe')
    os.system('exit')
elif rilancio == n:
    os.system('exit')
