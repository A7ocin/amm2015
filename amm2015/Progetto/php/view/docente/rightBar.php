<h2 id="help" class="icon-title">Istruzioni</h2>
<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        ?>
        <p>
            In questa sezione puoi modificare i tuoi dati personali.
        </p>
        <ul>
            <li>
                Il tuo <strong>indirizzo</strong> del tuo ufficio.
            </li>
            <li>
                I tuoi contatti  (<strong>email</strong> e 
                <strong>orario di ricevimento</strong>).
            </li>
            <li>
                La tua <strong>password</strong>
            </li>
        </ul>
        <?php break; ?>

    <?php case 'appelli': ?>
        <p>
            In questa sezione visualizzare i tuoi appelli d'esame.
            In particolare:
        </p>
        <ul>
            <li>
                Puoi crearne uno nuovo premendo il pulsante <em>Nuovo</em>.
            </li>
            <li>
                Puoi modificarne uno esistente premendo il pulsante <em>Modifica</em>, 
                identificabile dall'icona matita <img  src="../images/edit-action.png" alt="icona modifica">
            </li>
            <li>
                Puoi eliminarne uno esistente premendo il pulsante <em>Elimina</em>, 
                identificabile dall'icona cestino <img  src="../images/delete-action.png" alt="icona elimina">
            </li>
        </ul>
        <p>Per l'inserimento e la modifica &egrave; necessario specificare
            solo l'insegnamento, la data ed i posti disponibili. 
        </p>
        <?php break; ?>

    <?php case 'reg_esami': ?>
        <p>
            In questa sezione puoi registrare un esame, inserendo i seguenti 
            dati
        </p>
        <ul>
            <li>Insegnamento</li>
            <li>Lista dei docenti in commissione</li>
            <li>Matricola dello studente</li>
            <li>Voto</li>
        </ul>
        <p>
            Viene inoltre mostrato l'elenco degli esami registrati in data odierna per
            l'insegnamento selezionato.

        </p>
        <p>
            &Egrave; possibile eliminare la registrazione di un esame
            tramite il pulsante  <em>Elimina</em>, 
            identificabile dall'icona cestino <img  src="../images/delete-action.png" alt="icona elimina">
        </p>
        <?php break; ?>
    <?php case 'el_esami': ?>
        <p>
            In questa sezione puoi visualizzare lo storico degli esami
            da te registrati. &Egrave; possibile filtrarli per data e per studente
        </p>
        <p>
            Puoi modificarne uno la registrazione di un esame esistente 
            premendo il pulsante <em>Modifica</em>, 
            identificabile dall'icona matita <br/>
            <img  src="../images/edit-action.png" alt="icona modifica">
        </p>
        <p>
            &Egrave; possibile eliminare la registrazione di un esame
            tramite il pulsante  <em>Elimina</em>, 
            identificabile dall'icona cestino <br/>
            <img  src="../images/delete-action.png" alt="icona elimina">
        </p>
        <?php break; ?>
    <?php default:
        ?>
        <p>
            Seleziona una delle  seguentifunzionalit&agrave; disponibili per 
            la gestione dei tuoi insegnamenti:
        </p>
        <ol>
            <li>
                <strong>Anagrafica</strong> per modificare i tuoi dati 
                anagrafici e la tua password.
            </li>
            <li>
                <strong>Appelli</strong> per visualizzare e/o creare appelli di esame
                per i tuoi insegnamenti.
            </li>
            <li>
                <strong>Esami</strong> per registrare gli statini di esame.
            </li>
            <li>
                <strong>Elenco Esami</strong> per visualizzare gli statini di esame.
            </li>
        </ol>
        <?php break; ?>
<?php } ?>