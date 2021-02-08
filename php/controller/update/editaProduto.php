<?php
    include_once '../../config/conexao.php';

    $id = $_GET['id'];
    $nomeProduto = $_POST['nome-produto'];

    echo $nomeProduto;
    echo $id;

    $sql = $connect->prepare("UPDATE tabproduto SET nomeproduto = ? WHERE idproduto = ?");
    $sql->bind_param('si', $nomeProduto, $id);
    $sql->execute();

    if($sql->affected_rows == 0){
        echo "<script type='text/javascript'>alert('Erro ao atualizar informações!'); window.location.href='../../consulta/listaProduto.php';</script>";
        $sql->close();
    }else{
        $sql->close();
        echo "<script type='text/javascript'>alert('Informações atualizadas com sucesso!'); window.location.href='../../consulta/listaProduto.php';</script>";
    }

?>