<div class="input-form">
    <h2 class="icon-title" id="h-personali">Personal Infos</h2>
    <ul class="none">
        <li><strong>Name:</strong> <?= $user->getNome() ?></li>
        <li><strong>Surname:</strong> <?= $user->getCognome() ?></li>
    </ul>
</div>

<div class="input-form">
    <h3>Ufficio</h3>

    <form method="post" action="administrator/anagrafica<?= '?'.$vd->scriviToken()?>">
        <input type="hidden" name="cmd" value="personalInfo"/>
        <label for="via">Residence address :</label>
        <input type="text" name="via" id="via" value="<?= $user->getVia() ?>"/>
        <br>
        <label for="civico">Address number :</label>
        <input type="text" name="civico" id="civico" value="<?= $user->getNumeroCivico() ?>"/>
        <br/>
        <label for="citta">City :</label>
        <input type="text" name="citta" id="citta" value="<?= $user->getCitta() ?>"/>
        <br/>
        <label for="provincia">Disctrict :</label>
        <input type="text" name="provincia" id="provincia" value="<?= $user->getProvincia() ?>"/>
        <br/>
        <label for="cap">Zip code :</label>
        <input type="text" name="cap" id="cap" value="<?= $user->getCap() ?>"/>
        <br/>
        <input type="submit" value="Save"/>

    </form>
</div>
<div class="input-form">
    <h3>Contacts :</h3>

    <form method="post" action="administrator/anagrafica<?=$vd->scriviToken('?')?>">
        <input type="hidden" name="cmd" value="contatti"/>
        <label for="email">Email :</label>
        <input type="text" name="email" id="email"value="<?= $user->getEmail() ?>"/>
        <br/>
        <input type="submit" value="Save"/>
    </form>
</div>

<div class="input-form">
    <h3>Password</h3>
    <form method="post" action="administrator/anagrafica<?= $vd->scriviToken('?')?>">
        <input type="hidden" name="cmd" value="password"/>
        <label for="pass1">New Password :</label>
        <input type="password" name="pass1" id="pass1"/>
        <br/>
        <label for="pass2">Confirm password :</label>
        <input type="password" name="pass2" id="pass2"/>
        <br/>
        <input type="submit" value="Change password"/>
    </form>
</div>
