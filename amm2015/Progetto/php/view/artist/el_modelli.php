<h2 class="icon-title" id="h-cerca">Search models</h2>
<div class="error">
    <div>
        <ul><li>Testo</li></ul>
    </div>
</div>
<div class="input-form">
    <h3>Filter</h3>
    <form method="post" action="artist/el_modelli<?= $vd->scriviToken('?') ?>">		
        <label for="uploader">Uploader</label>
        <input name="uploader" id="uploader" type="text"/>
        <br/>
        <label for="nome">Name</label>
        <input name="nome" id="nome" type="text"/>
        <br/>
        <button id="filtra" type="submit" name="cmd" value="e_cerca">Find models</button>
    </form>
</div>



<h3>Found models</h3>

<p id="nessuno">No models found</p>

<table id="tabella_modelli">
    <thead>
        <tr>
            <th>Id</th>
            <th>Data</th>
            <th>Dimension (Mb)</th>
            <th>Name</th>
            <th>Uploader</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>

        <tr >
            <td> id </td>
            <td> data </td>
            <td> dimensione </td>
            <td> nome </td>
            <td> uploader </td>
            <td> descrizione </td>

        </tr>

    </tbody>
</table>
