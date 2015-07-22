<?php

$json = array();
$json['errori'] = $errori;
$json['modelli'] = array();
foreach($modelli as $modello){ echo " (el_modelli_json foreach) ";
     /* @var $modello Modello */
    $element = array();
    $element['id'] = $modello->getId();
    $element['data'] = $modello->getData()->format('Y-m-d');
    $element['dimensione'] = $modello->getDimensione();
    $element['nome'] = $modello->getNome();
    $element['uploader'] = $modello->getUploader();
    $element['descrizione'] = $modello->getDescrizione();
    $json['modelli'][] = $element;
    
}
echo json_encode($json);
?>
