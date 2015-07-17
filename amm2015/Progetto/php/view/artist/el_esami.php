<h2 class="icon-title" id="h-cerca">Search models</h2>
<div class="error">
    <div>
        <ul><li>Testo</li></ul>
    </div>
</div>
<div class="input-form">
    <h3>Filter</h3>
    <form method="post" action="artist/el_esami<?= $vd->scriviToken('?') ?>">
        <label for="matricola">Matricola</label>
        <input name="matricola" id="matricola" type="text"/>
        <br/>
        <label for="nome">Cognome</label>
        <input name="nome" id="cognome" type="text"/>
        <br/>
        <label for="nome">Nome</label>
        <input name="nome" id="nome" type="text"/>
        <br/>
        <button id="filtra" type="submit" name="cmd" value="e_cerca">Find models</button>
    </form>
</div>



<h3>Found models</h3>

<p id="nessuno">No models found</p>

<table id="tabella_esami">
    <thead>
        <tr>
            <th>Insegnamento</th>
            <th>Crediti</th>
            <th>Matricola</th>
            <th>Studente</th>
            <th>Voto</th>
            <th>Membri</th>
        </tr>
    </thead>
    <tbody>

        <tr >
            <td> insegnamento 1</td>
            <td> cfu </td>
            <td> matricola </td>
            <td> Cognome Nome</td>
            <td> Voto</td>
            <td>
                <ul class="none no-space">
                    Commissione
                </ul>
            </td>

        </tr>

    </tbody>
</table>
