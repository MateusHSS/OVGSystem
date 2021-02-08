<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OVGSYSTEM - Turnos</title>
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
        <!-- <div class="row">
            <div class="col l2">
                <form action="" id="filtra_pedidos">

                </form>
            </div>
            <div class="col l8">
                <div class="row">
                    <a href="../home.php"><i class='material-icons right' id='fechar'>close</i></a>
                    <h4 class="center">Turnos</h4>
                </div>
                <div class="row">
                    <div class="table table-sm table-dark">
                        <table class="table centered card">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Turno</th>
                                    <th>Início</th>
                                    <th>Fim</th>
                                    <th>Intervalo</th>
                                    <th>Duração</th>
                                    <th>Horas trabalhadas</th>
                                    <th>Funcionários</th>
                                </tr>
                            </thead>
                            <tbody id="pedidos">
                                <?php

                include_once '../config/conexao.php';

                $sql = $connect->prepare("SELECT tabturno.nometurno, DATE_FORMAT(tabhorariodiario.data, '%d/%m/%Y') AS dataturno, DATE_FORMAT(tabhorariodiario.inicio, '%H:%i') AS inicio, DATE_FORMAT(tabhorariodiario.fim, '%H:%i') AS fim, DATE_FORMAT(tabhorariodiario.intervalo, '%H:%i') AS intervalo, DATE_FORMAT(tabhorariodiario.hora_intervalo, '%H:%i') AS hora_intervalo, DATE_FORMAT(tabhorariodiario.horas, '%H:%i') AS horas, tabhorariodiario.funcionario_disponiveis
                                                FROM tabhorariodiario
                                            INNER JOIN tabturno ON tabturno.idtabturno = tabhorariodiario.turno ORDER BY tabhorariodiario.data, tabhorariodiario.turno");
                $sql->execute();
                $result = $sql->get_result();
                while($res= $result->fetch_assoc()){
                    ?>
                                <tr>
                                    <td><?php echo $res['dataturno'] ?></td>
                                    <td><?php echo $res['nometurno'] ?></td>
                                    <td><?php echo $res['inicio'] ?></td>
                                    <td><?php echo $res['fim'] ?></td>
                                    <td><?php echo $res['hora_intervalo'] ?></td>
                                    <td><?php echo $res['intervalo'] ?></td>
                                    <td><?php echo $res['horas'] ?></td>
                                    <td><?php echo $res['funcionario_disponiveis'] ?></td>
                                </tr>
                                <?php
                }
                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col l2">
                <div class="row center" style="margin-top: 5%;">
                    <button data-target="cadastro_turno" class="btn modal-trigger light-blue darken-3">Novo
                        turno</button>
                </div>
            </div>
        </div>

        <div id="cadastro_turno" class="modal">
            <div class="modal-content">
                <h4>Novo turno</h4>
                <form method="post" id="form_turno">
                    <div class="row">
                        <div class="input-field col l4">
                            <select name="turno" id="turno">
                                <option value="" disabled selected>Selecione um turno</option>
                                <?php
                                include '../config/conexao.php';
                                $sql = "SELECT * FROM tabturno";
                                $result=$connect->query($sql);
                                while($res = $result->fetch_array()){
                            ?>
                                <option value='<?php echo $res['idtabturno'] ?>'><?php echo $res['nometurno'] ?>
                                </option>
                                <?php
                        }
                        ?>
                            </select>
                            <label>Turno</label>
                        </div>
                        <div class="col l3">
                            <h5 id="previsao_a" name="previsao"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l4">
                            <input placeholder="dd/mm/aaaa" id="data" type="text" class="datepicker" name="data">
                            <label for="hora_inicio_a">Data</label>
                            <span class="helper-text" data-error="Turno ja cadastrado"></span>
                        </div>
                        <div class="input-field col l4">
                            <input placeholder="HH:MM" id="hora_inicio_a" type="text" class="timepicker tempo"
                                name="hora_inicio_a">
                            <label for="hora_inicio_a">Início</label>
                        </div>
                        <div class="input-field col l4">
                            <input placeholder="HH:MM" id="hora_fim_a" type="text" class="timepicker tempo"
                                name="hora_fim_a">
                            <label for="hora_fim_a">Fim</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l4">
                            <input placeholder="HH:MM" id="intervalo_a" type="text" class="validate intervalo tempo"
                                name="intervalo_a">
                            <label for="intervalo_a">Intervalo</label>
                        </div>
                        <div class="input-field col l4">
                            <input placeholder="HH:MM" id="inicio_intervalo_a" type="text" class="validate intervalo"
                                name="inicio_intervalo_a">
                            <label for="inicio_intervalo_a">Inicio do intervalo</label>
                        </div>
                        <div class="input-field col l4">
                            <input id="funcionarios" type="text" class="validate" name="funcionarios">
                            <label for="funcionarios">Funcionários</label>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                        <h5>Maquinas</h5>
                    </div>
                    <div class="row">
                        <?php

                        $sqlMaquinas = $connect->prepare("SELECT tabmaquinas.nome_maquina, tabmaquinas.idtabmaquinas FROM tabmaquinas");
                        $sqlMaquinas->execute();
                        $resultMaquinas = $sqlMaquinas->get_result();

                        while($resMaquinas = $resultMaquinas->fetch_assoc()){
                            ?>
                        <div class="col l6">
                            <p class="center"><?php echo $resMaquinas['nome_maquina'] ?></p>
                            <div class="switch center">
                                <label>
                                    Indisponivel
                                    <input type="checkbox" class="maquinas"
                                        data-id-maq="<?php echo $resMaquinas['idtabmaquinas'] ?>">
                                    <span class="lever"></span>
                                    Disponivel
                                </label>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="row center">
                        <button class='btn light-blue darken-3' type='submit' id="registra" name='action'>Registrar
                            <i class='material-icons right'>check</i>
                        </button>
                    </div>
                </form>
            </div>
        </div> -->

        <div class="row">
            <div class="col l2"></div>
            <div class="col l8">
                <h4 class='center'>Horários</h4>
                <div class="row">
                    <div class="col l12">
                        <?php

                        // seleciona todas as maquinas só para dar nome na hora de apresentar
                        $sql_maquinas = mysqli_query($connect, "SELECT * FROM tabmaquinas ORDER BY idtabmaquinas ASC");
                        while ($maquina = mysqli_fetch_assoc($sql_maquinas)) {
                            $maquinas[$maquina['idtabmaquinas']] = $maquina['nome_maquina'];
                        }

                        // seleciona todos os turno após o dia atual
                        $hoje = date('Y-m-d');
                        $sql = $connect->prepare("SELECT * FROM tabhorariodiario WHERE data > '" . $hoje . "' ORDER BY data ASC");
                        $sql->execute();
                        $result = $sql->get_result();

                        // roda todos eles para criar um conjunto pra cada
                        while ($res = $result->fetch_assoc()) {
                            if ($res['turno'] == 1) {
                                $turno = 'Diurno';
                            } else {
                                $turno = 'Noturo';
                            }
                        ?>

                            <!-- collapsible para mostrar o turno e suas máquinas -->
                            <ul class="collapsible">
                                <li>
                                    <div class="collapsible-header">
                                        <table class="table centered card black-text">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Data</th>
                                                    <th>Início</th>
                                                    <th>Fim</th>
                                                    <th>Intervalo</th>
                                                    <th>Turno</th>
                                                    <th>Quant. Func.</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <td><?php echo $res['idtabhorariodiario'] ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($res['data'])) ?></td>
                                            <td><?php echo $res['inicio'] ?></td>
                                            <td><?php echo $res['fim'] ?></td>
                                            <td><?php echo $res['hora_intervalo'] ?></td>
                                            <td><?php echo $turno ?></td>
                                            <td><?php echo $res['funcionario_disponiveis'] ?></td>
                                            <td>
                                                <a href="../controller/delete/deleteHoMa.php?id=<?php echo $res['idtabhorariodiario']."&data=".$res['data']."&option=1"; ?>">
                                                    <button data-target="exclui" data-id="<?php echo $res['idtabhorariodiario'] ?>" class="btn-small white red-text text-darken-3 modal-trigger exclui">
                                                        <i style="margin-right: 0rem" class="material-icons">delete</i>
                                                    </button>
                                                </a>
                                            </td>
                                        </table>
                                    </div>
                                    <div class="collapsible-body">
                                        <table class="table centered card">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Data</th>
                                                    <th>Máquina</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql2 = $connect->prepare("SELECT * FROM tabmaquinasdisponiveis WHERE data = '" . $res['data'] . "' ORDER BY idmaquina ASC");
                                                $sql2->execute();
                                                $result2 = $sql2->get_result();
                                                while ($res2 = $result2->fetch_assoc()) {
                                                ?>

                                                    <tr>
                                                        <td><?php echo $res2['idtabmaquinasdisponiveis'] ?></td>
                                                        <td><?php echo date('d/m/Y', strtotime($res2['data'])) ?></td>
                                                        <td><?php echo $maquinas[$res2['idmaquina']] ?></td>
                                                        <td>
                                                            <a href="../controller/delete/deleteHoMa.php?id=<?php echo $res2['idtabmaquinasdisponiveis']."&data=".$res2['data']."&option=2"; ?>">
                                                                <button data-target="exclui" data-id="<?php echo $res2['idtabmaquinasdisponiveis'] ?>" class="btn-small white red-text text-darken-3 modal-trigger exclui">
                                                                    <i style="margin-right: 0rem" class="material-icons">delete</i>
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                            </ul>

                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col l2"></div>
        </div>
    </main>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="../../js/lista.js"></script>
    <script>
    $(document).ready(function() {
        $.validator.setDefaults({
            ignore: []
        });

        $("#form_turno").validate({
            rules: {
                turno: {
                    required: true
                },
                data: {
                    required: true
                },
                hora_inicio_a: {
                    required: true
                },
                hora_fim_a: {
                    required: true
                },
                intervalo_a: {
                    required: true
                },
                inicio_intervalo_a: {
                    required: true
                },
                funcionarios: {
                    required: true,
                    number: true
                }
            },
            //For custom messages
            messages: {
                turno: {
                    required: "Campo obrigatório"
                },
                data: {
                    required: "Campo obrigatório"
                },
                hora_inicio_a: {
                    required: "Campo obrigatório"
                },
                hora_fim_a: {
                    required: "Campo obrigatório"
                },
                intervalo_a: {
                    required: "Campo obrigatório"
                },
                inicio_intervalo_a: {
                    required: "Campo obrigatório"
                },
                funcionarios: {
                    required: "Campo obrigatório",
                    number: "Este campo precisa ser um numero"
                }
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.css({
                    'color': 'red',
                    'float': 'left',
                    'font-size': '80%'
                });
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error);
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $("#form_turno").submit(function(e) {
            if ($("#form_turno").validate().errorList.length == 0) {
                var url = "../controller/insert/insereTurno.php?prev=" + $("#form_turno").attr(
                    'data-prev');
                url += "&maq=";
                $(".maquinas:checked").each(function() {


                    url += "-" + $(this).attr("data-id-maq");
                });

                $("#form_turno").attr("action", url);
            } else {
                e.preventDefault();
            }
        });

        $('.collapsible').collapsible();

        $(".modal").modal();

        $('.datepicker').datepicker({
            defaultDate: new Date(),
            container: document.body,
            format: 'dd/mm/yyyy',
            i18n: {
                cancel: "Cancelar",
                clear: "Limpar",
                done: "Ok",
                months: [
                    'Janeiro',
                    'Fevereiro',
                    'Março',
                    'Abril',
                    'Maio',
                    'Junho',
                    'Julho',
                    'Agosto',
                    'Setembro',
                    'Outubro',
                    'Novembro',
                    'Dezembro'
                ],
                monthsShort: [
                    'Jan',
                    'Fev',
                    'Mar',
                    'Abr',
                    'Mai',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Set',
                    'Out',
                    'Nov',
                    'Dez'
                ],
                weekdays: [
                    'Domingo',
                    'Segunda',
                    'Terça',
                    'Quarta',
                    'Quinta',
                    'Sexta',
                    'Sábado'
                ],
                weekdaysShort: [
                    'Dom',
                    'Seg',
                    'Ter',
                    'Qua',
                    'Qui',
                    'Sex',
                    'Sáb'
                ],
                weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S']
            }
        });

        $('.timepicker').timepicker({
            container: 'body',
            i18n: {
                cancel: "Cancelar",
                clear: "Limpar",
                done: "Ok"
            },
            twelveHour: false
        });

        $("#data").change(function() {
            var dados = $("#form_turno").serialize();

            $.ajax({
                url: '../controller/select/verificaTurno.php',
                type: 'POST',
                data: dados,
                success: function(data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    if (data.cod == "1") {
                        $("input[name='data']").addClass("invalid");
                    } else {
                        $("input[name='data']").removeClass("invalid");
                    }

                }
            });
        });

        $("#turno").change(function() {
            var dados = $("#form_turno").serialize();

            $.ajax({
                url: '../controller/select/verificaTurno.php',
                type: 'POST',
                data: dados,
                success: function(data) {
                    data = $.parseJSON(data);
                    if (data.cod == "1") {
                        $("input[name='data']").addClass("invalid");
                    } else {
                        $("input[name='data']").removeClass("invalid");
                    }

                }
            });
        });

        $(".intervalo").mask("99:99");

        $(".tempo").change(function() {
            var tempoFinal = $("#hora_fim_a").val().split(":");
            var horaFinal = parseInt(tempoFinal[0]);
            var minFinal = parseInt(tempoFinal[1]);
            var url = "../controller/insert/insereTurno.php";

            var minFinalTotal = (horaFinal * 60) + minFinal;

            var tempoInicio = $("#hora_inicio_a").val().split(":");

            var horaInicio = parseInt(tempoInicio[0]);
            var minInicio = parseInt(tempoInicio[1]);

            var minInicioTotal = (horaInicio * 60) + minInicio;

            if (minInicioTotal > minFinalTotal) {
                alert("A hora inicial deve ser menor que a hora final!");
                $("#hora_fim_a").val('');
                $("#hora_inicio_a").val('');
                $("#previsao_a").text('');
            } else {
                var previsao = minFinalTotal - minInicioTotal;

                if ($("#intervalo_a").val() != '') {
                    var tempoInt = $("#intervalo_a").val().split(":");

                    var horaInt = parseInt(tempoInt[0]);
                    var minInt = parseInt(tempoInt[1]);
                    var intTotal = (horaInt * 60) + minInt;

                    if ($("#hora_fim_a").val() != '' && $("#hora_inicio_a").val() != '') {
                        if (intTotal > previsao) {
                            alert("O intervalo nao pode ser maior que o tempo total do turno!");
                            $("#intervalo_a").val('');
                        } else {
                            previsao -= intTotal;

                            var horaPrev = parseInt(previsao / 60);

                            if (horaPrev < 10) {
                                horaPrev = "0" + horaPrev;
                            }
                            var minPrev = parseInt(previsao % 60);
                            if (minPrev < 10) {
                                minPrev = "0" + minPrev;
                            }

                            $("#previsao_a").text(horaPrev + ":" + minPrev);
                            prev = horaPrev + ":" + minPrev;
                            $("#form_turno").attr("data-prev", prev);
                        }
                    }


                } else {
                    if ($("#hora_fim_a").val() != '' && $("#hora_inicio_a").val() != '') {
                        var horaPrev = parseInt(previsao / 60);

                        if (horaPrev < 10) {
                            horaPrev = "0" + horaPrev;
                        }
                        var minPrev = parseInt(previsao % 60);
                        if (minPrev < 10) {
                            minPrev = "0" + minPrev;
                        }

                        $("#previsao_a").text(horaPrev + ":" + minPrev);
                        prev = horaPrev + ":" + minPrev;
                        $("#form_turno").attr("data-prev", prev);
                    }
                }
            }
        });

    });
    </script>
</body>