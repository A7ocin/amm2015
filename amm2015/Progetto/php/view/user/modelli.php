<h2 class="icon-title" id="h-iscrizione">3d models database</h2>
<h4>User's infos</h1>
<ul class="none">
    <li><strong>Userame:</strong> <?= $user->getUsername() ?></li>
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

