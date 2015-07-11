<ul>
    <li class="<?= strpos($vd->getSottoPagina(),'home') !== false || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="docente/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'anagrafica') !== false ? 'current_page_item' : '' ?>"><a href="docente/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= strpos($vd->getSottoPagina(), 'appelli') !== false ? 'current_page_item' : '' ?>"><a href="docente/appelli<?= $vd->scriviToken('?')?>">Appelli</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'reg_esami') !== false ? 'current_page_item' : '' ?>"><a href="docente/reg_esami<?= $vd->scriviToken('?')?>">Registrazione</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'el_esami') !== false ? 'current_page_item' : '' ?>"><a href="docente/el_esami<?= $vd->scriviToken('?')?>">Elenco Esami</a></li>
</ul>