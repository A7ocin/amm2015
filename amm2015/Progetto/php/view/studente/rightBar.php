<h2 id="help" class="icon-title">Istruzioni</h2>
<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica': ?>
        <p>
            In questa sezione puoi modificare i tuoi dati personali.
        </p>
        <ul>
            <li>
                Il tuo <strong>indirizzo</strong> di residenza.
            </li>
            <li>
                Il tuo indirizzo <strong>email</strong>.
            </li>
            <li>
                La tua <strong>password</strong>
            </li>
        </ul>
        <?php break; ?>

    <?php case 'esami': ?>
        <p>
            In questa sezione puoi visualizzare gli esami da te
            sostenuti. Per ogni esame vengono riportati:
        </p>
        <ul>
            <li>
                Il nome dell'insegnamento.
            </li>
            <li>
                Il codice dell'insegnamento.
            </li>
            <li>
                Il voto conseguito.
            </li>
            <li>
                La data in cui l'esame &egrave; stato sostenuto.
            </li>
            <li>
                Il numero di crediti.
            </li>
            <li>
                Il presidente della commissione.
            </li>
            <li>
                La lista di membri della commissione.
            </li>
        </ul>
        <?php break; ?>

    <?php case 'iscrizione': ?>
        <p>
            In questa sezione ti puoi iscrivere per sostenere 
            un esame. Per ogni appello disponibile sono riportati:
        </p>
        <ul>
            <li>
                Il nome dell'insegnamento.
            </li>
            <li>
                Il codice dell'insegnamento.
            </li>
            <li>
                Il numero di crediti.
            </li>

            <li>
                La data in cui si terr&agrave; l'esame
            </li>
            <li>
                Il docente titolare dell'esame.
            </li>
            <li>
                Il numero di posti ancora disponibili.
            </li>
        </ul>
        <p>&Egrave; possibile iscriversi ad un determinato appello 
            cliccando sul link <em>Iscriviti</em> della riga corrispondente.

        </p>
        <?php break; ?>
        <?php  default:
        ?>
        <p>
            Seleziona una delle  seguentifunzionalit&agrave; disponibili per 
            la gestione dei tuoi esami:
        </p>
        <ol>
            <li>
                <strong>Anagrafica</strong> per modificare i tuoi dati 
                anagrafici e la tua password.
            </li>
            <li>
                <strong>Libretto</strong> per visualizzare gli esami gi&agrave;
                sostenuti.
            </li>
            <li>
                <strong>Iscrizione</strong> per iscriversi ad un appello
                di esame.
            </li>
        </ol>
        <?php break; ?>
<?php } ?>