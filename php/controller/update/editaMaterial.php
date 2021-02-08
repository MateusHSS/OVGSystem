<?php
    include_once '../../config/conexao.php';

    $id = $_GET['id'];
    $nomeMaterial = $_POST['nome-material'];

    $sql = $connect->prepare("UPDATE tabmaterial SET nomematerial = ? WHERE idmaterial = ?");
    $sql->bind_param('si', $nomeMaterial, $id);
    $sql->execute();

    if($sql->affected_rows == 0){
        echo "<script type='text/javascript'>alert('Erro ao atualizar informações!'); window.location.href='../../consulta/listaMaterial.php';</script>";
        $sql->close();
    }else{
        $sql->close();
        echo "<script type='text/javascript'>alert('Informações atualizadas com sucesso!'); window.location.href='../../consulta/listaMaterial.php';</script>";
    }

?>