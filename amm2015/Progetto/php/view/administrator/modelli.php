<h2 class="icon-title" id="h-iscrizione">3d models database</h2>
<h4>Admin's infos</h1>
<ul class="none">
    <li><strong>Name:</strong> <?= $user->getNome() ?></li>
    <li><strong>Surname:</strong> <?= $user->getCognome() ?></li>
</ul>

<?php if (count($models) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th class="iscrizione-col-small">ID</th>
                <th class="iscrizione-col-small">Date</th>
                <th class="iscrizione-col-small">Dimension (Mb)</th>
                <th class="iscrizione-col-small">Name</th>
                <th class="iscrizione-col-small">Uploader</th>
                <th class="iscrizione-col-small">Description</th>
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
                    <td><?= $model->getUploader() ?></td>
                    <td><?= $model->getDescrizione() ?></td>
                    <td>
                        <a href="administrator/modelli_modifica?modello=<?= $model->getId() ?><?= $vd->scriviToken('&') ?>" title="Edit Model">
                            <img  src="../images/edit-action.png" alt="Modifica">
                        </a>
                    </td>
                    <td>
                        <a href="administrator/modelli?cmd=a_cancella&modello=<?= $model->getId() ?><?= $vd->scriviToken('&') ?>" title="Delete Model">
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
    <p>Empty database</p>
<?php } ?>
<div class="input-form">

    <form method="post" action="administrator/modelli_crea<?= $vd->scriviToken('?') ?>">
        <button type="submit"name="cmd" value="a_crea">Upload new model</button>
    </form>

</div>

