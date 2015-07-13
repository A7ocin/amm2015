<div class="input-form">
    <h3>Modifica appello</h3>
    <form method="post" action="docente/appelli_modifica<?= $vd->scriviToken('?')?>">
        <input type="hidden" name="appello" value="<?= $mod_appello->getId() ?>"/>
        <label for="insegnamento">Insegnamento</label>
        <select name="insegnamento" id="insegnamento">
            <?php foreach ($insegnamenti as $insegnamento) { ?>
                <option value="<?= $insegnamento->getCodice() ?>" <?= $mod_appello->getInsegnamento()->equals($insegnamento) ? 'selected' : '' ?>><?= $insegnamento->getTitolo() ?></option>
            <?php } ?>
        </select>
        <br/>
        <label for="data">Data</label>
        <input type="text" name="data" id="data" value="<?= $mod_appello->getData()->format('d/m/Y') ?>"/>
        <br/>
        <label for="data">Capienza</label>
        <input type="text" name="posti" id="posti" value="<?= $mod_appello->getCapienza() ?>"/>
        <br/>
        <div class="btn-group">
            <button type="submit" name="cmd" value="a_salva">Salva</button>
            <button type="submit" name="cmd" value="a_annulla">Annulla</button>
        </div>
    </form>
</div>