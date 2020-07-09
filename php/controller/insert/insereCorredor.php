<?php
    include_once '../../config/conexao.php';

    $nomeCorredor = $_POST['nome_corredor'];

    $sql = $connect->prepare("INSERT INTO tabcorredor (nomecorredor) VALUES (?)");
    $sql->bind_param('s', $nomeCorredor);
    $sql->execute();

    if($sql->affected_rows > 0){
        echo json_encode(array("cod" => "1", "id" => $connect->insert_id));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }



?>