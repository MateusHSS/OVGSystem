<?php
    include_once '../../config/conexao.php';

    $id = $_GET['id'];
    $nome = $_POST['nome-user'];
    $user = $_POST['user'];
    $setor = $_GET['setor-user'];
    $perfil = $_GET['perfil-user'];


    if($_POST['senha'] != ''){
        $senha = md5($_POST['senha']);

        $sql = $connect->prepare("UPDATE tabusuario SET nomeusuario = ?, usuario = ?, senha = ?, idsetorusuario = ?, idperfil = ? WHERE idusuario = $id");
        $sql->bind_param("sssss", $nome, $user, $senha, $setor, $perfil);

    }else{
        $sql = $connect->prepare("UPDATE tabusuario SET nomeusuario = ?, usuario = ?, idsetorusuario = ?, idperfil = ? WHERE idusuario = $id");
        $sql->bind_param("ssss", $nome, $user, $setor, $perfil);
    }

    $sql->execute();
    $result = $sql->get_result();

    if($sql->affected_rows == 0){
        echo "<script type='text/javascript'>alert('Nenhum registro atualizado!');window.location.href='../../consulta/listaUsuario.php';</script>";
    }else{
        $sql->close();
        echo "<script type'text/javascript'>alert('Usuário atualizado com sucesso!'); window.location.href = '../../consulta/listaUsuario.php';</script>";
    }


    


?>