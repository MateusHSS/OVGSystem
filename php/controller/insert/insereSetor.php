<?php
    include_once '../../config/conexao.php';

    $nomeSetor = $_POST['nome-setor'];
    $corredor = $_POST['corredor-setor'];

    $sql = $connect->prepare("INSERT INTO tabsetor (idcorredor, nomesetor) VALUES (?, ?)");
    $sql->bind_param('ss', $corredor, $nomeSetor);
    $sql->execute();

    if($sql->affected_rows != 0){
        $sql->close();
        echo "<script type'text/javascript'>alert('Setor cadastrado com sucesso!'); window.location.href = '../../cadastro/cadastroSetor.php';</script>";
    }else{
        $sql->close();
        echo "<script type='text/javascript'>alert('Erro ao cadastrar setor!'); window.location.href='../../cadastro/cadastroSetor.php';</script>";
    }

?>