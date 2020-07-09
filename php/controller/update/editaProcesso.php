<?php
    include_once '../../config/conexao.php';

    $id = $_GET['id'];
    $nomeProcesso = $_POST['nome-processo'];
    $tempo = $_POST['tempo-processo'];

    $sql = $connect->prepare("UPDATE tabprocesso SET descricao = ?, tempo = ? WHERE idtabprocesso = ?");
    $sql->bind_param('ssi', $nomeProcesso, $tempo, $id);
    $sql->execute();

    if($sql->affected_rows == 0){
        echo "<script type='text/javascript'>alert('Erro ao atualizar informações!'); window.location.href='../../consulta/listaProcessos.php';</script>";
        $sql->close();
    }else{
        $sql->close();
        echo "<script type='text/javascript'>alert('Informações atualizadas com sucesso!'); window.location.href='../../consulta/listaProcessos.php';</script>";
    }

?>