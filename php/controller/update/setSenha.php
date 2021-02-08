<?php

    include_once "../../config/conexao.php";
    session_start();

    $user = $_SESSION['user'];
    $senha = md5($_POST['senha']);


    $sql = $connect->prepare("UPDATE tabusuario SET senha = '$senha', p_acesso = 0 WHERE idusuario = $user");
    $sql->execute();

    if($sql->affected_rows == 0){
        echo "<script type='text/javascript'>alert('Erro ao atualizar senha!'); window.location.href='../../index.php';</script>";
    }else{
        if($_SESSION['perfil'] == 1){
            echo "<script type'text/javascript'>alert('Senha atualizada com sucesso!'); window.location.href = '../../menu_principal.php';</script>";
        }else{
            echo "<script type'text/javascript'>alert('Senha atualizada com sucesso!'); window.location.href = '../../home.php';</script>";
        }
        
    }


?>