<?php

    include_once '../../config/conexao.php';

    $id = $_POST["id"];

    $sqlSelecionaDadosMaterial = $connect->prepare("SELECT * FROM tabmaterial WHERE tabmaterial.idmaterial = ?");
    $sqlSelecionaDadosMaterial->bind_param("i", $id);
    $sqlSelecionaDadosMaterial->execute();

    $resultDadosMaterial = $sqlSelecionaDadosMaterial->get_result();

    echo json_encode($resultDadosMaterial->fetch_assoc());

?>