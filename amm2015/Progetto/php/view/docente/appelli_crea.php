<div class="input-form">
    <h3>Crea appello</h3>
    <form method="post" action="docente/appelli_crea<?= $vd->scriviToken('?')?>">
        <input type="hidden" name="cmd" value="a_nuovo"/>
        <label for="insegnamento">Insegnamento</label>
        <select name="insegnamento" id="insegnamento">
            <?php foreach ($insegnamenti as $insegnamento) { ?>
                <option value="<?= $insegnamento->getCodice() ?>" ><?= $insegnamento->getTitolo() ?></option>
            <?php } ?>
        </select>
        <br/>
        <label for="data">Data</label>
        <input type="text" name="data" id="data"/>
        <br/>
        <label for="data">Capienza</label>
        <input type="text" name="posti" id="posti"/>
        <br/>
        <div class="btn-group">
            <button type="submit" name="cmd" value="a_nuovo">Salva</button>
            <button type="submit" name="cmd" value="a_annulla">Annulla</button>
        </div>
    </form>
</div>