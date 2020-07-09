<?php
    include_once '../../config/conexao.php';

    $id = $_GET['id'];

    $sql = $connect->prepare("DELETE FROM tabcorredor WHERE idcorredor = $id");
    $sql->execute();

    if($sql->affected_rows == 0){
        echo "<script type='text/javascript'>alert('Erro ao excluir corredor!');window.location.href='../../consulta/listaCorredor.php';</script>";
    }else{
        $sql->close();
        header('location: ../../consulta/listaCorredor.php');
    }


?>