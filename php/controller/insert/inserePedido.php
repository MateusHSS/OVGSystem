<?php
    include_once '../../config/conexao.php';

    $idClientePedido = $_POST['cliente'];
    $nomeClientePedido = $_POST['cliente_pedido'];
    $produtoPedido = $_POST['produto'];
    $quantidadePedido = $_POST['qtd_pedido'];
    $dimensaoPedido = $_POST['dimensao_pedido'];
    $atividadePedido = $_POST['atividade_pedido'];
    $segurancaPedido = $_POST['seguranca_pedido'];
    $obs = $_POST['obs_pedido'];

    $nomeArq= $_FILES['formulario_pedido']['name'];
    $pastaArq= '../../formulariosPedidos/'.$_FILES['formulario_pedido']['name'];

    if(isset($_POST['emerg'])){
        $emerg = 2;
    }else{
        $emerg = 0;
    }

    if($nomeArq != ''){

        $sql = $connect->prepare("INSERT INTO tabpedido (clientepedido, produtopedido, quantidadepedido, dimensaopedido, formulariopedido, atividade, seguranca, datainclusao, emergencial, obs) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)");
        $sql->bind_param('sssssssis', $idClientePedido, $produtoPedido, $quantidadePedido, $dimensaoPedido, $nomeArq, $atividadePedido, $segurancaPedido, $emerg, $obs);
        $sql->execute();

        if($sql->affected_rows > 0 && move_uploaded_file($_FILES['formulario_pedido']['tmp_name'], $pastaArq)){
            echo json_encode(array("cod" => "1", "id" => $connect->insert_id, "opc" => '2'));
        }else{
            echo json_encode(array("cod" => "0", "erro" => $connect->error, "opc" => '2'));
        }

    }else{

        $sql = $connect->prepare("INSERT INTO tabpedido (clientepedido, produtopedido, quantidadepedido, dimensaopedido, atividade, seguranca, datainclusao, emergencial, obs) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)");
        $sql->bind_param('ssssssis', $idClientePedido, $produtoPedido, $quantidadePedido, $dimensaoPedido, $atividadePedido, $segurancaPedido, $emerg, $obs);
        $sql->execute();

        if($sql->affected_rows > 0){
            echo json_encode(array("cod" => "1", "id" => $connect->insert_id, "opc" => '3', "dados" => $_POST));
        }else{
            echo json_encode(array("cod" => "0", "erro" => $connect->error, "opc" => '4', "dados" => $_POST));
        }

    }

    

?>