<?php

$json = array();
$json['errori'] = $errori;
$json['esami'] = array();
foreach($esami as $esame){
     /* @var $esame Esame */
    $element = array();
    $element['insegnamento'] = $esame->getInsegnamento()->getTitolo();
    $element['cfu'] = $esame->getInsegnamento()->getCfu();
    $element['matricola'] = $esame->getStudente()->getMatricola();
    $element['nome'] = $esame->getStudente()->getNome();
    $element['cognome'] = $esame->getStudente()->getCognome();
    $element['voto'] = $esame->getVoto();
    $element['commissione'] = array();
    foreach($esame->getCommissione() as $artist){
         /* @var $artist Artist */
        $element['commissione'][] =  $artist->getNome() . ' ' . $artist->getCognome();
    }
    $json['esami'][] = $element;
    
}
echo json_encode($json);
?>
