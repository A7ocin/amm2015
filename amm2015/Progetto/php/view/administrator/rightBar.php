<h2 id="help" class="icon-title">Help</h2>
<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        ?>
        <p>
            In this page you can edit your personal infos, as:
        </p>
        <ul>
            <li>
                Your <strong>address</strong>.
            </li>
            <li>
                Your <strong>contacts</strong>.
            </li>
            <li>
                Your <strong>password</strong>.
            </li>
        </ul>
        <?php break; ?>

    <?php case 'appelli': ?>
        <p>
            In this page you can view and edit the 3d models' database. You can:
        </p>
        <ul>
            <li>
                Upload a new 3D model by pressing the button <em>Upload new model</em>.
            </li>
            <li>
                Edit an existing model by pressing the button <em>Edit Model</em>, 
                (the <img  src="../images/edit-action.png" alt="icona modifica"> icon).
            </li>
            <li>
                Delete an existing model by pressing the button <em>Delete Model</em>, 
                (the <img  src="../images/delete-action.png" alt="icona elimina"> icon).
            </li>
        </ul>
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
