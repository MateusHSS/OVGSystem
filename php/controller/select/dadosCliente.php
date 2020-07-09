<?php

    include_once '../../config/conexao.php';

    $id = $_POST["id"];

    $sqlSelecionaDadosCliente = $connect->prepare("SELECT tabcliente.corredorcliente, tabcliente.idsetorcliente, tabcliente.ativo, tabcliente.idcliente, tabcliente.nomecliente, tabcliente.telefonecliente, tabsetor.nomesetor, tabcorredor.nomecorredor
                                                    FROM tabcliente
                                                INNER JOIN tabsetor ON tabcliente.idsetorcliente = tabsetor.idsetor
                                                INNER JOIN tabcorredor ON tabcorredor.idcorredor = tabcliente.corredorcliente
                                                WHERE tabcliente.idcliente = ?");
    $sqlSelecionaDadosCliente->bind_param("i", $id);
    $sqlSelecionaDadosCliente->execute();

    $resultDadosCliente = $sqlSelecionaDadosCliente->get_result();

    echo json_encode($resultDadosCliente->fetch_assoc());

?>