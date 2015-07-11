<h2 class="icon-title">Docente</h2>
<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="docente/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="docente/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= $vd->getSottoPagina() == 'appelli' ? 'current_page_item' : '' ?>"><a href="docente/appelli<?= $vd->scriviToken('?')?>">Appelli</a></li>
    <li class="<?= $vd->getSottoPagina() == 'reg_esami' ? 'current_page_item' : '' ?>"><a href="docente/reg_esami<?= $vd->scriviToken('?')?>">Registrazione Esami</a></li>
    <li class="<?= $vd->getSottoPagina() == 'el_esami' ? 'current_page_item' : '' ?>"><a href="docente/el_esami<?= $vd->scriviToken('?')?>">Elenco Esami</a></li>
</ul>
