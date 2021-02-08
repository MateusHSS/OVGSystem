<?php
    include_once "../../config/conexao.php";

    $sap = $_POST['sap'];

    $sqlVerificaSAP = $connect->prepare("SELECT * FROM tabmaterial WHERE codigo_SAP = ?");
    $sqlVerificaSAP->bind_param("i", $sap);
    $sqlVerificaSAP->execute();

    $resultSAP = $sqlVerificaSAP->get_result();

    if($resultSAP->num_rows > 0){
        echo json_encode(false);
    }else{
        echo json_encode(true);
    }


?>