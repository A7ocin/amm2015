<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Accesso all'applicazione del progetto</h1>
        <p>
            Potete scaricare il codice direttamente dal web o facendo un git clone
            al seguente indirizzo 
            <a href="https://github.com/davidespano/esAMM2014">https://github.com/davidespano/esAMM2014</a>
        </p>

        <h2> Descrizione dell'applicazione </h2>
        <p>
            L’applicazione supporta la registrazione di statini sul web. 
            La funzionalità di base prevede che un professore possa inserire i dati 
            relativi all’esame sostenuto da uno studente. 
            I dati che figurano per ogni statino sono i seguenti:
        </p>
        <ul>
            <li>Nome, cognome e matricola dello studente</li>
            <li>Nome e cognome del presidente della commissione</li>
            <li>Nome e cognome di uno o più mebri della commissione (uno o più docenti)</li>
            <li>Il codice, il nome ed il numero di crediti dell’insegnamento</li>
            <li>Il voto conseguito</li>
        </ul>


        <p>Inoltre,  studente &egrave; in grado di visualizzare 
            il suo libretto direttamente su web.
            Un esame &egrave; associato ad un insegnamento &egrave;, formato da:
        </p>
        <ul>
            <li>Un titolo</li>
            <li>Un codice</li>
            <li>Un Corso di Laurea di afferenza</li>
            <li>Un numero di crediti</li>
        </ul>

        <p>L’applicazione mantiene una anagrafica dei professori e degli studenti, in particolare:</p>

        <ul>
            <li>Nome e Cognome</li>
            <li>Indirizzo</li>
            <li>Email</li>
        </ul>

        <p>
            Per i professori, si mantiene anche il Dipartimento di afferenza, 
            mentre per gli studenti si mantiene il Corso di Laurea, 
            che a sua volta afferisce ad un Dipartimento. </p>

        <p>
            Inoltre,  l’applicazione 
            fornisce istruzioni dettagliate sulla modalit&agrave; di inserimento dei 
            dati personali (che può essere fatto direttamente da ogni utente) 
            e sulla visualizzazione del libretto per gli studenti
            e delle 
            liste degli esami registrati per i professori, con funzione di ricerca e filtraggio. 
        </p>
        <p>
            L’applicazione gestisce  la prenotazione degli esami da parte degli studenti: 
            il docente inserisce una data ed un numero di studenti che possono sostenere l’esame.
            Lo studente si connette e si iscrive nel caso ci siano ancora posti. </p>

        <h2> Requisiti del progetto </h2>
        <ul>
            <li>Utilizzo di HTML e CSS</li>
            <li>Utilizzo di PHP e MySQL</li>
            <li>Utilizzo del pattern MVC </li>
            <li>Due ruoli (studente e docente)</li>
            <li>Transazione per la registrazione degli esami (metodo salvaElenco della classe EsameFactory.php)</li>
            <li>Caricamento ajax dei risultati della ricerca degli esami (ruolo docente)</li>

        </ul>
    </ul>

    <h2>Accesso al progetto</h2>
    <p>
        La homepage del progetto si trova sulla URL <a href="php/login">http://spano.sc.unica.it/amm2014/davide/esami14/php/login</a>
    <p>
    <p>Si pu&ograve; accedere alla applicazione con le seguenti credenziali</p>
    <ul>
        <li>Ruolo docente:</li>
        <ul>
            <li>username: docente</li>
            <li>password: spano</li>
        </ul>
        <li>Ruolo studente:</li>
        <ul>
            <li>username: studente</li>
            <li>password: spano</li>
        </ul>
    </ul>
</body>
</html>
