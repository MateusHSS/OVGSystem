<?php

    include_once '../../config/conexao.php';

    $sqlSelecionaNomeMaterial = $connect->prepare("SELECT tabmaterial.idmaterial, tabmaterial.codigo_SAP, tabmaterial.nomematerial, tabmaterial.peso_KG FROM tabmaterial");
    $sqlSelecionaNomeMaterial->execute();

    $resultNomeMaterial = $sqlSelecionaNomeMaterial->get_result();

    $dados = array();
    $saps = array();
    $ids = array();
    $pesos = array();

    while($resNomeMaterial = $resultNomeMaterial->fetch_assoc()){
        array_push($dados, $resNomeMaterial['codigo_SAP']." - ".$resNomeMaterial['nomematerial']);
        array_push($saps, $resNomeMaterial['codigo_SAP']);
        array_push($ids, $resNomeMaterial['idmaterial']);
        array_push($pesos, $resNomeMaterial['peso_KG']);
    }

    echo json_encode(array("nomes" => $dados, "saps" => $saps, "ids" => $ids, "pesos" => $pesos));

?>