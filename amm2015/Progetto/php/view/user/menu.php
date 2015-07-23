<ul>
    <li class="<?= strpos($vd->getSottoPagina(),'home') !== false || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="user/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'anagrafica') !== false ? 'current_page_item' : '' ?>"><a href="user/anagrafica<?= $vd->scriviToken('?')?>">Personal Infos</a></li>
    <li class="<?= strpos($vd->getSottoPagina(), 'modelli') !== false ? 'current_page_item' : '' ?>"><a href="user/modelli<?= $vd->scriviToken('?')?>">3d models database</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'utenti') !== false ? 'current_page_item' : '' ?>"><a href="user/utenti<?= $vd->scriviToken('?')?>">Users list</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'el_modelli') !== false ? 'current_page_item' : '' ?>"><a href="user/el_modelli<?= $vd->scriviToken('?')?>">Search Models</a></li>
</ul>
