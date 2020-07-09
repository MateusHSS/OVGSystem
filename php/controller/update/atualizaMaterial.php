<?php
    include_once '../../config/conexao.php';

    $id = $_POST['id'];
    $nome = $_POST['nome_material'];

    $sql = $connect->prepare("UPDATE tabmaterial SET nomematerial = ? WHERE idmaterial = ?");
    $sql->bind_param('si', $nome, $id);
    $sql->execute();

    $result = $sql->get_result();

    if($sql->affected_rows == 0){
        echo json_encode(array("cod" => '0'));
    }else{
        $sql->close();
        echo json_encode(array("cod" => '1'));
    }

?>