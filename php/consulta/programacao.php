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
    <title>OVGSYSTEM - Pedidos</title>
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
        <div class="container">
            <div class="row right">
                <a href="../home.php"><i class='material-icons right' id='fechar'>close</i></a>
            </div>
            <h4 class='center'>Pedidos</h4>
            <div class="row" id="listagem-pedidos">
                <div class="col l12">
                    <table class="table centered card">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Status</th>
                                <th>Incluído há</th>
                                <th>Programar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                include_once '../config/conexao.php';

                $sql = $connect->prepare("SELECT (tabatividade.peso + tabseguranca.peso) AS pesoTotal, tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto, tabpedido.quantidadepedido, tabpedido.emergencial, tabstatus.nomestatus, DATEDIFF (NOW(), tabpedido.datainclusao) AS quantidade_dias
                                            FROM tabpedido
                                        INNER JOIN tabproduto on tabproduto.idproduto = tabpedido.produtopedido
                                        INNER JOIN tabcliente on tabcliente.idcliente = tabpedido.clientepedido
                                        INNER  JOIN tabstatus on tabstatus.idtabstatus = tabpedido.statuspedido
                                        INNER JOIN tabatividade ON tabatividade.idtabatividade = tabpedido.atividade
                                        INNER JOIN tabseguranca ON tabseguranca.idtabseguranca = tabpedido.seguranca
                                            WHERE tabpedido.statuspedido = 1 OR tabpedido.statuspedido = 3 ORDER BY tabpedido.emergencial DESC, tabpedido.statuspedido DESC, pesoTotal, tabpedido.datainclusao ASC");
                $sql->execute();
                $result = $sql->get_result();
                while($res= $result->fetch_assoc()){
                    ?>
                            <tr>
                                <td><?php echo $res['idpedido'] ?></td>
                                <td><?php echo $res['nomecliente'] ?></td>
                                <td><?php echo $res['nomeproduto'] ?></td>
                                <td><?php echo $res['quantidadepedido'] ?></td>
                                <td><?php echo $res['nomestatus'] ?></td>
                                <td><?php echo $res['quantidade_dias'] ?> dias</td>
                                <td><a data-target="programar" class='modal-trigger programa'
                                        data-id="<?php echo $res['idpedido'] ?>"><i class="material-icons">build</i></a>
                                </td>
                            </tr>
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

        <div class='modal fade' id="programar">
            <div class="modal-content" id="loader-programa">
                <h6>Programando pedido, aguarde...</h6>
                <p>Não feche ou reinicie a página</p>
                <div class="progress">
                    <div class="indeterminate"></div>
                </div>
            </div>
            <div class='modal-content' id="conteudo-programa">
                <div class='row right'><i class='material-icons modal-close'>close</i></div>
                <h4 id="titulo_modal"></h4>
                <div class='divider'></div>
                <h5>Detalhes</h5>
                <div class="row left-align">
                    <div class="col l6">
                        <p>Produto: <span id="produto_programacao"></span></p>
                        <p>Dimensao: <span id="dimensao_programacao"></span></p>
                    </div>
                    <div class="col l6">
                        <p>Formulário: <span id="form_programacao"></span></p>
                    </div>
                </div>
                <div class="divider"></div>
                <form method='post' action='' id='form_programa_pedido' data-id-pedido="" data-qtd-pedido="">
                    <div class="row">
                        <div class="col l6">
                            <h5>Tempo por peça: <span data-mask="00:00:00" id="tempo_peca"></span></h5>
                            <h6>Tempo final do pedido:
                                <span data-mask="00:00:00" id="tempo_pedido"></span> </h6>
                        </div>
                        <?php
                            include_once "../config/conexao.php";

                            $sqlProc = $connect->prepare("SELECT idtabprocesso, descricao, tempo FROM tabprocesso");
                            $sqlProc->execute();
                            
                            $resultProc = $sqlProc->get_result();

                            while($resProc = $resultProc->fetch_assoc()){
                                ?>
                        <div class="col l6">
                            <div class="row center">
                                <div class="col l4">
                                    <label><?php echo $resProc['descricao'] ?></label>
                                    <div class="switch">
                                        <label>
                                            <input type="checkbox" class="processos"
                                                name="processo[<?php echo $resProc['idtabprocesso'] ?>]"
                                                data-id-processo="<?php echo $resProc['idtabprocesso'] ?>"
                                                data-tempo-proc="<?php echo $resProc['tempo'] ?>">
                                            <span class="lever"></span>
                                            </input>
                                        </label>
                                    </div>
                                    <label>(<?php echo $resProc['tempo'] ?>)</label>
                                </div>
                                <div class="col l4">
                                    <div class="input-field">
                                        <input type="text" class="qtd"
                                            id="qtd_proc_<?php echo $resProc['idtabprocesso'] ?>"
                                            name="processo[<?php echo $resProc['idtabprocesso'] ?>][qtd]" value="1">
                                        <label for="quantidade<?php echo $resProc['idtabprocesso'] ?>">Nº de
                                            vezes</label>
                                    </div>
                                </div>
                                <div class="col l4">
                                    <div class="input-field">
                                        <input type="text" class="qtd"
                                            id="qtd_func_proc_<?php echo $resProc['idtabprocesso']?>"
                                            name="processo[<?php echo $resProc['idtabprocesso'] ?>][funcionarios]"
                                            value="1"></input>
                                        <label
                                            for="quantidade<?php echo $resProc['idtabprocesso'] ?>">Funcionários</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <p>
                                    Tempo total: <span
                                        id="tempo_processo_<?php echo $resProc['idtabprocesso'] ?>"></span>
                                </p>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <?php
                            }

                        ?>
                    </div>
                    <div class="row center">
                        <button class='btn light-blue darken-3 botao' type='submit'>Programar
                            <i class='material-icons right'>check</i>
                        </button>
                    </div>
                </form>
            </div>
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
    <script src="../../js/lista.js"></script>
    <script src="../../js/programacao.js"></script>
    <script>
    $(document).ready(function() {
        $('.tempo').mask('00:00:00');
        $('#loader-programa').hide();
    });
    </script>
</body>

</html>