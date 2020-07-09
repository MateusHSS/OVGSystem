<?php
    include_once '../../config/conexao.php';

    $descricaoSeguranca = $_POST['descricao-seguranca'];
    $pesoSeguranca = $_POST['peso-seguranca'];

    $sql = $connect->prepare("INSERT INTO tabseguranca (descricao, peso) VALUES (?, ?)");
    $sql->bind_param('ss', $descricaoSeguranca, $pesoSeguranca);
    $sql->execute();

    if($sql->affected_rows != 0){
        $sql->close();
        echo "<script type'text/javascript'>alert('Segurança cadastrada com sucesso!'); window.location.href = '../../cadastro/cadastroSeguranca.php';</script>";
    }else{
        $sql->close();
        echo "<script type='text/javascript'>alert('Erro ao cadastrar seguranca!'); window.location.href='../../cadastro/cadastroSeguranca.php';</script>";
    }


?>