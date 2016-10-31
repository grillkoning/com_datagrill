BENVENUTI IN DATAGRILL; COSTRUIRE  UN FRONTEND APPLICAZIONE DATABASE MYSQL IN JOOMLA! SENZA ALCUN USO DI CODICE.

(C) Chris Rutten 2016

Questo programma è un software libero; è possibile ridistribuirlo e / o 
modificarlo secondo i termini della GNU General Public License
come pubblicato dalla Free Software Foundation; o la versione 2
della licenza, o (a propria scelta) una versione successiva.

Questo programma è distribuito nella speranza che possa essere utile,
ma SENZA ALCUNA GARANZIA; senza neppure la garanzia implicita di
COMMERCIABILITÀ o IDONEITÀ PER UN PARTICOLARE SCOPO. vedere la
GNU General Public License per ulteriori dettagli.

Si dovrebbe aver ricevuto una copia della GNU General Public License
insieme a questo programma; in caso contrario, scrivere alla Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.


GUIDA RAPIDA:

Questo programma è un wrapper Joomla! per la fenomenale piattaforma Xataface. Per iniziare:

(1) Installare come una qualsiasi altro estensione Joomla! Per spiegazioni, vedi la documentazione Joomla! su:
https://docs.joomla.org/Installing_an_extension

(2) Creare la vostra prima applicazione nel pannello amministratore:
    - scegliete 'componenti' -> 'Datagrill' -> 'applicazioni'
    - cliccate 'nuovo'
    - Inserite le credenziali necessarie per l'accesso al database MySQL
    - cliccate 'salva'

(3) Impostare le credenziali per l'applicazione
    - dall'interno dello stesso form come in (2), in cui si immettono le credenziali, selezionate la scheda 'ACL'
    - scegliere il gruppo di utenti 'registered'
    - date loro tutte le autorizzazioni elencate, giusto per iniziare

(4) Aggiungere le tabelle per l'applicazione
    - scegli "componenti" -> 'Datagrid' -> 'table'
    - inserire il nome della tabella da utilizzare (come presente nel db MySQL) nel campo 'titolo'
    - inserire un alias leggibile nel campo 'descrizione'
    - salvare e ripetere per tutte le tabelle necessarie all'applicazione

(5) Per abilitare l'applicazione, creare una nuova voce di menu di tipo 'datagrill'.

Per informazioni consultare il Joomla! documentazione:
https://docs.joomla.org/Adding_a_new_menu_item

GODETE!

Cosa posso fare adesso:

È possibile personalizzare l'applicazione in un numero illimitato di modi. Il suo percorso di partenza è
/ components / com_datagrill / apps
Vedere la documentazione su Xataface:
http://xataface.com/documentation/tutorial/getting_started/using_first_app
http://www.xataface.it/documentazione/9-tutorial.html

nota sulla personalizzazione dell'applicazione:
Si può fare qualsiasi cosa che xataface permette di fare, ad eccezione dell'utilizzare la sua autenticazione / funzioni autorizzazioni; dal momento che questo è già gestito da Joomla


   


