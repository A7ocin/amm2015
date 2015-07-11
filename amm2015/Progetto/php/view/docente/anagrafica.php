<div class="input-form">
    <h2 class="icon-title" id="h-personali">Dati personali</h2>
    <ul class="none">
        <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
        <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
    </ul>
</div>

<div class="input-form">
    <h3>Ufficio</h3>

    <form method="post" action="docente/anagrafica<?= '?'.$vd->scriviToken()?>">
        <input type="hidden" name="cmd" value="ufficio"/>
        <label for="dipartimento">Dipartimento</label>
        <select name="dipartimento" id="dipartimento">
            <?php foreach ($dipartimenti as $dipartimento) { ?>
                <option value="<?= $dipartimento->getId() ?>" <?= $user->getDipartimento()->equals($dipartimento) ? 'selected' : '' ?>><?= $dipartimento->getNome() ?></option>
            <?php } ?>
        </select>
        <label for="via">Via o Piazza:</label>
        <input type="text" name="via" id="via" value="<?= $user->getVia() ?>"/>
        <br>
        <label for="civico">Numero Civico</label>
        <input type="text" name="civico" id="civico" value="<?= $user->getNumeroCivico() ?>"/>
        <br/>
        <label for="citta">Citt&agrave;</label>
        <input type="text" name="citta" id="citta" value="<?= $user->getCitta() ?>"/>
        <br/>
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" id="provincia" value="<?= $user->getProvincia() ?>"/>
        <br/>
        <label for="cap">CAP</label>
        <input type="text" name="cap" id="cap" value="<?= $user->getCap() ?>"/>
        <br/>
        <input type="submit" value="Salva"/>

    </form>
</div>
<div class="input-form">
    <h3>Contatti</h3>

    <form method="post" action="docente/anagrafica<?=$vd->scriviToken('?')?>">
        <input type="hidden" name="cmd" value="contatti"/>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email"value="<?= $user->getEmail() ?>"/>
        <br/>
        <label for="ricevimento">Ricevimento:</label>
        <input type="text" name="ricevimento" id="ricevimento"value="<?= $user->getRicevimento() ?>"/>
        <br/>
        <input type="submit" value="Salva"/>
    </form>
</div>

<div class="input-form">
    <h3>Password</h3>
    <form method="post" action="docente/anagrafica<?= $vd->scriviToken('?')?>">
        <input type="hidden" name="cmd" value="password"/>
        <label for="pass1">Nuova Password:</label>
        <input type="password" name="pass1" id="pass1"/>
        <br/>
        <label for="pass2">Conferma:</label>
        <input type="password" name="pass2" id="pass2"/>
        <br/>
        <input type="submit" value="Cambia"/>
    </form>
</div>