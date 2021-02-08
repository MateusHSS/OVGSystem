<?php
    include_once "../../config/conexao.php";

    $sqlExcluiCliente = $connect->prepare("DELETE FROM tabcliente WHERE idcliente = ?");
    $sqlExcluiCliente->bind_param("i", $_POST['id']);
    $sqlExcluiCliente->execute();

    if($sqlExcluiCliente->affected_rows > 0){
        echo json_encode(array("cod" => "1", "msg" => "Paciente excluído com sucesso!", "class" => "green"));
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir paciente selecionado", "erro" => $_POST['id'], "class" => "red"));
    }


?>