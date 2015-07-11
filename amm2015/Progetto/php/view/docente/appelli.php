<h2 class="icon-title" id="h-iscrizione">Appelli inseriti</h2>
<ul class="none">
    <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
    <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
</ul>

<?php if (count($appelli) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th class="iscrizione-col-large">Insegnamento</th>
                <th class="iscrizione-col-small">Codice</th>
                <th class="iscrizione-col-small">Crediti</th>
                <th class="iscrizione-col-small">Data</th>
                <th class="iscrizione-col-small">Capienza</th>
                <th class="iscrizione-col-small">Iscritti</th>
                <th class="iscrizione-col-small">Modifica</th>
                <th class="iscrizione-col-small">Cancella</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($appelli as $appello) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <td><?= $appello->getInsegnamento()->getTitolo() ?></td>
                    <td><?= $appello->getInsegnamento()->getCodice() ?></td>
                    <td><?= $appello->getInsegnamento()->getCfu() ?></td>
                    <td><?= $appello->getData()->format('d/m/Y') ?></td>
                    <td><?= $appello->getCapienza() ?></td>
                    <td>
                        <a href="docente/appelli_iscritti?appello=<?= $appello->getId() ?><?= $vd->scriviToken('&') ?>" title="Visualizza la lista degli iscritti">
                            <?= $appello->numeroIscritti() ?>
                        </a>
                    </td>
                    <td>
                        <a href="docente/appelli_modifica?appello=<?= $appello->getId() ?><?= $vd->scriviToken('&') ?>" title="Modifica l'appello">
                            <img  src="../images/edit-action.png" alt="Modifica">
                        </a>
                    </td>
                    <td>
                        <a href="docente/appelli?cmd=a_cancella&appello=<?= $appello->getId() ?><?= $vd->scriviToken('&') ?>" title="Elimina l'appello">
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
<?php } else { ?>
    <p>Nessun appello inserito</p>
<?php } ?>
<div class="input-form">

    <form method="post" action="docente/appelli_crea<?= $vd->scriviToken('?') ?>">
        <button type="submit"name="cmd" value="a_crea">Crea Appello</button>
    </form>

</div>

