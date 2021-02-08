<?php
    include_once '../../config/conexao.php';

    $id = $_POST['id'];
    $nome = $_POST['nome_cliente'];
    $telefone = $_POST['telefone_cliente'];
    $setor = $_POST['setor_cliente'];
    $corredor = $_POST['corredor_cliente'];

    if(isset($_POST['ativo'])){
        $ativo = 1;
    }else{
        $ativo = 0;
    }

    $sql = $connect->prepare("UPDATE tabcliente SET nomecliente = ?, telefonecliente = ?, idsetorcliente = ?, corredorcliente = ?, ativo = ? WHERE idcliente = ?");
    $sql->bind_param('sssssi', $nome, $telefone, $setor, $corredor, $ativo, $id);
    $sql->execute();

    $result = $sql->get_result();

    if($sql->affected_rows == 0){
        echo json_encode(array("cod" => '0'));
    }else{
        $sql->close();
        echo json_encode(array("cod" => '1'));
    }


    


?>