<h2 class="icon-title">User</h2>
<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="user/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="user/anagrafica<?= $vd->scriviToken('?')?>">Personal Infos</a></li>
    <li class="<?= $vd->getSottoPagina() == 'appelli' ? 'current_page_item' : '' ?>"><a href="user/modelli<?= $vd->scriviToken('?')?>">3d models database</a></li>
    <li class="<?= $vd->getSottoPagina() == 'reg_esami' ? 'current_page_item' : '' ?>"><a href="user/utenti<?= $vd->scriviToken('?')?>">Users list</a></li>
    <li class="<?= $vd->getSottoPagina() == 'el_modelli' ? 'current_page_item' : '' ?>"><a href="user/el_modelli<?= $vd->scriviToken('?')?>">Search Models</a></li>
</ul>
