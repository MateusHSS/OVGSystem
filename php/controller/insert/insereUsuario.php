<?php
    include_once '../../config/conexao.php';

    $nomeUser = $_POST['nome-user'];
    $user = $_POST['user'];
    $senha = md5($_POST['senha']);
    $setor = $_POST['setor-user'];
    $ativo = $_POST['ativo'];
    $perfil = $_POST['perfil'];

    if(isset($_POST['ativo'])){
        $ativo = 1;
    }else{
        $ativo = 0;
    }

    $sql = $connect->prepare("INSERT INTO tabusuario (usuario, nomeusuario, senha, ativo, idsetorusuario, idperfil) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param('ssssss', $user, $nomeUser, $senha, $ativo, $setor, $perfil);
    $sql->execute();

    if($sql->affected_rows != 0){
        $sql->close();
        echo "<script type'text/javascript'>alert('Usuário cadastrado com sucesso!'); window.location.href = '../../cadastro/cadastroUsuario.php';</script>";
    }else{
        $sql->close();
        echo "<script type='text/javascript'>alert('Erro ao cadastrar usuário!'); window.location.href='../../cadastro/cadastroUsuario.php';</script>";
    }


?>