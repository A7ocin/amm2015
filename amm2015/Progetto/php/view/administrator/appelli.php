<h2 class="icon-title" id="h-iscrizione">Appelli inseriti</h2>
<ul class="none">
    <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
    <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
</ul>

<?php if (count($models) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th class="iscrizione-col-small">ID</th>
                <th class="iscrizione-col-small">Date</th>
                <th class="iscrizione-col-small">Dimension</th>
                <th class="iscrizione-col-small">Name</th>
                <th class="iscrizione-col-small">Edit Model</th>
                <th class="iscrizione-col-small">Delete Model</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($models as $model) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <td><?= $model->getId() ?></td>
                    <td><?= $model->getData()->format('d/m/Y') ?></td>
                    <td><?= $model->getDimensione() ?></td>
                    <td><?= $model->getNome() ?></td>
                    <td>
                        <a href="administrator/appelli_modifica?appello=<?= $model->getId() ?><?= $vd->scriviToken('&') ?>" title="Edit Model">
                            <img  src="../images/edit-action.png" alt="Modifica">
                        </a>
                    </td>
                    <td>
                        <a href="administrator/appelli?cmd=a_cancella&appello=<?= $model->getId() ?><?= $vd->scriviToken('&') ?>" title="Delete Model">
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

    <form method="post" action="administrator/appelli_crea<?= $vd->scriviToken('?') ?>">
        <button type="submit"name="cmd" value="a_crea">Crea Appello</button>
    </form>

</div>

