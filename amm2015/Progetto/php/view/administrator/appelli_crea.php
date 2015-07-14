<div class="input-form">
    <h3>Crea appello</h3>
    <form method="post" action="administrator/appelli_crea<?= $vd->scriviToken('?')?>">
        <input type="hidden" name="cmd" value="a_nuovo"/>
        <label for="data">Date</label>
        <input type="text" name="data" id="data"/>
        <br/>
        <label for="posti">Dimension</label>
        <input type="text" name="posti" id="posti"/>
        <br/>
        <label for="name">Name</label>
        <input type="text" name="name" id="name"/>
        <br/>
        <div class="btn-group">
            <button type="submit" name="cmd" value="a_nuovo">Salva</button>
            <button type="submit" name="cmd" value="a_annulla">Annulla</button>
        </div>
    </form>
</div>
