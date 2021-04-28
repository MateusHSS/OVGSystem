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
                    <?= in_array("editar_permissoes", $_SESSION['habilidades'])  ? '<li><a href="#">Editar permissoes</a></li>' : '' ?>
                </ul>
            </div>

            <!-- MENU CADASTRO -->
            <ul id='cadastro-menu' class='dropdown-content'>
                <?= in_array("cadastrar_atividade", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroAtividade.php'>Atividade</a></li>" : "" ?>
                <?= in_array("cadastrar_cliente", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroCliente.php'>Cliente</a></li>" : "" ?>
                <?= in_array("cadastrar_corredor", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroCorredor.php'>Corredor</a></li>" : "" ?>
                <?= in_array("cadastrar_funcionario", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroFuncionario.php'>Funcionário</a></li>" : "" ?>
                <?= in_array("cadastrar_material", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroMaterial.php'>Material</a></li>" : "" ?>
                <?= in_array("cadastrar_processo", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroProcesso.php'>Processo</a></li>" : "" ?>
                <?= in_array("cadastrar_produto", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroProduto.php'>Produto</a></li>" : "" ?>
                <?= in_array("cadastrar_seguranca", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroSeguranca.php'>Segurança</a></li>" : "" ?>
                <?= in_array("cadastrar_setor", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroSetor.php'>Setor</a></li>" : "" ?>
                <?= in_array("cadastrar_status", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroStatus.php'>Status</a></li>" : "" ?>
                <?= in_array("cadastrar_usuario", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroUsuario.php'>Usuário</a></li>" : "" ?>
            </ul>

            <!-- MENU CONSULTA -->
            <ul id='consulta-menu' class='dropdown-content'>
                <?= in_array("visualizar_atividades", $_SESSION['habilidades']) ? "<li><a href='listaAtividade.php'>Atividades</a></li>" : "" ?>
                <?= in_array("visualizar_clientes", $_SESSION['habilidades']) ? "<li><a href='listaCliente.php'>Clientes</a></li>" : "" ?>
                <?= in_array("visualizar_corredores", $_SESSION['habilidades']) ? "<li><a href='listaCorredor.php'>Corredores</a></li>" : "" ?>
                <?= in_array("visualizar_funcionarios", $_SESSION['habilidades']) ? "<li><a href='listaFuncionario.php'>Funcionários</a></li>" : "" ?>
                <?= in_array("visualizar_materiais", $_SESSION['habilidades']) ? "<li><a href='listaMaterial.php'>Materiais</a></li>" : "" ?>
                <?= in_array("visualizar_processos", $_SESSION['habilidades']) ? "<li><a href='listaProcessos.php'>Processos</a></li>" : "" ?>
                <?= in_array("visualizar_produtos", $_SESSION['habilidades']) ? "<li><a href='listaProduto.php'>Produtos</a></li>" : "" ?>
                <?= in_array("visualizar_segurancas", $_SESSION['habilidades']) ? "<li><a href='listaSeguranca.php'>Seguranças</a></li>" : "" ?>
                <?= in_array("visualizar_setores", $_SESSION['habilidades']) ? "<li><a href='listaSetor.php'>Setores</a></li>" : "" ?>
                <?= in_array("visualizar_status", $_SESSION['habilidades']) ? "<li><a href='listaStatus.php'>Status</a></li>" : "" ?>
                <?= in_array("visualizar_usuarios", $_SESSION['habilidades']) ? "<li><a href='listaUsuario.php'>Usuários</a></li>" : "" ?>
            </ul>

            <!-- MENU ESTOQUE -->
            <ul id="estoque-menu" class="dropdown-content">
                <?= in_array("visualizar_estoque", $_SESSION['habilidades']) ? "<li><a href='listaEstoque.php'>Controle</a></li>" : "" ?>
                <?= in_array("entrada_estoque", $_SESSION['habilidades']) ? "<li><a href='../cadastro/entradaEstoque.php'>Entrada</a></li>" : "" ?>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <?= in_array("cadastrar_pedido", $_SESSION['habilidades']) ? "<li><a href='../cadastro/cadastroPedido.php'>Incluir Novo</a></li>" : "" ?>
                <?= in_array("visualizar_pedidos", $_SESSION['habilidades']) ? "<li><a href='listaPedido.php'>Lista</a></li>" : "" ?>
                <?= in_array("retirar_pedido", $_SESSION['habilidades']) ? "<li><a href='retirada.php'>Retirada</a></li>" : "" ?>
            </ul>

            <!-- MENU PROGRAMACAO -->
            <ul id="programacao-menu" class="dropdown-content">
                <?= in_array("programar_pedido", $_SESSION['habilidades']) ? "<li><a href='programacao.php'>Programar</a></li>" : "" ?>
                <?= in_array("visualizar_programacao", $_SESSION['habilidades']) ? "<li><a href='programados.php'>Programados</a></li>" : "" ?>
                <?= in_array("visualizar_turnos", $_SESSION['habilidades']) ? "<li><a href='turno.php'>Turnos</a></li>" : "" ?>
                <?= in_array("apontar_pedidos", $_SESSION['habilidades']) ? "<li><a href='apontamento.php'>Apontamento</a></li>" : "" ?>
            </ul>

            <div class="nav-content">
                <ul class="tabs">
                    <?= in_array("cadastro", $_SESSION['habilidades']) 
                        ? '<li class="tab"><a class="dropdown-trigger active" data-target="cadastro-menu">CADASTRO<i class="material-icons right">arrow_drop_down</i></a></li>' 
                        : '' ?> 

                    <?= in_array("visualizar", $_SESSION['habilidades']) 
                        ? '<li class="tab"><a class="dropdown-trigger active" data-target="consulta-menu">CONSULTA<i class="material-icons right">arrow_drop_down</i></a></li>' 
                        : '' ?>

                    <?= in_array("estoque", $_SESSION['habilidades']) 
                        ? '<li class="tab"><a class="dropdown-trigger active" data-target="estoque-menu">ESTOQUE<i class="material-icons right">arrow_drop_down</i></a></li>' 
                        : '' ?>

                    <?= in_array("pedido", $_SESSION['habilidades']) 
                        ? '<li class="tab"><a class="dropdown-trigger active" data-target="pedido-menu">PEDIDO<i
                                class="material-icons right">arrow_drop_down</i></a></li>'
                        : '' ?>
                        

                    <?= in_array("relatorios", $_SESSION['habilidades']) 
                        ? '<li class="tab"><a class="active" href="../relatorios/relatorios.php">RELATÓRIOS</a></li>' 
                        : '' ?>

                    <?= in_array("programacao", $_SESSION['habilidades']) 
                        ? '<li class="tab"><a class="dropdown-trigger active" data-target="programacao-menu">PROGRAMAÇÃO<i
                                class="material-icons right">arrow_drop_down</i></a></li>'
                        : '' ?>
                </ul>
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
                                    <th>Usuário</th>
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
                                                        <option value="<?php echo $res['idsetor']?>" selected><?php echo $res['nomesetor'] ?></option>
                                                        <?php
                                                            include '../config/conexao.php';
                                                            $sqlSetor = "SELECT * FROM tabsetor";
                                                            $resultSetor = $connect->query($sqlSetor);
                                                            while($resSetor = $resultSetor->fetch_array()){
                                                        ?>
                                                        <option value='<?php echo $resSetor['idsetor'] ?>'><?php echo $resSetor['nomesetor'] ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                    <label>Setor</label>
                                                </div>
                                                <div class="input-field col l6">
                                                    <select name='perfil-user'
                                                        id='perfil-user<?php echo $res['idusuario'] ?>'>
                                                        <option value="<?php echo $res['idperfil'] ?>" selected><?php echo $res['nomeperfil'] ?></option>
                                                        <?php
                                                            include '../config/conexao.php';
                                                            $sqlPerfil = "SELECT * FROM tabperfil";
                                                            $resultPerfil = $connect->query($sqlPerfil);
                                                            while($resPerfil = $resultPerfil->fetch_array()){
                                                        ?>
                                                        <option value='<?php echo $resPerfil['idperfil'] ?>'><?php echo $resPerfil['nomeperfil'] ?></option>
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