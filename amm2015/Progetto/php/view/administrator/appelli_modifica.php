<div class="input-form">
    <h3>Edit model</h3>
    <form method="post" action="administrator/appelli_modifica<?= $vd->scriviToken('?')?>">
        <input type="hidden" name="appello" value="<?= $mod_model->getId() ?>"/>
        <label for="data">Date</label>
        <input type="text" name="data" id="data" value="<?= $mod_model->getData()->format('d/m/Y') ?>"/>
        <br/>
        <label for="posti">Dimension</label>
        <input type="text" name="posti" id="posti" value="<?= $mod_model->getDimensione() ?>"/>
        <br/>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= $mod_model->getNome() ?>"/>
        <br/>
        <div class="btn-group">
            <button type="submit" name="cmd" value="a_salva">Save</button>
            <button type="submit" name="cmd" value="a_annulla">Back</button>
        </div>
    </form>
</div>
