<?php
    include_once '../../config/conexao.php';

    $nomeMaterial = $_POST['nome_material'];
    $SAP = $_POST['sap'];
    $pesoMaterial = $_POST['peso_material'];


    $sql = $connect->prepare("INSERT INTO tabmaterial (nomematerial, codigo_SAP, peso_KG) VALUES (?, ?, ?)");
    $sql->bind_param('sis', $nomeMaterial, $SAP, $pesoMaterial);
    $sql->execute();

    if($sql->affected_rows > 0){
        echo json_encode(array("cod" => "1", "id" => $connect->insert_id));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }

?>