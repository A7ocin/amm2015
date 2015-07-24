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

    <?php case 'modelli': ?>
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

    <?php case 'utenti': ?>
        <p>
            In this page you can view the infos of all the users in our database, such as:
        </p>
        <ul>
            <li>Username</li>
            <li>City</li>
            <li>Email</li>
        </ul>
        <?php break; ?>
    <?php case 'el_modelli': ?>
        <p>
            In this page you can search for the models in our database. You can filter by:
        </p>
        <ul>
            <li>Uploader</li>
            <li>Name</li>
        </ul>
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
