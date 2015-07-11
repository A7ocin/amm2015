<div class="input-form">
    <h3>Iscritti all'appello di  <?= $mod_appello->getInsegnamento()->getTitolo() ?>  del 
        <?= $mod_appello->getData()->format('d/m/Y') ?>
    </h3>
    <ol>
        <?php
        foreach ($mod_appello->getIscritti() as $studente) {
            ?>
            <li><?= $studente->getCognome() ?> <?= $studente->getNome() ?></li>
            <?php
        }
        ?>
    </ol>
    <form method="get" action="docente/appelli<?= $vd->scriviToken('?')?>">
        <button type="submit" name="cmd" value="a_annulla">Chiudi</button>
    </form>

</div>