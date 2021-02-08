<?php

    include_once "../../config/conexao.php";

    $produto = $_POST['nome_produto'];

    $sql = $connect->prepare("SELECT * FROM tabproduto WHERE nomeproduto = '$produto'");
    $sql->execute();

    $result = $sql->get_result();

    if($result->num_rows > 0){
        echo json_encode(false);
    }else{
        echo json_encode(true);
    }


?>