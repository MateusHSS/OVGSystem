<?php
    include_once '../../config/conexao.php';

    $descricaoAtividade = $_POST['descricao_atividade'];
    $pesoAtividade = $_POST['peso_atividade'];

    $sql = $connect->prepare("INSERT INTO tabatividade (descricao, peso) VALUES (?, ?)");
    $sql->bind_param('ss', $descricaoAtividade, $pesoAtividade);
    $sql->execute();

    if($sql->affected_rows > 0){
        echo json_encode(array("cod" => "1", "id" => $connect->insert_id));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }


?>