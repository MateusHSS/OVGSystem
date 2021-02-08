<?php
    include_once '../../config/conexao.php';

    $nomeStatus = $_POST['nome-status'];

    $sql = $connect->prepare("INSERT INTO tabstatus (nomestatus) VALUES (?)");
    $sql->bind_param('s', $nomeStatus);
    $sql->execute();

    if($sql->affected_rows != 0){
        $sql->close();
        echo "<script type'text/javascript'>alert('Status cadastrado com sucesso!'); window.location.href = '../../cadastro/cadastroStatus.php';</script>";
    }else{
        $sql->close();
        echo "<script type='text/javascript'>alert('Erro ao cadastrar status!'); window.location.href='../../cadastro/cadastroStatus.php';</script>";
    }


?>