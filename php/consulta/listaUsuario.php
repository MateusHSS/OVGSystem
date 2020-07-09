<?php
    session_start();

    if(!isset($_SESSION['logado'])){
        header('location: ../../index.php');
    }else{

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OVGSYSTEM - Usuários</title>
    <link rel="shortcut icon" href="../../img/vli.ico" type="image/x-icon" />
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- FONTE DA LOGO -->
    <link href="https://fonts.googleapis.com/css?family=Fauna+One&display=swap" rel="stylesheet">

    <!-- CSS DA PAGINA -->
    <link rel="stylesheet" href="../../css/cadastro.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<body>
    <header>
        <nav class="nav-extended">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo" id='logo'>OVG SYSTEM</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="../controller/logout.php">Sair</a></li>
                    <li><img src="../../img/logo-teste.png" id='nav-logo'></li>
                </ul>
            </div>

            <div class="container">

                <!-- MENU CADASTRO -->

                <ul id="cadastro-menu" class="dropdown-content">
                    <li><a href='../cadastro/cadastroAtividade.php'>Atividade</a></li>
                    <li><a href='../cadastro/cadastroCliente.php'>Cliente</a></li>
                    <li><a href='../cadastro/cadastroCorredor.php'>Corredor</a></li>
                    <li><a href='../cadastro/cadastroFuncionario.php'>Funcionário</a></li>
                    <li><a href='../cadastro/cadastroMaterial.php'>Material</a></li>
                    <li><a href='../cadastro/cadastroProcesso.php'>Processo</a></li>
                    <li><a href='../cadastro/cadastroProduto.php'>Produto</a></li>
                    <li><a href='../cadastro/cadastroSeguranca.php'>Segurança</a></li>
                    <li><a href='../cadastro/cadastroSetor.php'>Setor</a></li>
                    <li><a href='../cadastro/cadastroStatus.php'>Status</a></li>
                    <li><a href='../cadastro/cadastroUsuario.php'>Usuário</a></li>
                </ul>

                <!-- MENU CONSULTA -->

                <ul id="consulta-menu" class="dropdown-content">
                    <li><a href='listaAtividade.php'>Atividades</a></li>
                    <li><a href='listaCliente.php'>Clientes</a></li>
                    <li><a href='listaCorredor.php'>Corredores</a></li>
                    <li><a href='listaFuncionario.php'>Funcionários</a></li>
                    <li><a href='listaMaterial.php'>Materiais</a></li>
                    <li><a href='listaProcessos.php'>Processos</a></li>
                    <li><a href='listaProduto.php'>Produtos</a></li>
                    <li><a href='listaSeguranca.php'>Seguranças</a></li>
                    <li><a href='listaSetor.php'>Setores</a></li>
                    <li><a href='listaStatus.php'>Status</a></li>
                    <li><a href='listaUsuario.php'>Usuários</a></li>
                </ul>

                <!-- MENU RELATORIOS -->

                <ul id="relatorio-menu" class="dropdown-content">
                    <li><a href='#'>Opcao 1</a></li>
                    <li><a href='#'>Opcao 2</a></li>
                    <li><a href='#'>Opcao 3</a></li>
                </ul>

                <!-- MENU PEDIDOS -->
                <ul id="pedido-menu" class="dropdown-content">
                    <li><a href='../cadastro/cadastroPedido.php'>Incluir Novo</a></li>
                    <li><a href='../consulta/listaPedido.php'>Lista</a></li>
                </ul>

                <!-- MENU PROGRAMACAO -->
                <ul id="programacao-menu" class="dropdown-content">
                    <li><a href='programacao.php'>Programar</a></li>
                    <li><a href='programados.php'>Programados</a></li>
                    <li><a href='turno.php'>Turnos</a></li>
                    <li><a href='apontamento.php'>Apontamento</a></li>
                </ul>

                <div class="nav-content">

                    <ul class="tabs">

                        <li class="tab"><a class="dropdown-trigger active" data-target="cadastro-menu">CADASTRO<i
                                    class='material-icons right'>arrow_drop_down</i></a></li>

                        <li class="tab"><a class="dropdown-trigger active" data-target="consulta-menu">CONSULTA<i
                                    class='material-icons right'>arrow_drop_down</i></a></li>

                        <li class="tab"><a class="dropdown-trigger active" data-target="pedido-menu">PEDIDO<i
                                    class='material-icons right'>arrow_drop_down</i></a></li>

                        <li class="tab"><a class="dropdown-trigger active" data-target="relatorio-menu">RELATÓRIOS<i
                                    class='material-icons right'>arrow_drop_down</i></a></li>

                        <?php

if($_SESSION['perfil'] == 1){
    ?>
                        <li class="tab"><a class="dropdown-trigger active" data-target="programacao-menu">PROGRAMAÇÃO<i
                                    class='material-icons right'>arrow_drop_down</i></a></li>
                        <?php
}
?>

                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="row">
            <div class="col l2"></div>
            <div class="col l8">
                <div class="row right">
                    <a href="../home.php"><i class='material-icons right' id='fechar'>close</i></a>
                </div>
                <h4 class='center'>Usuários</h4>
                <div class="row">
                    <div class="table table-sm table-dark">
                        <table class="table centered card">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Nome</th>
                                    <th>Setor</th>
                                    <th>Perfil</th>
                                    <th class="edita">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                include_once '../config/conexao.php';

                $sql = $connect->prepare("select tabusuario.idusuario, tabusuario.usuario, tabusuario.nomeusuario, tabsetor.idsetor, tabsetor.nomesetor, tabperfil.idperfil, tabperfil.nomeperfil  
                  from tabusuario
                LEFT join tabsetor on tabsetor.idsetor = tabusuario.idsetorusuario
                LEFT join tabperfil on tabperfil.idperfil = tabusuario.idperfil");
                $sql->execute();
                $result = $sql->get_result();
                while($res= $result->fetch_assoc()){
                    ?>
                                <tr>
                                    <td><?php echo $res['idusuario'] ?></td>
                                    <td><?php echo $res['usuario'] ?></td>
                                    <td><?php echo $res['nomeusuario'] ?></td>
                                    <td><?php echo $res['nomesetor'] ?></td>
                                    <td><?php echo $res['nomeperfil'] ?></td>
                                    <td class='edita' data-opc='Cliente'><a href="#edita<?php echo $res['idusuario'] ?>"
                                            class='modal-trigger orange-text text-darken-3'><i
                                                class="material-icons">create</i></a></td>
                                </tr>

                                <div class='modal fade' id='edita<?php echo $res['idusuario'] ?>'>
                                    <div class='modal-content'>
                                        <div class='row right'><i class='material-icons modal-close'>close</i></div>
                                        <h4>Editar informações</h4>
                                        <div class='divider'></div>
                                        <form method='post'
                                            action='../controller/update/editaUsuario.php?id=<?php echo $res['idusuario'] ?>'
                                            id='form-edita<?php echo $res['idusuario'] ?>'>
                                            <div class="row">
                                                <div class="input-field col l6">
                                                    <input id="nome-user" type="text" class="validate" name='nome-user'
                                                        onkeyup="this.value = this.value.toUpperCase();"
                                                        value="<?php echo $res['nomeusuario'] ?>">
                                                    <label for="nome-user">Nome completo</label>
                                                </div>
                                                <div class="input-field col l6">
                                                    <input id="user" type="text" class="validate" name='user'
                                                        onkeyup="this.value = this.value.toUpperCase();"
                                                        value="<?php echo $res['usuario'] ?>">
                                                    <label for="user">Usuário</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col l6">
                                                    <select name='setor-user'
                                                        id='setor-user<?php echo $res['idusuario'] ?>'>
                                                        <option value="<?php echo $res['idsetor']?>" selected>
                                                            <?php echo $res['nomesetor'] ?></option>
                                                        <?php
                                                            include '../config/conexao.php';
                                                            $sqlSetor = "SELECT * FROM tabsetor";
                                                            $resultSetor = $connect->query($sqlSetor);
                                                            while($resSetor = $resultSetor->fetch_array()){
                                                        ?>
                                                        <option value='<?php echo $resSetor['idsetor'] ?>'>
                                                            <?php echo $resSetor['nomesetor'] ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Setor</label>
                                                </div>
                                                <div class="input-field col l6">
                                                    <select name='perfil-user'
                                                        id='perfil-user<?php echo $res['idusuario'] ?>'>
                                                        <option value="<?php echo $res['idperfil'] ?>" selected>
                                                            <?php echo $res['nomeperfil'] ?></option>
                                                        <?php
                                                            include '../config/conexao.php';
                                                            $sqlPerfil = "SELECT * FROM tabperfil";
                                                            $resultPerfil = $connect->query($sqlPerfil);
                                                            while($resPerfil = $resultPerfil->fetch_array()){
                                                        ?>
                                                        <option value='<?php echo $resPerfil['idperfil'] ?>'>
                                                            <?php echo $resPerfil['nomeperfil'] ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Perfil</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col l6">
                                                    <input id="senha" type="password" class="validate" name='senha'>
                                                    <label for="senha">Nova senha</label>
                                                </div>
                                                <div class="input-field col l6">
                                                    <input id="confirma-senha" type="password" class="validate"
                                                        name='confirma-senha'>
                                                    <label for="confirma-senha">Confirmar senha</label>
                                                    <span class="helper-text"
                                                        data-error='As senhas não coincidem'></span>
                                                </div>
                                            </div>
                                            <div class="btn waves-effect waves-light botao"
                                                id="<?php echo $res['idusuario'] ?>">Atualizar
                                                <i class="material-icons right">send</i>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                                <?php
                }
                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <div class="col l2" style='margin-top: 1%;'>
                <div class="row center">
                    <button class="btn light-blue darken-3 editar" id='<?php echo $res['idcliente'] ?>'
                        style='width: 60%;'>Editar</button>
                </div>
            </div>

            <div class="fixed-action-btn" id='top'>
                <a class="btn-floating btn-large orange darken-3">
                    <i class="large material-icons">keyboard_arrow_up</i>
                </a>
            </div>
        </div>

    </main>





    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script src="../../js/lista.js"></script>
    <script>
    $(".botao").click(function() {
        var id = $(this).attr("id");

        var url = $("#form-edita" + id).attr("action");

        var perfil = $("#perfil-user" + id).val();
        var setor = $("#setor-user" + id).val();

        url += "&setor-user=" + setor + "&perfil-user=" + perfil;

        $("#form-edita" + id).attr("action", url);

    })
    </script>
</body>

</html>

<?php } ?>