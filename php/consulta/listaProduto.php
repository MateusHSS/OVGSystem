<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OVGSYSTEM - Produtos</title>
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

                    <li class="tab"><a class="dropdown-trigger active white-text"
                            data-target="programacao-menu">PROGRAMAÇÃO<i
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

                    <li class="tab"><a class="dropdown-trigger active white-text"
                            data-target="programacao-menu">PROGRAMAÇÃO<i
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

                    <li class="tab"><a class="dropdown-trigger active white-text"
                            data-target="programacao-menu">PROGRAMAÇÃO<i
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
                <!-- <div class="row center">
                    <h5>Filtros</h5>
                </div>
                <div class="row">
                    <div class="container center">
                        <form id="filtro_nome_form" action="">
                            <div class="row">
                                <div class="input-field col l12">
                                    <input id="filtro_nome" type="text" class="validate">
                                    <label for="filtro_nome">Nome</label>
                                </div>
                            </div>
                            <div class="row">
                                <button class="btn" type="submit">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div> -->
            </div>
            <div class="col l8">
                <div class="row right">
                    <a href="../home.php"><i class='material-icons right' id='fechar'>close</i></a>
                </div>
                <h4 class='center'>Produtos</h4>
                <div class="row" id="listagem-pedidos">
                    <div class="col l12">
                        <table class="table centered card">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produto</th>
                                    <th>Data de cadastro</th>
                                    <th class="edita">Editar</th>
                                </tr>
                            </thead>
                            <tbody id="prod_list_body">
                                <?php

                include_once '../config/conexao.php';

                $sql = $connect->prepare("SELECT tabproduto.idproduto, tabproduto.nomeproduto, DATE_FORMAT(tabproduto.datacadastro, '%d/%m/%Y') AS datacadastro
                    FROM tabproduto");
                $sql->execute();
                $result = $sql->get_result();
                while($res= $result->fetch_assoc()){
                    ?>
                                <tr>
                                    <td><?php echo $res['idproduto'] ?></td>
                                    <td><?php echo $res['nomeproduto'] ?></td>
                                    <td><?php echo $res['datacadastro'] ?></td>
                                    <td class='edita'><a href="#edita<?php echo $res['idproduto'] ?>"
                                            class='modal-trigger orange-text text-darken-3'><i
                                                class="material-icons">create</i></a></td>
                                </tr>

                                <div class='modal fade' id='edita<?php echo $res['idproduto'] ?>'>
                                    <div class='modal-content'>
                                        <div class='row right'><i class='material-icons modal-close'>close</i></div>
                                        <h4>Editar informações</h4>
                                        <div class='divider'></div>
                                        <form method='post'
                                            action='../controller/update/editaProduto.php?id=<?php echo $res['idproduto'] ?>'
                                            id='form-edita<?php echo $res['idproduto'] ?>'>
                                            <div class="row">
                                                <div class="input-field col l12">
                                                    <input id="nome-produto<?php echo $res['idproduto'] ?>" type="text"
                                                        class="validate" name='nome-produto'
                                                        value='<?php echo $res['nomeproduto']?>'
                                                        onkeyup="this.value = this.value.toUpperCase();">
                                                    <label for="nome-produto<?php echo $res['idproduto'] ?>">Nome do
                                                        produto</label>
                                                </div>
                                            </div>
                                            <div class="row center">
                                                <div class='btn light-blue darken-3 botao' type='submit' name='action'
                                                    id='<?php echo $res['idproduto'] ?>'>Atualizar
                                                    <i class='material-icons right'>check</i>
                                                </div>
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
                <div class="fixed-action-btn" id='top'>
                    <a class="btn-floating btn-large orange darken-3">
                        <i class="large material-icons">keyboard_arrow_up</i>
                    </a>
                </div>
            </div>
            <div class="col l2" style='margin-top: 1%;'>
                <div class="row center">
                    <button class="btn light-blue darken-3 editar" id='<?php echo $res['idproduto'] ?>'
                        style='width: 60%;'>Editar</button>
                </div>
            </div>
        </div>

    </main>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script src="../../js/lista.js"></script>
    <script src="../../js/listas/listaProdutos.js"></script>
    <script type='text/javascript'>

    </script>
</body>

</html>