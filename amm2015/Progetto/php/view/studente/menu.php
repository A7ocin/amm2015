<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="studente<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="studente/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= $vd->getSottoPagina() == 'esami' ? 'current_page_item' : '' ?>"><a href="studente/esami<?= $vd->scriviToken('?')?>">Libretto</a></li>
    <li class="<?= $vd->getSottoPagina() == 'iscrizione' ? 'current_page_item' : '' ?>"><a href="studente/iscrizione<?= $vd->scriviToken('?')?>">Iscrizione</a></li>
</ul>