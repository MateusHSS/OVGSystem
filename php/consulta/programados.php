<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

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

            <div class="container">

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

                        <li class="tab"><a class="dropdown-trigger active" data-target="programacao-menu">PROGRAMAÇÃO<i
                                    class='material-icons right'>arrow_drop_down</i></a></li>

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
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row right">
                <a href="../home.php"><i class='material-icons right' id='fechar'>close</i></a>
            </div>
            <h4 class='center'>Previsao</h4>
            <div class="row" id="listagem-pedidos">
                <div class="col l12">
                    <table class="table centered card">
                        <thead>
                            <tr>
                                <th>ID pedido</th>
                                <th>Cliente</th>
                                <th>Produto</th>
                                <th>Data pedido</th>
                                <th>Status</th>
                                <th>Previsão</th>
                                <th>Detalhes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                include_once '../config/conexao.php';

                $sql = $connect->prepare("SELECT tabpedidos_dia.*, tabpedido.*, tabcliente.nomecliente, tabproduto.nomeproduto, tabstatus.nomestatus, DATE_FORMAT(tabpedidos_dia.data_final, '%d/%m/%Y %H:%i:%s') AS previsao, DATE_FORMAT(tabpedidos_dia.data, '%d/%m/%Y') AS inclusao
                                                FROM tabpedidos_dia
                                        INNER JOIN tabpedido ON tabpedido.idpedido = tabpedidos_dia.id_pedido
                                        INNER JOIN tabcliente ON tabpedido.clientepedido = tabcliente.idcliente
                                        INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido
                                        INNER JOIN tabstatus ON tabstatus.idtabstatus = tabpedido.statuspedido
                                        ORDER BY tabpedidos_dia.data_final, tabpedidos_dia.ordem");
                $sql->execute();
                $result = $sql->get_result();
                while($res= $result->fetch_assoc()){
                    ?>
                            <tr>
                                <td><?php echo $res['id_pedido'] ?></td>
                                <td><?php echo $res['nomecliente'] ?></td>
                                <td><?php echo $res['nomeproduto'] ?></td>
                                <td><?php echo $res['inclusao'] ?></td>
                                <td><?php echo $res['nomestatus'] ?></td>
                                <td><?php echo $res['previsao'] ?></td>
                                <td><a href="#detalhes<?php echo $res['id_pedido'] ?>" class='modal-trigger'><i
                                            class="material-icons">more_vert</i></a></td>
                            </tr>

                            <div class='modal fade' id="detalhes<?php echo $res['id_pedido']?>"
                                data-qtd-pedido="<?php echo $res['quantidadepedido']?>">
                                <div class='modal-content'>
                                    <div class='row right'><i class='material-icons modal-close'>close</i></div>
                                    <h4><?php echo $res['nomeproduto'] ?>
                                        (<?php echo $res['quantidadepedido'] ?> unidades)</h4>
                                    <div class='divider'></div>
                                    <div class="row center">
                                        <h5>Detalhes:</h5>
                                    </div>
                                    <div class="row">
                                        <?php

                                        $id = $res['id_pedido'];

                                        require_once "../config/conexao.php";

                                        $sqlProcessos = $connect->prepare("SELECT tabprocessosproduto.*, tabprocesso.descricao, DATE_FORMAT(tabprocessosproduto.pros_final, '%d/%m/%Y %H:%i:%s') AS pros_final
                                                                            FROM tabprocessosproduto 
                                                                        INNER JOIN tabprocesso ON tabprocesso.idtabprocesso = tabprocessosproduto.idprocesso
                                                                        WHERE tabprocessosproduto.idproduto = $id ");
                                        $sqlProcessos->execute();

                                        $resultProcessos = $sqlProcessos->get_result();

                                        while($resProcessos = $resultProcessos->fetch_assoc()){
                                            ?>
                                        <div class="col l6">
                                            <p>Processo: <span><?php echo $resProcessos['descricao'] ?></span></p>
                                            <p>Previsao: <span><?php echo $resProcessos['pros_final'] ?></span></p>
                                        </div>
                                        <?php
                                        }

                                    ?>
                                    </div>
                                    <div class="divider"></div>
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
    </main>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script src="../../js/lista.js"></script>
    <script>
    $(document).ready(function() {
        $('.tempo').mask('00:00:00');
    });
    </script>
</body>

</html>