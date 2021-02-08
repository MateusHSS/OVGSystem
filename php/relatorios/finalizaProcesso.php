<?php
    include_once "../../config/conexao.php";

    $pedido = $_POST['pedido'];

    

    foreach($_POST['processo'] as $processo){
        $idProcesso = $processo['id'];

        $sqlSelecionaIdTab = $connect->prepare("SELECT tabprocessosproduto.idtabprocessosproduto FROM tabprocessosproduto WHERE idproduto = ? AND idprocesso = ?");
        $sqlSelecionaIdTab->bind_param("ii", $pedido, $idProcesso);
        $sqlSelecionaIdTab->execute();
        $resultIdTab = $sqlSelecionaIdTab->get_result();

        while($resIdTab = $resultIdTab->fetch_assoc()){
            $idTabProcProd = $resIdTab['idtabprocessosproduto'];

            $sqlFinalizaProcesso = $connect->prepare("UPDATE tabprocessosproduto SET finalizado = 1, final_real = NOW() WHERE idtabprocessosproduto = ?");
            $sqlFinalizaProcesso->bind_param("i", $idTabProcProd);
            $sqlFinalizaProcesso->execute();

            if($sqlFinalizaProcesso->affected_rows <= 0){
                echo json_encode(array("cod" => 0, "id" => $idProcesso, "erro" => $connect->error));
            }
        }
    }

    $sqlVerificaUltimoProc = $connect->prepare("SELECT finalizado FROM tabprocessosproduto WHERE idproduto = ?");
    $sqlVerificaUltimoProc->bind_param("i", $pedido);
    $sqlVerificaUltimoProc->execute();
    $resultUltimoProcesso = $sqlVerificaUltimoProc->get_result();

    $pedNaoTerminado = 0;
    
    while($resUltimoProcesso = $resultUltimoProcesso->fetch_assoc()){
        
        if($resUltimoProcesso['finalizado'] == 0){
            $pedNaoTerminado = 1;
            break;
        }
    }

    if($pedNaoTerminado){
        echo json_encode(array("cod" => '1', "msg" => "Processo(s) finalizado(s) com sucesso!", "class" => "green"));
    }else{
        $sqlFinalizaPedido = $connect->prepare("UPDATE tabpedido SET statuspedido = 5, final_real = NOW() WHERE idpedido = ?");
        $sqlFinalizaPedido->bind_param("i", $pedido);
        $sqlFinalizaPedido->execute();
        echo json_encode(array("cod" => '2', "msg" => "Processo finalizado com sucesso!", "class" => "green", "alert" => "Todos os processos desse pedido foram finalizados, pedido concluido!"));
    }

?>