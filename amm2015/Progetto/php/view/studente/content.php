<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include_once 'anagrafica.php';
        break;

    case 'esami':
        include_once 'esami.php';
        break;

    case 'iscrizione':
        include_once 'iscrizione.php';
        break;
    default:
        
        ?>
        <h2 class="icon-title" id="h-home">Pannello di Controllo</h2>
        <p>
            Benvenuto, <?= $user->getNome() ?>
        </p>
        <p>
            Scegli una fra le seguenti sezioni:
        </p>
        <ul class="panel">
            <li><a href="studente/anagrafica<?= $vd->scriviToken('?')?>" id="pnl-anagrafica">
                    Anagrafica
                </a>
            </li>
            <li><a href="studente/esami<?= $vd->scriviToken('?')?>" id="pnl-libretto">Libretto</a></li>
            <li><a href="studente/iscrizione<?= $vd->scriviToken('?')?>" id="pnl-iscrizione">Iscrizione</a></li>
        </ul>
        <?php
        break;
}
?>


