<?php
    include_once "../../config/conexao.php";

    $idPedido = $_POST['id'];

    $sqlVerificaPedido = $connect->prepare("SELECT tabpedido.statuspedido FROM tabpedido WHERE idpedido = ?");
    $sqlVerificaPedido->bind_param("i", $idPedido);
    $sqlVerificaPedido->execute();
    $resultVerPedido = $sqlVerificaPedido->get_result();

    $resVerPedido = $resultVerPedido->fetch_assoc();

    if($resVerPedido['statuspedido'] == 1){
        $sqlExcluiPedidoTabPedido = $connect->prepare("DELETE tabpedido.* FROM tabpedido WHERE tabpedido.idpedido = ?");
        $sqlExcluiPedidoTabPedido->bind_param("i", $idPedido);
        $sqlExcluiPedidoTabPedido->execute();
    }else{
        $sqlExcluiPedidoTabPedido = $connect->prepare("DELETE tabpedido.* FROM tabpedido WHERE tabpedido.idpedido = ?");
        
        $sqlExcluiPedidoTabPedidosDia = $connect->prepare("DELETE tabpedidos_dia.* FROM tabpedidos_dia WHERE tabpedidos_dia.id_pedido = ?");
        
        $sqlExcluiPedidoTabProcessosProduto = $connect->prepare("DELETE tabprocessosproduto.* FROM tabprocessosproduto WHERE tabprocessosproduto.idproduto = ?");

        $sqlExcluiPedidoTabPedido->bind_param("i", $idPedido);
        $sqlExcluiPedidoTabPedidosDia->bind_param("i", $idPedido);
        $sqlExcluiPedidoTabProcessosProduto->bind_param("i", $idPedido);

        $sqlExcluiPedidoTabPedido->execute();
        $sqlExcluiPedidoTabPedidosDia->execute();
        $sqlExcluiPedidoTabProcessosProduto->execute();
    }

    if($sqlExcluiPedidoTabPedido->affected_rows > 0){
        require_once "../update/ordenaPedidos.php";
        echo json_encode(array("cod" => "1"));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }

?>