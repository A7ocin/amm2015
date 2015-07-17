<div class="input-form">
    <h3>Edit model</h3>
    <form method="post" action="administrator/modelli_modifica<?= $vd->scriviToken('?')?>">
        <input type="hidden" name="modello" value="<?= $mod_model->getId() ?>"/>
        <label for="data">Date</label>
        <input type="text" name="data" id="data" value="<?= $mod_model->getData()->format('d/m/Y') ?>"/>
        <br/>
        <label for="posti">Dimension</label>
        <input type="text" name="posti" id="posti" value="<?= $mod_model->getDimensione() ?>"/>
        <br/>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= $mod_model->getNome() ?>"/>
        <br/>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" value="<?= $mod_model->getDescrizione() ?>"/>
        <br/>
        <div class="btn-group">
            <button type="submit" name="cmd" value="a_salva">Save</button>
            <button type="submit" name="cmd" value="a_annulla">Back</button>
        </div>
    </form>
</div>
