<?php
    include_once '../../config/conexao.php';

    $descricaoProcesso = $_POST['descricao_processo'];
    $tempoProcesso = $_POST['tempo_processo'];

    $sql = $connect->prepare("INSERT INTO tabprocesso (descricao, tempo) VALUES (?, ?)");
    $sql->bind_param('ss', $descricaoProcesso, $tempoProcesso);
    $sql->execute();

    if($sql->affected_rows > 0){
        echo json_encode(array("cod" => "1", "id" => $connect->insert_id));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }


?>