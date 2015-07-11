<div >
    <h2 class="icon-title" id="h-esami">Registrazione Esami</h2>
    <p>
        <strong>Presidente:</strong> <?= $user->getNome() ?> <?= $user->getCognome() ?>
    </p>
</div>
<div class="input-form">
    <h3>Passo 1: Selezione Insegnamento</h3>
    <p>Selezionare uno fra i seguenti insegnamenti</p>
    <form method="post" action="docente/reg_esami_step2?elenco=<?= $elenco_id ?><?= $vd->scriviToken('&')?>" class="inline">
        <?php foreach ($insegnamenti as $insegnamento) { ?>

            <input type="radio" id="<?= $insegnamento->getCodice() ?>"
                   name="insegnamento" value="<?= $insegnamento->getCodice() ?>"
                   <?= isset($sel_insegnamento) && $insegnamento->equals($sel_insegnamento) ? 'checked="checked"' : '' ?>/>
            <label class="full" for="<?= $insegnamento->getCodice() ?>"> <?= $insegnamento->getTitolo() ?> (<?= $insegnamento->getCfu() ?> CFU)</label>
            <br/>
        <?php } ?>
        
        <button class="avanti" type="submit" name="cmd" value="r_sel_insegnamento">Avanti</button>
    </form>
    <form method="get" action="docente/reg_esami" class="inline">
        <?= $vd->scriviToken('', ViewDescriptor::post)?>
        <button class="indietro" type="submit" name="cmd" value="r_indietro">Indietro</button>
    </form>
    <div class="clear">
    </div>
</div>