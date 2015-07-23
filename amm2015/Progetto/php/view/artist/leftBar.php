<h2 class="icon-title">Artist</h2>
<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="artist/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="artist/anagrafica<?= $vd->scriviToken('?')?>">Personal Infos</a></li>
    <li class="<?= $vd->getSottoPagina() == 'appelli' ? 'current_page_item' : '' ?>"><a href="artist/modelli<?= $vd->scriviToken('?')?>">3d models database</a></li>
    <li class="<?= $vd->getSottoPagina() == 'reg_esami' ? 'current_page_item' : '' ?>"><a href="artist/utenti<?= $vd->scriviToken('?')?>">Users List</a></li>
    <li class="<?= $vd->getSottoPagina() == 'el_modelli' ? 'current_page_item' : '' ?>"><a href="artist/el_modelli<?= $vd->scriviToken('?')?>">Search Models</a></li>
</ul>
