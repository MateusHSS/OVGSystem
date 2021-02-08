<?php
    include_once '../../config/conexao.php';

    $nomeUnidade = $_POST['nome-unidade'];

    $sql = $connect->prepare("INSERT INTO tabunidade (nomeunidade) VALUES (?)");
    $sql->bind_param('s', $nomeUnidade);
    $sql->execute();

    if($sql->affected_rows != 0){
        $sql->close();
        echo "<script type'text/javascript'>alert('Unidade cadastrada com sucesso!'); window.location.href = '../../cadastro/cadastroUnidade.php';</script>";
    }else{
        $sql->close();
        echo "<script type='text/javascript'>alert('Erro ao cadastrar unidade!'); window.location.href='../../cadastro/cadastroUnidade.php';</script>";
    }



?>