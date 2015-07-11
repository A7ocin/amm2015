<div >
    <h2 class="icon-title" id="h-esami">Registrazione Esami</h2>
    <p>
        <strong>Presidente:</strong> <?= $user->getNome() ?> <?= $user->getCognome() ?>
    </p>
</div>
<p>
    <strong>
        Insegnamento:
    </strong>
    <?= $sel_insegnamento->getTitolo() ?>
</p>
<div class="input-form">
    <h3>Passo 2: Inserimento Commissione</h3>

    <?php
    if (count($commissione) == 0) {
        ?>
        <p>
            Nessun docente inserito
        </p>
    <?php } else { ?>
        <table>
            <thead>
                <tr>
                    <th class="commissione-col">Nome</th>
                    <th class="commissione-col">Cognome</th>
                    <th>Cancella</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $i = 0;
                foreach ($commissione as $membro) {
                    ?>
                    <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                        <td>
                            <?= $membro->getNome() ?>
                        </td>
                        <td>
                            <?= $membro->getCognome() ?>
                        </td>
                        <td>
                            <a href="docente/reg_esami_step2?elenco=<?= $elenco_id ?>&index=<?= $i ?>&cmd=r_del_commissione<?= $vd->scriviToken('&')?>" title="Elimina l'appello">
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
    <?php } ?>
    <form method="post" action="docente/reg_esami_step2?elenco=<?= $elenco_id ?><?= $vd->scriviToken('&')?>">

        <label for="nuovo-membro">Nuovo Membro</label>
        <select name="nuovo-membro" id="nuovo-membro">
            <?php
            $i = 0;
            foreach ($docenti as $docente) {
                ?>
                <option value="<?= $docente->getId() ?>"><?= $docente->getCognome() ?> <?= $docente->getNome() ?></option>
                <?php
                $i++;
            }
            ?>
        </select>
        <br/>
        <button name="cmd" type="submit" value="r_add_commissione">Aggiungi</button>
    </form>

</div>
<div >
    <form method="post" action="docente/reg_esami_step3?elenco=<?= $elenco_id ?><?= $vd->scriviToken('&')?>">
        <button class="avanti" type="submit" name="cmd" value="r_save_commissione">Avanti</button>
    </form>
    <form method="get" action="docente/reg_esami" class="inline">
        <?= $vd->scriviToken('', ViewDescriptor::post)?>
        <button class="indietro" type="submit" name="cmd" value="r_indietro">Indietro</button>
    </form>
    <div class="clear"> </div>
</div>