<div >
    <h2 class="icon-title" id="h-esami">Registrazione Esami</h2>
    <p>
        <strong>Presidente:</strong> <?= $user->getNome() ?> <?= $user->getCognome() ?>
    </p>
</div>
<?php
if (isset($elenchi_attivi) && count($elenchi_attivi) > 0) {
    ?>
    <h3>Elenchi non ancora registrati</h3>
    <table>
        <thead>
            <tr>
                <th>Elenco</th>
                <th>Insegnamento</th>
                <th>Commissione</th>
                <th>Modifica</th>
                <th>Cancella</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($elenchi_attivi as $elenco) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <td><?= $i + 1 ?></td>
                    <td>
                        <?php
                        if ($elenco->getTemplate()->getInsegnamento() != null) {
                            echo $elenco->getTemplate()->getInsegnamento()->getTitolo();
                        } else {
                            echo 'Non selezionato';
                        }
                        ?>
                    </td>
                    <td>
                        <ul class="none no-space">
                            <?php
                            foreach ($elenco->getTemplate()->getCommissione() as $docente) {
                                echo '<li>' . $docente->getNome() . ' ' . $docente->getCognome() . '</li>';
                            }
                            ?>
                        </ul>
                    </td>
                    <td>
                        <a href="docente/reg_esami_step1?elenco=<?= $elenco->getId() ?><?= $vd->scriviToken('&')?>" title="Modifica l'elenco">
                            <img  src="../images/edit-action.png" alt="Modifica">
                        </a>
                    </td>
                    <td>
                        <a href="docente/reg_esami?cmd=r_del_elenco&elenco=<?= $elenco->getId() ?><?= $vd->scriviToken('&')?>" title="Elimina l'elenco">
                            <img  src="../images/delete-action.png" alt="Elimina">
                        </a>
                    </td>

                </tr>
                </li>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>
<div class="input-form">
    <form method="get" action="docente/reg_esami_step1">
        <?= $vd->scriviToken('', ViewDescriptor::post)?>
        <input type="hidden" name="cmd" value="r_nuovo"/>
        <input type="submit" value="Nuovo Elenco"/>
    </form>
</div>