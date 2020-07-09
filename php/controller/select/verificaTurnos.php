<?php
    include_once "../../config/conexao.php";

    $data = $_POST['dataT'];

    $sql = $connect->prepare("SELECT * FROM tabhorariodiario WHERE data = '$data' ");
    $sql->execute();

    $result = $sql->get_result();

    if($result->num_rows >0){
        echo json_encode(array('cod' => '1', 'data' => $data)); 
    }else{
        echo json_encode(array('cod' => '0', 'data' => $data )); 
    }



?>