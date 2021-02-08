<?php
    include_once '../config/conexao.php';

    session_start();

    $user = $_POST['user'];
    $senha = md5($_POST['pass']);

    $sqlLogin = $connect->prepare("SELECT * FROM tabusuario WHERE usuario = ? AND senha = ?");
    $sqlLogin->bind_param("ss", $user, $senha);
    $sqlLogin->execute();
    $resultLogin = $sqlLogin->get_result();

    if($resultLogin->num_rows == 0){
        echo json_encode(array("cod" => 0, "mensagem" => "Usuário ou senha incorretos!"));
    }else{
        while($resLogin = $resultLogin->fetch_assoc()){
            $_SESSION['logado'] = true;
            $_SESSION['user'] = $resLogin['idusuario'];
            $_SESSION['perfil'] = $resLogin['idperfil'];

            if($resLogin['p_acesso']==1){
                // header("location: pAcesso.php");
                echo json_encode(array("cod" => 1, "pAcesso" => 1));
            }else{
                if($resLogin['idperfil'] == 1){
                    // header("location: ../menu_principal.php");
                    echo json_encode(array("cod" => 1, "pAcesso" => 0, "adm" => 1));
                }else{
                    // header("location: ../home.php");
                    echo json_encode(array("cod" => 1, "pAcesso" => 0, "adm" => 0));
                }
            }

        }
    }




?>