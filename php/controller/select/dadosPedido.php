<?php

    include_once '../../config/conexao.php';

    $id = $_POST["id"];

    $sqlSelecionaDadosPedido = $connect->prepare("SELECT tabpedido.idpedido, tabpedido.emergencial, tabcliente.nomecliente, tabproduto.nomeproduto, tabpedido.quantidadepedido, tabpedido.altura, tabpedido.largura, tabpedido.espessura, tabpedido.statuspedido, tabstatus.nomestatus, tabpedido.atividade, tabatividade.descricao AS nomeatividade, tabpedido.seguranca, tabseguranca.descricao AS nomeseguranca, tabpedido.formulariopedido, DATEDIFF (NOW(), tabpedido.datainclusao) AS quantidade_dias
                                                    FROM tabpedido
                                                INNER JOIN tabcliente ON tabcliente.idcliente = tabpedido.clientepedido
                                                INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido
                                                INNER JOIN tabstatus ON tabstatus.idtabstatus = tabpedido.statuspedido
                                                INNER JOIN tabatividade ON tabatividade.idtabatividade = tabpedido.atividade
                                                INNER JOIN tabseguranca	ON tabseguranca.idtabseguranca = tabpedido.seguranca
                                                WHERE tabpedido.idpedido = ?");
    $sqlSelecionaDadosPedido->bind_param("i", $id);
    $sqlSelecionaDadosPedido->execute();

    $resultDadosPedido = $sqlSelecionaDadosPedido->get_result();

    echo json_encode($resultDadosPedido->fetch_assoc());

?>