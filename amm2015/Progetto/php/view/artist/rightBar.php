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
                Your <strong>generic infos</strong>.
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
            Select one of the following sections of your 3D world:
        </p>
        <ol>
            <li>
                <strong>Personal Infos</strong> to edit your account's infos, such as your email or password.
            </li>
            <li>
                <strong>3d models database</strong> to view all the beautiful models on our database.
            </li>
            <li>
                <strong>Users List</strong> to access the complete list of our users.
            </li>
            <li>
                <strong>Search models</strong> to search for a model.
            </li>
        </ol>
        <?php break; ?>
<?php } ?>
