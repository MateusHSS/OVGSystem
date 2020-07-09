<?php

    include_once '../../config/conexao.php';

    $sqlSelecionaNomeCliente = $connect->prepare("SELECT tabcliente.idcliente, tabcliente.nomecliente FROM tabcliente");
    $sqlSelecionaNomeCliente->execute();

    $resultNomeCliente = $sqlSelecionaNomeCliente->get_result();

    $dados = array();
    $ids = array();

    while($resNomeCliente = $resultNomeCliente->fetch_assoc()){
        array_push($dados, $resNomeCliente['nomecliente']);
        array_push($ids, $resNomeCliente['idcliente']);
    }

    echo json_encode(array("nomes" => $dados, "ids" => $ids));

?>