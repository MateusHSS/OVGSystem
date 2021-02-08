<?php
    include_once '../../config/conexao.php';

    $id = $_GET['id'];
    $nome = $_POST['nome-corredor'];
    
    $sql = $connect->prepare("UPDATE tabcorredor SET nomecorredor = upper(?) WHERE idcorredor = $id");
    $sql->bind_param('s', $nome);
    $sql->execute();

    $result = $sql->get_result();

    if($sql->affected_rows == 0){
        $sql->close();
        echo "<script type='text/javascript'>alert('Nenhum registro atualizado!');window.location.href='../../consulta/listaCorredor.php';</script>";
    }else{
        $sql->close();
        echo "<script type'text/javascript'>alert('Corredor atualizado com sucesso!'); window.location.href = '../../consulta/listaCorredor.php';</script>";
    }


    


?>