<?php
    session_start();

    if(!isset($_SESSION['logado'])){
        header('location: ../index.php');

    }else{

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OVGSYSTEM - Home</title>
    <link rel="shortcut icon" href="../img/vli.ico" type="image/x-icon" />

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

    <link rel="stylesheet" href="../../css/relatorios.css">

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
                    <li><a href="controller/logout.php">Sair</a></li>
                    <li><img src="../img/logo-teste.png" id='nav-logo'></li>
                </ul>
            </div>

            <?php
            switch($_SESSION['perfil']){
                case 1:
                ?>
            <!-- MENU CADASTRO -->

            <ul id="cadastro-menu" class="dropdown-content">
                <li><a href='cadastro/cadastroAtividade.php'>Atividade</a></li>
                <li><a href='cadastro/cadastroCliente.php'>Cliente</a></li>
                <li><a href='cadastro/cadastroCorredor.php'>Corredor</a></li>
                <li><a href='cadastro/cadastroFuncionario.php'>Funcionário</a></li>
                <li><a href='cadastro/cadastroMaterial.php'>Material</a></li>
                <li><a href='cadastro/cadastroProcesso.php'>Processo</a></li>
                <li><a href='cadastro/cadastroProduto.php'>Produto</a></li>
                <li><a href='cadastro/cadastroSeguranca.php'>Segurança</a></li>
                <li><a href='cadastro/cadastroSetor.php'>Setor</a></li>
                <li><a href='cadastro/cadastroStatus.php'>Status</a></li>
                <li><a href='cadastro/cadastroUsuario.php'>Usuário</a></li>
            </ul>

            <!-- MENU CONSULTA -->

            <ul id="consulta-menu" class="dropdown-content">
                <li><a href='consulta/listaAtividade.php'>Atividades</a></li>
                <li><a href='consulta/listaCliente.php'>Clientes</a></li>
                <li><a href='consulta/listaCorredor.php'>Corredores</a></li>
                <li><a href='consulta/listaFuncionario.php'>Funcionários</a></li>
                <li><a href='consulta/listaMaterial.php'>Materiais</a></li>
                <li><a href='consulta/listaProcessos.php'>Processos</a></li>
                <li><a href='consulta/listaProduto.php'>Produtos</a></li>
                <li><a href='consulta/listaSeguranca.php'>Seguranças</a></li>
                <li><a href='consulta/listaSetor.php'>Setores</a></li>
                <li><a href='consulta/listaStatus.php'>Status</a></li>
                <li><a href='consulta/listaUsuario.php'>Usuários</a></li>
            </ul>

            <!-- MENU ESTOQUE -->
            <ul id="estoque-menu" class="dropdown-content">
                <li><a href='consulta/listaEstoque.php'>Controle</a></li>
                <li><a href='cadastro/entradaEstoque.php'>Entrada</a></li>
            </ul>

            <!-- MENU RELATORIOS -->

            <ul id="relatorio-menu" class="dropdown-content">
                <li><a href='relatorios/relatorio1.php' target="_blank">Estoque</a></li>
                <li><a href='#'>Produção</a></li>
                <li><a href='#'>Opcao 3</a></li>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='cadastro/cadastroPedido.php'>Incluir Novo</a></li>
                <li><a href='consulta/listaPedido.php'>Lista</a></li>
            </ul>

            <!-- MENU PROGRAMACAO -->
            <ul id="programacao-menu" class="dropdown-content">
                <li><a href='consulta/programacao.php'>Programar</a></li>
                <li><a href='consulta/programados.php'>Programados</a></li>
                <li><a href='consulta/turno.php'>Turnos</a></li>
                <li><a href='consulta/apontamento.php'>Apontamento</a></li>
            </ul>

            <div class="nav-content">

                <ul class="tabs">

                    <li class="tab"><a class="dropdown-trigger active" data-target="cadastro-menu">CADASTRO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active" data-target="consulta-menu">CONSULTA<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active" data-target="estoque-menu">ESTOQUE<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active" data-target="pedido-menu">PEDIDO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active" data-target="relatorio-menu">RELATÓRIOS<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active" data-target="programacao-menu">PROGRAMAÇÃO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                </ul>

            </div>
            <?php
                    break;
                case 2:
                    ?>
            <!-- MENU CADASTRO -->

            <ul id="cadastro-menu" class="dropdown-content">
                <li><a href='cadastro/cadastroAtividade.php'>Atividade</a></li>
                <li><a href='cadastro/cadastroCliente.php'>Cliente</a></li>
                <li><a href='cadastro/cadastroCorredor.php'>Corredor</a></li>
                <li><a href='cadastro/cadastroFuncionario.php'>Funcionário</a></li>
                <li><a href='cadastro/cadastroMaterial.php'>Material</a></li>
                <li><a href='cadastro/cadastroProcesso.php'>Processo</a></li>
                <li><a href='cadastro/cadastroProduto.php'>Produto</a></li>
                <li><a href='cadastro/cadastroSeguranca.php'>Segurança</a></li>
                <li><a href='cadastro/cadastroSetor.php'>Setor</a></li>
                <li><a href='cadastro/cadastroStatus.php'>Status</a></li>
                <li><a href='cadastro/cadastroUsuario.php'>Usuário</a></li>
            </ul>

            <!-- MENU CONSULTA -->

            <ul id="consulta-menu" class="dropdown-content">
                <li><a href='consulta/listaAtividade.php'>Atividades</a></li>
                <li><a href='consulta/listaCliente.php'>Clientes</a></li>
                <li><a href='consulta/listaCorredor.php'>Corredores</a></li>
                <li><a href='consulta/listaFuncionario.php'>Funcionários</a></li>
                <li><a href='consulta/listaMaterial.php'>Materiais</a></li>
                <li><a href='consulta/listaProcessos.php'>Processos</a></li>
                <li><a href='consulta/listaProduto.php'>Produtos</a></li>
                <li><a href='consulta/listaSeguranca.php'>Seguranças</a></li>
                <li><a href='consulta/listaSetor.php'>Setores</a></li>
                <li><a href='consulta/listaStatus.php'>Status</a></li>
                <li><a href='consulta/listaUsuario.php'>Usuários</a></li>
            </ul>

            <!-- MENU RELATORIOS -->

            <ul id="relatorio-menu" class="dropdown-content">
                <li><a href='#'>Opcao 1</a></li>
                <li><a href='#'>Opcao 2</a></li>
                <li><a href='#'>Opcao 3</a></li>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='cadastro/cadastroPedido.php'>Incluir Novo</a></li>
                <li><a href='consulta/listaPedido.php'>Lista</a></li>
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

                </ul>

            </div>

            <?php
                    break;
                case 3:
                    ?>
            <!-- MENU CADASTRO -->

            <ul id="cadastro-menu" class="dropdown-content">
                <li><a href='cadastro/cadastroProduto.php'>Produto</a></li>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='cadastro/cadastroPedido.php'>Incluir Novo</a></li>
            </ul>

            <!-- MENU PROGRAMACAO -->
            <ul id="programacao-menu" class="dropdown-content">
                <li><a href='consulta/programados.php'>Programados</a></li>
            </ul>

            <div class="nav-content">

                <ul class="tabs">

                    <li class="tab"><a class="dropdown-trigger active" data-target="cadastro-menu">CADASTRO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active" data-target="pedido-menu">PEDIDO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active" data-target="programacao-menu">PROGRAMAÇÃO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                </ul>

            </div>
            <?php
                    break;
            }
        ?>

        </nav>

    </header>



    <main>

        <div class="row">
            <div class="col l2"></div>
            <div class="col l8">
                <div class="row center">
                    <h4>Relatórios</h4>
                </div>
                <div class="row">
                    <div class="col l6">
                        <ul class="collection with-header">
                            <li class="collection-header">
                                <h4>Estoque</h4>
                            </li>
                            <li class="collection-item">
                                <div>Totais data atual<a href="estoque/totaisDataAtual.php" target="_blank" class="secondary-content"><i
                                            class="material-icons">open_in_browser</i></a></div>
                            </li>
                            <li class="collection-item">
                                <div>Movimentação por período<a data-target="periodo_movimentacao"
                                        class="secondary-content modal-trigger"><i
                                            class="material-icons">open_in_browser</i></a></div>
                            </li>
                        </ul>
                    </div>
                    <div class="col l6">
                        <ul class="collection with-header">
                            <li class="collection-header">
                                <h4>Produção</h4>
                            </li>
                            <li class="collection-item">
                                <div>Entrega de pedidos<a data-target="periodo_entrega_pedidos" class="secondary-content modal-trigger"><i
                                            class="material-icons">open_in_browser</i></a></div>
                            </li>
                            <li class="collection-item">
                                <div>Pedidos realizados por período<a data-target="pedidos_dia" class="secondary-content"><i
                                            class="material-icons">open_in_browser</i></a></div>
                            </li>
                            <li class="collection-item">
                                <div>Pedidos realizados por dia<a data-target="pedidos_dia" class="secondary-content modal-trigger"><i
                                            class="material-icons">open_in_browser</i></a></div>
                            </li>
                            <li class="collection-item">
                                <div>Materiais gastos por pedido<a href="#!" class="secondary-content"><i
                                            class="material-icons">open_in_browser</i></a></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col l2"></div>
        </div>

        <!-- Modal Structure -->
        <div id="periodo_movimentacao" class="modal">
            <div class="modal-content">
                <h4>Selecionar período</h4>
                <div class="row">
                    <form action="estoque/movimentacaoPeriodo.php" method="post" target="_blank">
                        <div class="row">
                            <div class="input-field col l6">
                                <input placeholder="dd/mm/aaaa" id="inicio" type="text" class="datepicker"
                                    name="inicio">
                                <label for="inicio">Início</label>
                            </div>
                            <div class="input-field col l6">
                                <input placeholder="dd/mm/aaaa" id="fim" type="text" class="datepicker"
                                    name="fim">
                                <label for="fim">Fim</label>
                            </div>
                        </div>
                        <div class="row center">
                            <button type="submit" class="btn">Gerar<i class="material-icons right">print</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Structure -->
        <div id="periodo_entrega_pedidos" class="modal">
            <div class="modal-content">
                <h4>Selecionar período</h4>
                <div class="row">
                    <form action="producao/pedidosEntregues.php" method="post" target="_blank">
                        <div class="row">
                            <div class="input-field col l6">
                                <input placeholder="dd/mm/aaaa" id="inicio" type="text" class="datepicker"
                                    name="inicio">
                                <label for="inicio">Início</label>
                            </div>
                            <div class="input-field col l6">
                                <input placeholder="dd/mm/aaaa" id="fim" type="text" class="datepicker"
                                    name="fim">
                                <label for="fim">Fim</label>
                            </div>
                        </div>
                        <div class="row center">
                            <button type="submit" class="btn">Gerar<i class="material-icons right">print</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Structure -->
        <div id="pedidos_dia" class="modal">
            <div class="modal-content">
                <h4>Data</h4>
                <div class="row">
                    <form action="producao/pedidosDia.php" method="post" target="_blank">
                        <div class="row">
                            <div class="input-field col l12">
                                <input placeholder="dd/mm/aaaa" id="data" type="text" class="datepicker"
                                    name="data">
                                <label for="data">Data</label>
                            </div>
                        </div>
                        <div class="row center">
                            <button type="submit" class="btn">Gerar<i class="material-icons right">print</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>


    <!--JavaScript at end of body for optimized loading-->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script src="../../js/relatorios/relatorios.js"></script>
</body>

</html>

<?php } ?>