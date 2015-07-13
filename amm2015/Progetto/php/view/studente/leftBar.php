<h2 class="icon-title">User</h2>
<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="studente<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="studente/anagrafica<?= $vd->scriviToken('?')?>">My Infos</a></li>
    <li class="<?= $vd->getSottoPagina() == 'esami' ? 'current_page_item' : '' ?>"><a href="studente/esami<?= $vd->scriviToken('?')?>">View Bought Models</a></li>
    <li class="<?= $vd->getSottoPagina() == 'iscrizione' ? 'current_page_item' : '' ?>"><a href="studente/iscrizione<?= $vd->scriviToken('?')?>">Shop</a></li>
</ul>
