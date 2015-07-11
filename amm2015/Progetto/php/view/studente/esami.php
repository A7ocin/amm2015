<h2 class="icon-title" id="h-esami">Libretto</h2>
<ul class="none">
    <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
    <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
    <li><strong>Matricola:</strong> <?= $user->getMatricola() ?></li>
</ul>

<?php if (count($esami) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th class="esami-col-large">Insegnamento</th>
                <th class="esami-col-small">Codice</th>
                <th class="esami-col-small">Voto</th>
                <th class="esami-col-small">CFU</th>
                <th class="esami-col-small">Data</th>
                <th class="esami-col-large">Presidente</th>
                <th class="esami-col-large">Commissione</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;

            foreach ($esami as $esame) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <td><?= $esame->getInsegnamento()->getTitolo() ?></td>
                    <td><?= $esame->getInsegnamento()->getCodice() ?></td>
                    <td><?= $esame->getVoto() ?></td>
                    <td><?= $esame->getInsegnamento()->getCfu() ?></td>
                    <td><?= $esame->getData()->format('d/m/Y') ?></td>
                    <td><?= $esame->getInsegnamento()->getDocente()->getNome() . ' ' . $esame->getInsegnamento()->getDocente()->getCognome() ?></td>
                    <td>
                        <ul class="none no-space">
                            <?php
                            foreach ($esame->getCommissione() as $docente) {
                                echo '<li>' . $docente->getNome() . ' ' . $docente->getCognome() . '</li>';
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <p> Nessun esame inserito </p>
<?php } ?>
