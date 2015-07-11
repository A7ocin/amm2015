<div >
    <h2 class="icon-title" id="h-esami">Registrazione Esami</h2>
    <p>
        <strong>Presidente:</strong> <?= $user->getNome() ?> <?= $user->getCognome() ?>
    </p>
</div>
<h3>Insegnamento e Commissione</h3>
<p>
    <strong>
        Insegnamento:
    </strong>
    <?= $sel_insegnamento->getTitolo() ?>
</p>
<p>
    <strong>
        Commissione:
    </strong>

</p>
<ul>
    <?php
    foreach ($commissione as $membro) {
        ?>
        <li><?= $membro->getNome() ?> <?= $membro->getCognome() ?></li>
        <?
    }
    ?>
</ul>
<div class="input-form">
    <form action="docente/reg_esami_step1?elenco=<?= $elenco_id ?><?= $vd->scriviToken('&')?>" method="get">
        <input type="submit" name="r_modifica" value="Modifica"/>
    </form>
</div>
<div class="input-form">
    <h3>Nuovo Esame</h3>
    <form method="post" action="docente/reg_esami_step3?&elenco=<?= $elenco_id ?><?= $vd->scriviToken('&')?>">
        <label for="matricola">Matricola</label>
        <input name="matricola" id="matricola" type="text"/>
        <br/>
        <label for="voto">Voto</label>
        <input name="voto" id="voto" type="text"/>
        <br/>
        <button type="submit" name="cmd" value="r_add_esame">Aggiungi</button>
        <br/>
    </form>
</div>


<h3>Elenco Esami</h3>
<?php
if (count($sel_esami) == 0) {
    ?>

    <p>
        <strong>
            Nessuno statino inserito
        </strong>

    </p>
    <?php
} else {
    ?>
    <table>
        <thead>
            <tr>
                <th class="reg-col-large">Matricola</th>
                <th class="reg-col-large">Cognome</th>
                <th class="reg-col-large">Nome</th>
                <th class="reg-col-small">Voto</th>
                <th class="reg-col-small">Cancella</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $i = 0;
            foreach ($sel_esami as $statino) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <td><?= $statino->getStudente()->getMatricola() ?></td>
                    <td><?= $statino->getStudente()->getCognome() ?></td>
                    <td><?= $statino->getStudente()->getNome() ?></td>
                    <td><?= $statino->getVoto() ?></td>
                    <td>
                        <a href="docente/reg_esami_step3?elenco=<?= $elenco_id ?>&index=<?= $i ?>&cmd=r_del_esame<?= $vd->scriviToken('&')?>" title="Elimina lo statino">
                            <img  src="../images/delete-action.png" alt="Elimina">
                        </a>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    <form method="get" action="docente/reg_esami_step3">
        <?= $vd->scriviToken('', ViewDescriptor::post)?>
        <input type="hidden" name="elenco" value="<?= $elenco_id ?>"/>
        <div class="btn-group">
            <button type="submit" name="cmd" value="r_salva_elenco">Registra Elenco</button>
        </div>
    </form>
    <?php
}
?>