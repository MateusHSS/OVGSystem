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
    <title>OVGSYSTEM - Cadastro de corredor</title>
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
                    <li><a href='cadastroAtividade.php'>Atividade</a></li>
                    <li><a href='cadastroCliente.php'>Cliente</a></li>
                    <li><a href='cadastroCorredor.php'>Corredor</a></li>
                    <li><a href='cadastroFuncionario.php'>Funcionário</a></li>
                    <li><a href='cadastroMaterial.php'>Material</a></li>
                    <li><a href='cadastroProcesso.php'>Processo</a></li>
                    <li><a href='cadastroProduto.php'>Produto</a></li>
                    <li><a href='cadastroSeguranca.php'>Segurança</a></li>
                    <li><a href='cadastroSetor.php'>Setor</a></li>
                    <li><a href='cadastroStatus.php'>Status</a></li>
                    <li><a href='cadastroUsuario.php'>Usuário</a></li>
                </ul>

                <!-- MENU CONSULTA -->

                <ul id="consulta-menu" class="dropdown-content">
                    <li><a href='../consulta/listaAtividade.php'>Atividades</a></li>
                    <li><a href='../consulta/listaCliente.php'>Clientes</a></li>
                    <li><a href='../consulta/listaCorredor.php'>Corredores</a></li>
                    <li><a href='../consulta/listaFuncionario.php'>Funcionários</a></li>
                    <li><a href='../consulta/listaMaterial.php'>Materiais</a></li>
                    <li><a href="../consulta/listaProcessos.php">Processos</a></li>
                    <li><a href='../consulta/listaProduto.php'>Produtos</a></li>
                    <li><a href='../consulta/listaSeguranca.php'>Seguranças</a></li>
                    <li><a href='../consulta/listaSetor.php'>Setores</a></li>
                    <li><a href='../consulta/listaStatus.php'>Status</a></li>
                    <li><a href='../consulta/listaUsuario.php'>Usuários</a></li>
                </ul>

                <!-- MENU RELATORIOS -->

                <ul id="relatorio-menu" class="dropdown-content">
                    <li><a href='#'>Opcao 1</a></li>
                    <li><a href='#'>Opcao 2</a></li>
                    <li><a href='#'>Opcao 3</a></li>
                </ul>

                <!-- MENU PEDIDOS -->
                <ul id="pedido-menu" class="dropdown-content">
                    <li><a href='cadastroPedido.php'>Incluir Novo</a></li>
                    <li><a href='../consulta/listaPedido.php'>Lista</a></li>
                </ul>

                <!-- MENU PROGRAMACAO -->
                <ul id="programacao-menu" class="dropdown-content">
                    <li><a href='../consulta/programacao.php'>Programar</a></li>
                    <li><a href='../consulta/programados.php'>Programados</a></li>
                    <li><a href='../consulta/turno.php'>Turnos</a></li>
                    <li><a href='../consulta/apontamento.php'>Apontamento</a></li>
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
        <div class="container">
            <div class="row right">
                <a href="../home.php"><i class='material-icons right' id='fechar'>close</i></a>
            </div>
            <h4 class='center'>Cadastro de corredor</h4>
            <form action="" method='post' class='center' id="form_cadastro_corredor">
                <div class="row">
                    <div class="input-field col m12">
                        <input id="nome_corredor" type="text" class="validate" name='nome_corredor'
                            onkeyup="this.value = this.value.toUpperCase();">
                        <label for="nome_corredor">Nome do corredor</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Cadastrar
                    <i class="material-icons right">check</i>
                </button>
            </form>
        </div>
    </main>





    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
        integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"
        integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA=="
        crossorigin="anonymous"></script>
    <script src="../../js/cadastro/cadastroCorredor.js"></script>
</body>

</html>
<?php } ?>