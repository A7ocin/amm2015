<?php

$json = array();
$json['errori'] = $errori;
$json['models'] = array();
foreach($models_f as $model){ //echo " (el_modelli_json foreach) ";
     /* @var $model Model */
    $element = array();
    $element['id'] = $model->getId();
    $element['data'] = $model->getData()->format('Y-m-d');
    $element['dimensione'] = $model->getDimensione();
    $element['nome'] = $model->getNome();
    $element['uploader'] = $model->getUploader();
    $element['descrizione'] = $model->getDescrizione();
    $json['models'][] = $element;
    
}
echo json_encode($json);
?>
