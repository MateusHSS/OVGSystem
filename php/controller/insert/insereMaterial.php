<?php
    include_once '../../config/conexao.php';

    $nomeMaterial = $_POST['nome_material'];
    $SAP = $_POST['sap'];
    $pesoMaterial = $_POST['peso_material'];

    //INSERE O MATERIAL NA TABELA DE MATERIAIS
    $sql = $connect->prepare("INSERT INTO tabmaterial (nomematerial, codigo_SAP, peso_KG) VALUES (?, ?, ?)");
    $sql->bind_param('sss', $nomeMaterial, $SAP, $pesoMaterial);
    $sql->execute();

    if($sql->affected_rows > 0){
        //INSERE O MATERIAL NA TABELA DE ESTOQUE
        $sqlInsereNoEstoque = $connect->prepare("INSERT INTO tabestoque (SAP_material, quantidade, KG) VALUES (?, 0, 0)");
        $sqlInsereNoEstoque->bind_param("s", $SAP);
        $sqlInsereNoEstoque->execute();

        if($sqlInsereNoEstoque->affected_rows > 0){
            echo json_encode(array("cod" => "1", "id" => $connect->insert_id));
        }else{
            echo json_encode(array("cod" => "0", "erro" => $connect->error));
        }
        
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }

?>