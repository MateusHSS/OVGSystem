<?php
    include_once '../../config/conexao.php';

    $id = $_GET['id'];
    $nomeSetor = $_POST['nome-setor'];
    $corredor = $_GET['corredor-setor'];

    $sql = $connect->prepare("UPDATE tabsetor SET nomesetor = ?, idcorredor = ? WHERE idsetor = ?");
    $sql->bind_param('sii', $nomeSetor, $corredor, $id);
    $sql->execute();

    if($sql->affected_rows == 0){
        echo "<script type='text/javascript'>alert('Erro ao atualizar informações!'); window.location.href='../../consulta/listaSetor.php';</script>";
        $sql->close();
    }else{
        $sql->close();
        echo "<script type='text/javascript'>alert('Informações atualizadas com sucesso!'); window.location.href='../../consulta/listaSetor.php';</script>";
    }

?>