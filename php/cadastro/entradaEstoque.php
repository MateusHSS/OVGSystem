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
    <title>OVGSYSTEM - Entrada no estoque</title>
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
                <?= in_array("cadastrar_atividade", $_SESSION['habilidades']) ? "<li><a href='cadastroAtividade.php'>Atividade</a></li>" : "" ?>
                <?= in_array("cadastrar_cliente", $_SESSION['habilidades']) ? "<li><a href='cadastroCliente.php'>Cliente</a></li>" : "" ?>
                <?= in_array("cadastrar_corredor", $_SESSION['habilidades']) ? "<li><a href='cadastroCorredor.php'>Corredor</a></li>" : "" ?>
                <?= in_array("cadastrar_funcionario", $_SESSION['habilidades']) ? "<li><a href='cadastroFuncionario.php'>Funcionário</a></li>" : "" ?>
                <?= in_array("cadastrar_material", $_SESSION['habilidades']) ? "<li><a href='cadastroMaterial.php'>Material</a></li>" : "" ?>
                <?= in_array("cadastrar_processo", $_SESSION['habilidades']) ? "<li><a href='cadastroProcesso.php'>Processo</a></li>" : "" ?>
                <?= in_array("cadastrar_produto", $_SESSION['habilidades']) ? "<li><a href='cadastroProduto.php'>Produto</a></li>" : "" ?>
                <?= in_array("cadastrar_seguranca", $_SESSION['habilidades']) ? "<li><a href='cadastroSeguranca.php'>Segurança</a></li>" : "" ?>
                <?= in_array("cadastrar_setor", $_SESSION['habilidades']) ? "<li><a href='cadastroSetor.php'>Setor</a></li>" : "" ?>
                <?= in_array("cadastrar_status", $_SESSION['habilidades']) ? "<li><a href='cadastroStatus.php'>Status</a></li>" : "" ?>
                <?= in_array("cadastrar_usuario", $_SESSION['habilidades']) ? "<li><a href='cadastroUsuario.php'>Usuário</a></li>" : "" ?>
            </ul>

            <!-- MENU CONSULTA -->
            <ul id='consulta-menu' class='dropdown-content'>
                <?= in_array("visualizar_atividades", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaAtividade.php'>Atividades</a></li>" : "" ?>
                <?= in_array("visualizar_clientes", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaCliente.php'>Clientes</a></li>" : "" ?>
                <?= in_array("visualizar_corredores", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaCorredor.php'>Corredores</a></li>" : "" ?>
                <?= in_array("visualizar_funcionarios", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaFuncionario.php'>Funcionários</a></li>" : "" ?>
                <?= in_array("visualizar_materiais", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaMaterial.php'>Materiais</a></li>" : "" ?>
                <?= in_array("visualizar_processos", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaProcessos.php'>Processos</a></li>" : "" ?>
                <?= in_array("visualizar_produtos", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaProduto.php'>Produtos</a></li>" : "" ?>
                <?= in_array("visualizar_segurancas", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaSeguranca.php'>Seguranças</a></li>" : "" ?>
                <?= in_array("visualizar_setores", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaSetor.php'>Setores</a></li>" : "" ?>
                <?= in_array("visualizar_status", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaStatus.php'>Status</a></li>" : "" ?>
                <?= in_array("visualizar_usuarios", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaUsuario.php'>Usuários</a></li>" : "" ?>
            </ul>

            <!-- MENU ESTOQUE -->
            <ul id="estoque-menu" class="dropdown-content">
                <?= in_array("visualizar_estoque", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaEstoque.php'>Controle</a></li>" : "" ?>
                <?= in_array("entrada_estoque", $_SESSION['habilidades']) ? "<li><a href='entradaEstoque.php'>Entrada</a></li>" : "" ?>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <?= in_array("cadastrar_pedido", $_SESSION['habilidades']) ? "<li><a href='cadastroPedido.php'>Incluir Novo</a></li>" : "" ?>
                <?= in_array("visualizar_pedidos", $_SESSION['habilidades']) ? "<li><a href='../consulta/listaPedido.php'>Lista</a></li>" : "" ?>
                <?= in_array("retirar_pedido", $_SESSION['habilidades']) ? "<li><a href='../consulta/retirada.php'>Retirada</a></li>" : "" ?>
            </ul>

            <!-- MENU PROGRAMACAO -->
            <ul id="programacao-menu" class="dropdown-content">
                <?= in_array("programar_pedido", $_SESSION['habilidades']) ? "<li><a href='../consulta/programacao.php'>Programar</a></li>" : "" ?>
                <?= in_array("visualizar_programacao", $_SESSION['habilidades']) ? "<li><a href='../consulta/programados.php'>Programados</a></li>" : "" ?>
                <?= in_array("visualizar_turnos", $_SESSION['habilidades']) ? "<li><a href='../consulta/turno.php'>Turnos</a></li>" : "" ?>
                <?= in_array("apontar_pedidos", $_SESSION['habilidades']) ? "<li><a href='../consulta/apontamento.php'>Apontamento</a></li>" : "" ?>
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
        <div class="container">
            <div class="row right">
                <a href="../home.php"><i class='material-icons right' id='fechar'>close</i></a>
            </div>
            <h4 class='center'>Entrada estoque</h4>
            <form action="" method='post' class='center' id="form_entrada_estoque">
                <div class="row">
                    <div class="input-field col m6">
                        <input id="material" type="text" class="autocomplete" name='material'
                            onkeyup="this.value = this.value.toUpperCase();" data-sap="">
                        <label for="material">Material</label>
                    </div>
                    <div class="input-field col m4">
                        <input id="qtd" type="text" class="validate" name='qtd'
                            onkeyup="this.value = this.value.toUpperCase();" peso="" value="1">
                        <label for="qtd">Quantidade</label>
                    </div>
                    <div class="col l2">
                        <p>Peso total:</p>
                        <p id="peso_total"></p>
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
    <script src="../../js/cadastro/entradaEstoque.js"></script>
</body>

</html>

<?php } ?>