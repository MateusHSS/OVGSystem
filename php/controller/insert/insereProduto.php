<?php
    include_once '../../config/conexao.php';

    $produto = $_POST['nome_produto'];

    $sqlInsereProduto = $connect->prepare("INSERT INTO tabproduto (nomeproduto, datacadastro) VALUES (?, NOW())");
    $sqlInsereProduto->bind_param("s", $produto);
    $sqlInsereProduto->execute();

    if($sqlInsereProduto->affected_rows > 0){
        $idProduto = $connect->insert_id;

        foreach($_POST['material'] as $material){
            $idMaterial =  $material['id'];

            $sqlInsereMateriais = $connect->prepare("INSERT INTO tabmaterialproduto (idproduto, idmaterial) VALUES (?, ?)");
            $sqlInsereMateriais->bind_param("ii", $idProduto, $idMaterial);
            $sqlInsereMateriais->execute();

            if($sqlInsereMateriais->affected_rows <= 0){
                echo json_encode(array("cod" => 0, "erro" => $connect->error));
            }
        }

        echo json_encode(array("cod" => 1));
    }else{
        echo json_encode(array("erro" => $connect->error));
    }
    
?>