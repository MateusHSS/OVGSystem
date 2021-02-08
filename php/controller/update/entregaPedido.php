<?php

    include_once '../../config/conexao.php';

    $id = $_POST["id"];
    $status = 7;

    $verificaAtraso = $connect->prepare("SELECT tabpedido.previsao, tabpedido.final_real FROM tabpedido WHERE tabpedido.idpedido = ?");
    $verificaAtraso->bind_param("i", $id);
    $verificaAtraso->execute();
    $resultAtraso = $verificaAtraso->get_result();

    $resAtraso = $resultAtraso->fetch_assoc();

    if($resAtraso['final_real'] > $resAtraso['previsao']){
        $status = 9;
    }

    $sqlAtualizaStatusPedido = $connect->prepare("UPDATE tabpedido SET statuspedido = ? WHERE idpedido = ?");
    $sqlAtualizaStatusPedido->bind_param("ii", $status, $id);
    $sqlAtualizaStatusPedido->execute();

    if($sqlAtualizaStatusPedido->affected_rows > 0){
        echo json_encode(array("cod" => '1'));
    }

?>