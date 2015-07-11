<h2 class="icon-title" id="h-iscrizione">Iscrizione esami</h2>
<ul class="none">
    <li><strong>Nome:</strong> Davide</li>
    <li><strong>Cognome:</strong> Spano</li>
    <li><strong>Matricola:</strong> 253662</li>
</ul>


<h3>Appelli a cui sei iscritto</h3>
<?php if (count($appelli) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th class="iscrizione-col-large">Insegnamento</th>
                <th class="iscrizione-col-small">Codice</th>
                <th class="iscrizione-col-small">Crediti</th>
                <th class="iscrizione-col-small">Data</th>
                <th class="iscrizione-col-large">Docente</th>
                <th class="iscrizione-col-small">Posti</th>
                <th class="iscrizione-col-small">Iscrizione</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $c = 0;
            foreach ($appelli as $appello) {
                if ($appello->inLista($user)) {
                    ?>
                    <tr <?= $c % 2 == 0 ? 'class="alt-row"' : '' ?>>
                        <td><?= $appello->getInsegnamento()->getTitolo() ?></td>
                        <td><?= $appello->getInsegnamento()->getCodice() ?></td>
                        <td><?= $appello->getInsegnamento()->getCfu() ?></td>
                        <td><?= $appello->getData()->format('d/m/Y') ?></td>
                        <td><?= $appello->getInsegnamento()->getDocente()->getNome() . ' ' . $appello->getInsegnamento()->getDocente()->getCognome() ?></td>
                        <td><?= $appello->getPostiLiberi() ?></td>
                        <td><a href="studente/iscrizione?cmd=cancella&appello=<?= $i ?><?= $vd->scriviToken('&') ?>" title="Cancella la tua iscrizione">Cancella</a></td>
                    </tr>
                    <?php
                    $c++;
                }
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <p> Nessun appello disponibile </p>
<?php } ?>

<h3>Appelli disponibili</h3>
<?php if (count($appelli) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th class="iscrizione-col-large">Insegnamento</th>
                <th class="iscrizione-col-small">Codice</th>
                <th class="iscrizione-col-small">Crediti</th>
                <th class="iscrizione-col-small">Data</th>
                <th class="iscrizione-col-large">Docente</th>
                <th class="iscrizione-col-small">Posti</th>
                <th class="iscrizione-col-small">Iscrizione</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $c = 0;
            foreach ($appelli as $appello) {
                if (!$appello->inLista($user)) {
                    ?>
                    <tr <?= $c % 2 == 0 ? 'class="alt-row"' : '' ?>>
                        <td><?= $appello->getInsegnamento()->getTitolo() ?></td>
                        <td><?= $appello->getInsegnamento()->getCodice() ?></td>
                        <td><?= $appello->getInsegnamento()->getCfu() ?></td>
                        <td><?= $appello->getData()->format('d/m/Y') ?></td>
                        <td><?= $appello->getInsegnamento()->getDocente()->getNome() . ' ' . $appello->getInsegnamento()->getDocente()->getCognome() ?></td>
                        <td><?= $appello->getPostiLiberi() ?></td>
                        <td><a href="studente/iscrizione?cmd=iscrivi&appello=<?= $i ?><?= $vd->scriviToken('&') ?>" title="Iscriviti all'esame">Iscriviti</a></td>
                    </tr>
                    <?php
                    $c++;
                }
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <p> Nessun appello disponibile </p>
<?php } ?>