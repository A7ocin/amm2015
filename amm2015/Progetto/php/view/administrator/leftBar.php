<h2 class="icon-title">Administrator</h2>
<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="administrator/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="administrator/anagrafica<?= $vd->scriviToken('?')?>">Personal Infos</a></li>
    <li class="<?= $vd->getSottoPagina() == 'appelli' ? 'current_page_item' : '' ?>"><a href="administrator/modelli<?= $vd->scriviToken('?')?>">3d models database</a></li>
    <li class="<?= $vd->getSottoPagina() == 'reg_esami' ? 'current_page_item' : '' ?>"><a href="administrator/reg_esami<?= $vd->scriviToken('?')?>">Registrazione Esami</a></li>
    <li class="<?= $vd->getSottoPagina() == 'el_esami' ? 'current_page_item' : '' ?>"><a href="administrator/el_esami<?= $vd->scriviToken('?')?>">Elenco Esami</a></li>
</ul>