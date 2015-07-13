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
        <h2 class="icon-title" id="h-home">Your 3D world</h2>
        <p>
            Welcome, <?= $user->getNome() ?>
        </p>
        <p>
            Select one of the following:
        </p>
        <ul class="panel">
            <li><a href="studente/anagrafica<?= $vd->scriviToken('?')?>" id="pnl-anagrafica">
                    My Infos
                </a>
            </li>
            <li><a href="studente/esami<?= $vd->scriviToken('?')?>" id="pnl-libretto">View bought models</a></li>
            <li><a href="studente/iscrizione<?= $vd->scriviToken('?')?>" id="pnl-iscrizione">Shop</a></li>
        </ul>
        <?php
        break;
}
?>


