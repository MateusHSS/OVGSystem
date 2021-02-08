<?php

    include_once '../../config/conexao.php';

    $option = $_GET["option"];
    $data = $_GET["data"];
    $id = $_GET["id"];

    switch ($option){
        case 1:
            // deleta o horário pedido e suas máquinas
            $sql = "DELETE FROM tabhorariodiario WHERE idtabhorariodiario = ".$id;
            $executa = $connect->prepare($sql);
            $executa->execute();
            
            $sql = "DELETE FROM `tabmaquinasdisponiveis` WHERE data = '".$data."'";
            $executa = $connect->prepare($sql);
            $executa->execute();

            // atualiza os processos do turno para n escalonados
            $sql = "UPDATE `tabprocessosproduto` SET `escalonado` = 0, `idmaquina` = null, `pros_inicial` = null, `pros_final` = null, `finalizado` = 0, `final_real` = null WHERE pros_inicial LIKE '%".$data."%'";
            $executa = $connect->prepare($sql);
            $executa->execute();

            break;

        case 2:
            // deleta a máquina da data desejada
            $sql = "DELETE FROM `tabmaquinasdisponiveis` WHERE idtabmaquinasdisponiveis = ".$id;
            $executa = $connect->prepare($sql);
            $executa->execute();

            // atualiza os processos q utilizavam a máquina para n escalonados
            $sql = "UPDATE `tabprocessosproduto` SET `escalonado` = 0, `idmaquina` = null, `pros_inicial` = null, `pros_final` = null, `finalizado` = 0, `final_real` = null WHERE idmaquina = ".$id;
            $executa = $connect->prepare($sql);
            $executa->execute();
            
            break;
    }

    // redireciona para a criação de novos turnos q possam substituir os excluídos
    include_once '../insert/turno-maquina.php';

    header('Location: ../../consulta/turno.php');

?>