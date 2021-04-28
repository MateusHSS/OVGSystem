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
        <div class="container">
            <div class="row right">
                <a href="../home.php"><i class='material-icons right' id='fechar'>close</i></a>
            </div>
            <h4 class='center'>Previsão</h4>
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
                                        WHERE tabpedido.statuspedido = 6 OR tabpedido.statuspedido = 8 ORDER BY tabpedido.emergencial DESC, tabpedidos_dia.data_final,  tabpedidos_dia.ordem ");
                $sql->execute();
                $result = $sql->get_result();
                while($res= $result->fetch_assoc()){
                    ?>
                            <tr>
                                <td><?= $res['id_pedido'] ?></td>
                                <td><?= $res['nomecliente'] ?></td>
                                <td><?= $res['nomeproduto'] ?></td>
                                <td><?= $res['inclusao'] ?></td>
                                <td><?= $res['nomestatus'] ?></td>
                                <td><?= $res['previsao'] ?></td>
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
                                                                        WHERE tabprocessosproduto.idproduto = $id");
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