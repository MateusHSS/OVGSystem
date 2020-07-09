<?php
    include_once "../../config/conexao.php";

    $idPedido = $_POST['id'];

    $sqlVerificaPedido = $connect->prepare("SELECT tabpedido.statuspedido FROM tabpedido WHERE idpedido =?");
    $sqlVerificaPedido->bind_param("i", $idPedido);
    $sqlVerificaPedido->execute();
    $resultVerPedido = $sqlVerificaPedido->get_result();

    $resVerPedido = $resultVerPedido->fetch_assoc();

    if($resVerPedido['statuspedido'] == 1){
        $sqlExcluiPedido = $connect->prepare("DELETE tabpedido.* FROM tabpedido WHERE tabpedido.idpedido = ?");
    }else{
        $sqlExcluiPedido = $connect->prepare("DELETE tabpedido.*, tabpedidos_dia.*, tabprocessosproduto.* FROM tabpedido
                                                INNER JOIN tabpedidos_dia ON tabpedidos_dia.id_pedido = tabpedido.idpedido
                                                INNER JOIN tabprocessosproduto ON tabprocessosproduto.idproduto = tabpedido.idpedido
                                            WHERE tabpedido.idpedido = ?");
    }
    $sqlExcluiPedido->bind_param("i", $idPedido);
    $sqlExcluiPedido->execute();

    if($sqlExcluiPedido->affected_rows > 0){
        require_once "../update/ordenaPedidos.php";
        echo json_encode(array("cod" => "1"));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }

?>