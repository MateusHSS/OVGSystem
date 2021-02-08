<?php
    include_once '../../config/conexao.php';

    $nome = $_POST['nome_cliente'];
    $telefone = $_POST['telefone_cliente'];
    $setor = $_POST['setor_cliente'];
    $corredor = $_POST['corredor_cliente'];

    $sql = $connect->prepare("INSERT INTO tabcliente (nomecliente, telefonecliente, idsetorcliente, datacadastrocliente, corredorcliente) VALUES (?, ?, ?, now(), ?)");
    $sql->bind_param('ssss', $nome, $telefone, $setor, $corredor);
    $sql->execute();

    if($sql->affected_rows > 0){
        echo json_encode(array("cod" => "1", "id" => $connect->insert_id));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }

    




?>