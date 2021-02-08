<?php
    session_start();

    if(!isset($_SESSION['logado'])){
        header('location: ../../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OVGSYSTEM - Apontamento</title>
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

            <?php
        switch($_SESSION['perfil']){
        case 1:
    ?>
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

            <!-- MENU ESTOQUE -->
            <ul id="estoque-menu" class="dropdown-content">
                <li><a href='listaEstoque.php'>Controle</a></li>
                <li><a href='../cadastro/entradaEstoque.php'>Entrada</a></li>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='../cadastro/cadastroPedido.php'>Incluir Novo</a></li>
                <li><a href='listaPedido.php'>Lista</a></li>
                <li><a href='retirada.php'>Retirada</a></li>
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

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="cadastro-menu">CADASTRO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="consulta-menu">CONSULTA<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="estoque-menu">ESTOQUE<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="pedido-menu">PEDIDO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="active white-text" href="../relatorios/relatorios.php">RELATÓRIOS</a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="programacao-menu">PROGRAMAÇÃO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                </ul>

            </div>
            <?php
            break;
        case 2:
    ?>
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

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='../cadastro/cadastroPedido.php'>Incluir Novo</a></li>
                <li><a href='listaPedido.php'>Lista</a></li>
            </ul>

            <div class="nav-content">

                <ul class="tabs">

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="cadastro-menu">CADASTRO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="consulta-menu">CONSULTA<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="pedido-menu">PEDIDO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="active white-text" href="../relatorios/relatorios.php">RELATÓRIOS</a></li>

                </ul>

            </div>

            <?php
            break;
        case 3:
    ?>
            <!-- MENU CADASTRO -->

            <ul id="cadastro-menu" class="dropdown-content">
                <li><a href='../cadastro/cadastroProduto.php'>Produto</a></li>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='../cadastro/cadastroPedido.php'>Incluir Novo</a></li>
            </ul>

            <!-- MENU PROGRAMACAO -->
            <ul id="programacao-menu" class="dropdown-content">
                <li><a href='programados.php'>Programados</a></li>
            </ul>

            <!-- MENU ESTOQUE -->
            <ul id="estoque-menu" class="dropdown-content">
                <li><a href='listaEstoque.php'>Controle</a></li>
                <li><a href='../cadastro/entradaEstoque.php'>Entrada</a></li>
            </ul>

            <div class="nav-content">

                <ul class="tabs">

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="cadastro-menu">CADASTRO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="estoque-menu">ESTOQUE<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="pedido-menu">PEDIDO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="programacao-menu">PROGRAMAÇÃO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                </ul>

            </div>
            <?php
            break;
        case 4:
    ?>
            <!-- MENU CADASTRO -->

            <ul id="cadastro-menu" class="dropdown-content">
                <li><a href='../cadastro/cadastroProduto.php'>Produto</a></li>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='../cadastro/cadastroPedido.php'>Incluir Novo</a></li>
                <li><a href='listaPedido.php'>Lista</a></li>
            </ul>

            <!-- MENU PROGRAMACAO -->
            <ul id="programacao-menu" class="dropdown-content">
                <li><a href='programados.php'>Programados</a></li>
                <li><a href='apontamento.php'>Apontamento</a></li>
            </ul>

            <!-- MENU ESTOQUE -->
            <ul id="estoque-menu" class="dropdown-content">
                <li><a href='listaEstoque.php'>Controle</a></li>
                <li><a href='../cadastro/entradaEstoque.php'>Entrada</a></li>
            </ul>

            <div class="nav-content">

                <ul class="tabs">

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="cadastro-menu">CADASTRO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="estoque-menu">ESTOQUE<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="pedido-menu">PEDIDO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active white-text" data-target="programacao-menu">PROGRAMAÇÃO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                </ul>

            </div>

            <?php
        }
    ?>

        </nav>

    </header>

    <main>
        <div class="row">
            <div class="col l2">
                <!-- <h5>Filtrar data</h5>
                <form action="">
                    <div class="input-field">
                        <input id="dataFiltro" type="text" class="datepicker" name="data" required>
                        <label for="dataFiltro">Data</label>
                    </div>
                </form> -->
            </div>
            <div class="col l8">
                <div class="row right">
                    <a href="../home.php"><i class='material-icons right' id='fechar'>close</i></a>
                </div>
                <h4 class='center'>Programação diária</h4>
                <div class="row" id="listagem-pedidos">
                    <div class="col l12">
                        <table class="table centered card">
                            <thead>
                                <tr>
                                    <th>Pedido</th>
                                    <th>Cliente</th>
                                    <th>Produto</th>
                                    <th>Previsão fim</th>
                                    <th>Finalizar</th>
                                </tr>
                            </thead>
                            <tbody id="corpo_lista">
                                <?php

                include_once '../config/conexao.php';

                $hoje = date('d/m/Y');

                $sql = $connect->prepare("SELECT tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto, DATE_FORMAT(tabpedido.previsao, '%d/%m/%Y %H:%i:%s') AS previsao, tabpedido.statuspedido FROM tabpedido 
                                            INNER JOIN tabcliente ON tabcliente.idcliente = tabpedido.clientepedido
                                            INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido
                                            WHERE tabpedido.statuspedido = 6 OR tabpedido.statuspedido = 8 ORDER BY previsao DESC");
                $sql->execute();
                $result = $sql->get_result();
                if($result->num_rows > 0){
                    while($res= $result->fetch_assoc()){
                        ?>
                                <tr>
                                    <td><?php echo $res['idpedido'] ?></td>
                                    <td><?php echo $res['nomecliente'] ?></td>
                                    <td><?php echo $res['nomeproduto'] ?></td>
                                    <td><?php echo $res['previsao'] ?></td>
                                    <?php
                                            if($res['statuspedido'] == 7){
                                                ?>
                                    <td>Concluído</td>
                                    <?php
                                            }else{
                                                ?>
                                    <td>
                                        <a data-id-produto="<?php echo $res['idpedido'] ?>"
                                            class="finalizar modal-trigger" data-target="processos"><i
                                                class="material-icons">list</i></a></td>
                                    <?php
                                            }
                                        ?>
                                </tr>
                                <?php
                    }
                }else{
                    ?>
                                <tr>
                                    <td colspan="6">Nenhum processo previsto para a data selecionada...</td>
                                </tr>
                                <?php
                }
                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Structure -->
            <div id="processos" class="modal">
                <div class="modal-content">
                    <h4><span id="produto_processos"></span></h4>
                    <p>Processos:</p>
                    <form action="" method="post" id="form_processos">
                        <div class="row" id="lista_processos">

                        </div>
                        <button type="submit" class="btn">Finalizar</button>
                    </form>
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
    <script src="../../js/apontamento.js"></script>
</body>

</html>