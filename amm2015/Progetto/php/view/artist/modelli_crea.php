<div class="input-form">
    <h3>Insert 3D model</h3>
    <form method="post" action="artist/modelli_crea<?= $vd->scriviToken('?')?>">
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
        <label for="description">Description</label>
        <input type="text" name="description" id="description"/>
        <br/>
        <div class="btn-group">
            <button type="submit" name="cmd" value="a_nuovo">Save</button>
            <button type="submit" name="cmd" value="a_annulla">Back</button>
        </div>
    </form>
</div>
