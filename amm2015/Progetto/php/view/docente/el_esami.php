<h2 class="icon-title" id="h-cerca">Elenco storico esami</h2>
<div class="error">
    <div>
        <ul><li>Testo</li></ul>
    </div>
</div>
<div class="input-form">
    <h3>Filtro</h3>
    <form method="post" action="docente/el_esami<?= $vd->scriviToken('?') ?>">
        <label for="insegnamento">Insegnamento</label>
        <select name="insegnamento" id="insegnamento">
            <option value="qualsiasi">Qualsiasi</option>
            <?php foreach ($insegnamenti as $insegnamento) { ?>
                <option value="<?= $insegnamento->getId() ?>" ><?= $insegnamento->getTitolo() ?></option>
            <?php } ?>
        </select>
        <label for="matricola">Matricola</label>
        <input name="matricola" id="matricola" type="text"/>
        <br/>
        <label for="nome">Cognome</label>
        <input name="nome" id="cognome" type="text"/>
        <br/>
        <label for="nome">Nome</label>
        <input name="nome" id="nome" type="text"/>
        <br/>
        <button id="filtra" type="submit" name="cmd" value="e_cerca">Cerca</button>
    </form>
</div>



<h3>Elenco Esami</h3>

<p id="nessuno">Nessun esame trovato</p>

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