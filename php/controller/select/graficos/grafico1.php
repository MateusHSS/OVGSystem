<?php
    include_once "../../../config/conexao.php";

    $sqlSelecionaEntregues = $connect->prepare("SELECT COUNT(*) AS entregues FROM tabpedido WHERE final_real >= '2020-07-01' AND final_real <= '2020-07-27'");
    $sqlSelecionaEntregues->execute();
    $resultEntregues = $sqlSelecionaEntregues->get_result();
    $resEntregues = $resultEntregues->fetch_assoc();

    $sqlSelecionaPrevistos = $connect->prepare("SELECT COUNT(*) AS previstos FROM tabpedido WHERE previsao >= '2020-07-01' AND previsao <= '2020-07-27'");
    $sqlSelecionaPrevistos->execute();
    $resultPrevistos = $sqlSelecionaPrevistos->get_result();
    $resPrevistos = $resultPrevistos->fetch_assoc();
    
    $diferenca = (int)$resPrevistos - (int)$resEntregues;

    $output = array(
        'previsto' => $resPrevistos,
        'entregue' => $resEntregues
    );

    echo json_encode($output)
?>