<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include 'anagrafica.php';
        break;

    case 'modelli':
        include 'modelli.php';
        break;
    
    case 'modelli_modifica':
        include 'modelli.php';
        include 'modelli_modifica.php';
        break;
    
    case 'modelli_crea':
        include 'modelli.php';
        include 'modelli_crea.php';
        break;
    
    case 'appelli_iscritti':
        include 'appelli.php';
        include 'appelli_iscritti.php';
        break;
    
    case 'reg_esami':
        include 'reg_esami.php';
        break;
    
    case 'reg_esami_step1':
        include 'reg_esami_step1.php';
        break;
    
    case 'reg_esami_step2':
        include 'reg_esami_step2.php';
        break;
    
     case 'reg_esami_step3':
        include 'reg_esami_step3.php';
        break;
    
    case 'el_esami':
        include 'el_esami.php';
        break;
    
    case 'el_esami_json':
        include 'el_esami_json.php';
        break;
        ?>
        

    <?php default: ?>
        <h2 class="icon-title" id="h-home">My 3D world</h2>
        <p>
            Welcome, <?= $user->getNome() ?>
        </p>
        <p>
            Select one of the following:
        </p>
        <ul class="panel">
            <li><a href="user/anagrafica<?= $vd->scriviToken('?')?>" id="pnl-anagrafica">
                    Personal Infos
                </a>
            </li>
            <li><a href="user/modelli<?= $vd->scriviToken('?')?>" id="pnl-iscrizione">3d models database</a></li>
            <li><a href="user/reg_esami<?= $vd->scriviToken('?')?>" id="pnl-libretto">Registrazione Esami</a></li>
            <li><a href="user/el_esami<?= $vd->scriviToken('?')?>" id="pnl-cerca">Elenco Esami</a></li>
        </ul>
        <?php
        break;
}
?>


