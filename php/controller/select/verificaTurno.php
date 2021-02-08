<?php

    include_once "../../config/conexao.php";

    $turno = $_POST['turno'];
    $data = $_POST['data'];

    $dataDividida = explode('/', $data);
    $dia = $dataDividida[0];
    $mes = $dataDividida[1];
    $ano = $dataDividida[2];

    $data = $ano.'-'.$mes.'-'.$dia;

    $sql = $connect->prepare("SELECT * FROM tabhorariodiario WHERE turno = $turno AND data = '$data'");
    $sql->execute();

    $result = $sql->get_result();

    if($result->num_rows >0){
        echo json_encode(array('cod' => '1', 'turno' => $turno, 'data' => $data)); 
    }else{
        echo json_encode(array('cod' => '0', 'turno' => $turno, 'data' => $data)); 
    }


?>