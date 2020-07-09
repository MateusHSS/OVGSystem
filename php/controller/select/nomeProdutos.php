<?php

    include_once '../../config/conexao.php';

    $sqlSelecionaNomeProduto = $connect->prepare("SELECT tabproduto.idproduto, tabproduto.nomeproduto FROM tabproduto");
    $sqlSelecionaNomeProduto->execute();

    $resultNomeProduto = $sqlSelecionaNomeProduto->get_result();

    $dados = array(); 
    $ids = array();

    while($resNomeProduto = $resultNomeProduto->fetch_assoc()){
        array_push($dados, $resNomeProduto['nomeproduto']);
        array_push($ids, $resNomeProduto['idproduto']);
    }

    echo json_encode(array("nomes" => $dados, "ids" => $ids));

?>