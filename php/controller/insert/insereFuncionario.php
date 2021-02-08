<?php
    include_once '../../config/conexao.php';

    $nome = $_POST['nome_funcionario'];
    $matricula = $_POST['matricula_funcionario'];
    $empresa = $_POST['empresa_funcionario'];
    $turno = $_POST['turno_funcionario'];

    $sql = $connect->prepare("INSERT INTO tabfuncionario (nome, matricula, empresa, turno) VALUES (?, ?, ?, ?)");
    $sql->bind_param('ssss', $nome, $matricula, $empresa, $turno);
    $sql->execute();

    if($sql->affected_rows > 0){
        echo json_encode(array("cod" => "1", "id" => $connect->insert_id));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }




?>