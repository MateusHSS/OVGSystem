<?php
    include_once "../config/conexao.php";

    $sqlSelecionaPedidosAtrasados = $connect->prepare("SELECT tabpedido.idpedido FROM tabpedido WHERE previsao < NOW() AND tabpedido.statuspedido = 6");
    $sqlSelecionaPedidosAtrasados->execute();

    $resultPedidosAtrasados = $sqlSelecionaPedidosAtrasados->get_result();

    while($resPedAtrasado = $resultPedidosAtrasados->fetch_assoc()){
        $sqlUpdatePedidosAtrasados = $connect->prepare("UPDATE tabpedido SET statuspedido = 8 WHERE idpedido = ?");
        $sqlUpdatePedidosAtrasados->bind_param('i', $resPedAtrasado['idpedido']);
        $sqlUpdatePedidosAtrasados->execute();
    }

    $sqlSelecionaPedidosNaoAtrasados = $connect->prepare("SELECT tabpedido.idpedido FROM tabpedido WHERE previsao >= NOW() AND tabpedido.statuspedido = 8");
    $sqlSelecionaPedidosNaoAtrasados->execute();

    $resultPedidosNaoAtrasados = $sqlSelecionaPedidosNaoAtrasados->get_result();

    while ($resPedNaoAtrasados = $resultPedidosNaoAtrasados->fetch_assoc()){
        $sqlUpdatePedidosNaoAtrasados = $connect->prepare("UPDATE tabpedido SET statuspedido = 6 WHERE idpedido = ?");
        $sqlUpdatePedidosNaoAtrasados->bind_param('i', $resPedNaoAtrasados['idpedido']);
        $sqlUpdatePedidosNaoAtrasados->execute();
    }

?>