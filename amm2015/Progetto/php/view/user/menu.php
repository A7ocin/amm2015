<ul>
    <li class="<?= strpos($vd->getSottoPagina(),'home') !== false || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="utente/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'anagrafica') !== false ? 'current_page_item' : '' ?>"><a href="utente/anagrafica<?= $vd->scriviToken('?')?>">Personal Infos</a></li>
    <li class="<?= strpos($vd->getSottoPagina(), 'appelli') !== false ? 'current_page_item' : '' ?>"><a href="utente/appelli<?= $vd->scriviToken('?')?>">3d models database</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'reg_esami') !== false ? 'current_page_item' : '' ?>"><a href="utente/reg_esami<?= $vd->scriviToken('?')?>">Registrazione</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'el_esami') !== false ? 'current_page_item' : '' ?>"><a href="user/el_esami<?= $vd->scriviToken('?')?>">Elenco Esami</a></li>
</ul>