<?php
    include_once '../config/conexao.php';

    session_start();

    $user = $_POST['user'];
    $senha = md5($_POST['pass']);

    $sqlLogin = $connect->prepare("SELECT tabusuario.* FROM tabusuario WHERE usuario = ? AND senha = ?");
    $sqlLogin->bind_param("ss", $user, $senha);
    $sqlLogin->execute();
    $resultLogin = $sqlLogin->get_result();

    if($resultLogin->num_rows == 0){
        echo json_encode(array("cod" => 0, "mensagem" => "Usuário ou senha incorretos!"));
    }else{
        while($resLogin = $resultLogin->fetch_assoc()){
            $dados = new stdClass();
            $dados->user_id = $resLogin['idusuario'];
            $dados->perfil = $resLogin['idperfil'];

            $sql_habilidades = $connect->prepare("SELECT tabhabilidade.slug FROM tabusuario 
                                                JOIN tabhabilidades_perfil ON tabhabilidades_perfil.perfil_id = tabusuario.idperfil
                                                JOIN tabhabilidade ON tabhabilidade.id = tabhabilidades_perfil.habilidade_id
                                            WHERE tabusuario.idusuario = ?");
            $sql_habilidades->bind_param("i", $dados->user_id);
            $sql_habilidades->execute();
            $result_habilidades = $sql_habilidades->get_result();

            function get_first($v){
                return $v[0];
            }

            $dados->habilidades = array_map("get_first", $result_habilidades->fetch_all());

            $_SESSION['logado'] = true;
            $_SESSION['user'] = $resLogin['idusuario'];
            $_SESSION['perfil'] = $resLogin['idperfil'];
            $_SESSION['habilidades'] = $dados->habilidades;

            if($resLogin['p_acesso']==1){
                // header("location: pAcesso.php");
                echo json_encode(array("cod" => 1, "pAcesso" => 1));
            }else{
                if($resLogin['idperfil'] == 1){
                    // header("location: ../menu_principal.php");
                    echo json_encode(array("cod" => 1, "pAcesso" => 0, "adm" => 1, "dale" => $_SESSION['habilidades']));
                }else{
                    // header("location: ../home.php");
                    echo json_encode(array("cod" => 1, "pAcesso" => 0, "adm" => 0));
                }
            }
        }
    }




?>