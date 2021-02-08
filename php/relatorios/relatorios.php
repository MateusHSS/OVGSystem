<?php
    session_start();
    error_reporting(E_ERROR);

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

    <link rel="stylesheet" href="../../css/relatorios.css">

    <!-- Compiled and minified JavaScript -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


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
                <li><a href='../consulta/listaAtividade.php'>Atividades</a></li>
                <li><a href='../consulta/listaCliente.php'>Clientes</a></li>
                <li><a href='../consulta/listaCorredor.php'>Corredores</a></li>
                <li><a href='../consulta/listaFuncionario.php'>Funcionários</a></li>
                <li><a href='../consulta/listaMaterial.php'>Materiais</a></li>
                <li><a href='../consulta/listaProcessos.php'>Processos</a></li>
                <li><a href='../consulta/listaProduto.php'>Produtos</a></li>
                <li><a href='../consulta/listaSeguranca.php'>Seguranças</a></li>
                <li><a href='../consulta/listaSetor.php'>Setores</a></li>
                <li><a href='../consulta/listaStatus.php'>Status</a></li>
                <li><a href='../consulta/listaUsuario.php'>Usuários</a></li>
            </ul>

            <!-- MENU ESTOQUE -->
            <ul id="estoque-menu" class="dropdown-content">
                <li><a href='../consulta/listaEstoque.php'>Controle</a></li>
                <li><a href='../cadastro/entradaEstoque.php'>Entrada</a></li>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='../cadastro/cadastroPedido.php'>Incluir Novo</a></li>
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

                    <li class="tab"><a class="dropdown-trigger active" data-target="estoque-menu">ESTOQUE<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active" data-target="pedido-menu">PEDIDO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="active" href="relatorios.php">RELATÓRIOS</a></li>

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
                <li><a href='../consulta/listaAtividade.php'>Atividades</a></li>
                <li><a href='../consulta/listaCliente.php'>Clientes</a></li>
                <li><a href='../consulta/listaCorredor.php'>Corredores</a></li>
                <li><a href='../consulta/listaFuncionario.php'>Funcionários</a></li>
                <li><a href='../consulta/listaMaterial.php'>Materiais</a></li>
                <li><a href='../consulta/listaProcessos.php'>Processos</a></li>
                <li><a href='../consulta/listaProduto.php'>Produtos</a></li>
                <li><a href='../consulta/listaSeguranca.php'>Seguranças</a></li>
                <li><a href='../consulta/listaSetor.php'>Setores</a></li>
                <li><a href='../consulta/listaStatus.php'>Status</a></li>
                <li><a href='../consulta/listaUsuario.php'>Usuários</a></li>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='../cadastro/cadastroPedido.php'>Incluir Novo</a></li>
                <li><a href='../consulta/listaPedido.php'>Lista</a></li>
            </ul>

            <div class="nav-content">

                <ul class="tabs">

                    <li class="tab"><a class="dropdown-trigger active" data-target="cadastro-menu">CADASTRO<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active" data-target="consulta-menu">CONSULTA<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

                    <li class="tab"><a class="dropdown-trigger active" href="relatorios.php">PEDIDO</a></li>

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
                                <div>Totais data atual<a href="estoque/totaisDataAtual.php" target="_blank"
                                        class="secondary-content"><i class="material-icons">open_in_browser</i></a>
                                </div>
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
                                <div>Entrega de pedidos<a data-target="periodo_entrega_pedidos"
                                        class="secondary-content modal-trigger"><i
                                            class="material-icons">open_in_browser</i></a></div>
                            </li>
                            <li class="collection-item">
                                <div>Pedidos realizados por dia<a data-target="pedidos_dia"
                                        class="secondary-content modal-trigger"><i
                                            class="material-icons">open_in_browser</i></a></div>
                            </li>
                            <li class="collection-item">
                                <div>Materiais gastos por pedido<a data-target="material_gasto_pedido_periodo" class="secondary-content modal-trigger"><i
                                            class="material-icons">open_in_browser</i></a></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row center">
                    <h4>Gráficos</h4>
                    <div class="col l2">
                        <ul class="collection">
                            <li class="collection-item">Atividade<i class="material-icons right" id="grafico1">bar_chart</i></li>
                            <li class="collection-item">Tempo médio<i class="material-icons right" id="grafico2">bar_chart</i></li>
                            <li class="collection-item">Status<i class="material-icons right" id="grafico3">bar_chart</i></li>
                            <li class="collection-item">Emergenciais<i class="material-icons right" id="grafico4">bar_chart</i></li>
                        </ul>
                    </div>
                    <div class="col l10 card">
                        <!--Div that will hold the pie chart-->
                        <div id="chart_div" style="width: 900px; height: 400px;"></div>
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
                                <input placeholder="dd/mm/aaaa" id="fim" type="text" class="datepicker" name="fim">
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
                                <input placeholder="dd/mm/aaaa" id="fim" type="text" class="datepicker" name="fim">
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
        <div id="material_gasto_pedido_periodo" class="modal">
            <div class="modal-content">
                <h4>Selecionar período</h4>
                <div class="row">
                    <form action="producao/materiaisPedido.php" method="post" target="_blank">
                        <div class="row">
                            <div class="input-field col l6">
                                <input placeholder="dd/mm/aaaa" id="inicio" type="text" class="datepicker"
                                    name="inicio">
                                <label for="inicio">Início</label>
                            </div>
                            <div class="input-field col l6">
                                <input placeholder="dd/mm/aaaa" id="fim" type="text" class="datepicker" name="fim">
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
                                <input placeholder="dd/mm/aaaa" id="data" type="text" class="datepicker" name="data">
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
    <script>
        google.charts.load('current', {'packages':['corechart']});

        $('#grafico1').click(function(){
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
            ['Dale', 'Pedidos', {type: 'number', role: 'annotation'}, 'Peças', {type: 'number', role: 'annotation'}],
            <?php
                include_once "../config/conexao.php";

                //PEDIDOS ENTREGUES
                $sqlSelecionaPedidosEntregues = $connect->prepare("SELECT COUNT(*) AS entregues FROM tabpedido WHERE final_real BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -365 DAY) AND CURRENT_DATE()");
                $sqlSelecionaPedidosEntregues->execute();
                $resultPedidosEntregues = $sqlSelecionaPedidosEntregues->get_result();
                $resPedidosEntregues = $resultPedidosEntregues->fetch_assoc();

                //PECAS ENTREGUES
                $sqlSelecionaPecasEntregues = $connect->prepare("SELECT SUM(tabpedido.quantidadepedido) AS pecas_entregues FROM tabpedido WHERE final_real BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -365 DAY) AND CURRENT_DATE()");
                $sqlSelecionaPecasEntregues->execute();
                $resultPecasEntregues = $sqlSelecionaPecasEntregues->get_result();
                $resPecasEntregues = $resultPecasEntregues->fetch_assoc();

                //PEDIDOS PREVISTOS
                $sqlSelecionaPedidosPrevistos = $connect->prepare("SELECT COUNT(*) AS previstos FROM tabpedido WHERE previsao BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -365 DAY) AND CURRENT_DATE()");
                $sqlSelecionaPedidosPrevistos->execute();
                $resultPedidosPrevistos = $sqlSelecionaPedidosPrevistos->get_result();
                $resPedidosPrevistos = $resultPedidosPrevistos->fetch_assoc();

                //PECAS PREVISTAS
                $sqlSelecionaPecasPrevistas = $connect->prepare("SELECT SUM(tabpedido.quantidadepedido) AS pecas_previstas FROM tabpedido WHERE previsao BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -365 DAY) AND CURRENT_DATE()");
                $sqlSelecionaPecasPrevistas->execute();
                $resultPecasPrevistas = $sqlSelecionaPecasPrevistas->get_result();
                $resPecasPrevistas = $resultPecasPrevistas->fetch_assoc();
                
                //DIFERENCAS
                $diferencaPedidos = intval($resPedidosPrevistos['previstos']) - intval($resPedidosEntregues['entregues']);
                $diferencaPecas = intval($resPecasPrevistas['pecas_previstas']) - intval($resPecasEntregues['pecas_entregues']);
            ?>
            ['Programado',  <?php echo $resPedidosPrevistos['previstos'] ?>, <?php echo $resPedidosPrevistos['previstos'] ?>, <?php echo $resPecasPrevistas['pecas_previstas'] ?>, <?php echo $resPecasPrevistas['pecas_previstas'] ?>],
            ['Real',  <?php echo $resPedidosEntregues['entregues'] ?>, <?php echo $resPedidosEntregues['entregues'] ?>, <?php echo $resPecasEntregues['pecas_entregues'] ?>, <?php echo $resPecasEntregues['pecas_entregues'] ?>],
            ['Gap',  <?php echo $diferencaPedidos ?>, <?php echo $diferencaPedidos ?>, <?php echo $diferencaPecas ?>, <?php echo $diferencaPecas ?>]
            ]);

            var options = {
            title : 'Atividade grupo de pecas (últimos 365 dias)',
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: 'black',
                    auraColor: 'none'
                }
            },
            vAxis: {title: 'Quantidade'},
            seriesType: 'bars',
            series: {5: {type: 'line'}}        };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            google.visualization.events.addListener(chart, 'click', function () {
                var imgUri = chart.getImageURI();
                // do something with the image URI, like:
                window.open(imgUri);
            });
            chart.draw(data, options);
        });

        $('#grafico2').click(function(){
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
            ['Pedidos', 'Tempo médio (dias)', {type: 'number', role: 'annotation'}, { role: 'style' }],
            <?php
                include_once "../config/conexao.php";

                $sqlSelecionaPeriodo = $connect->prepare("SELECT count(*) AS total, SUM(datediff(tabpedido.final_real, tabpedido.datainclusao)) AS tempo FROM tabpedido WHERE tabpedido.final_real IS NOT null AND tabpedido.final_real BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -30 DAY) AND CURRENT_DATE()");
                $sqlSelecionaPeriodo->execute();
                $resultPeriodo = $sqlSelecionaPeriodo->get_result();
                $resPeriodo = $resultPeriodo->fetch_assoc();
                $media = intval($resPeriodo['tempo']/$resPeriodo['total']);
            ?>
            ['Dias',  <?php echo $media ?>,  <?php echo $media ?>, 'blue'],
            ]);

            var options = {
            title : 'Tempo médio gasto por pedido (últimos 30 dias)',
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: 'black',
                    auraColor: 'none'
                }
            },
            vAxis: {title: 'Quantidade'},
            seriesType: 'bars',
            series: {5: {type: 'line'}}        };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            google.visualization.events.addListener(chart, 'click', function () {
                var imgUri = chart.getImageURI();
                // do something with the image URI, like:
                window.open(imgUri);
            });
            chart.draw(data, options);
        });

        $('#grafico3').click(function(){
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
            ['Status', 'Status', {type: 'number', role: 'annotation'}],
            <?php
                include_once "../config/conexao.php";

                $sqlSelecionaStatus = $connect->prepare("SELECT COUNT(tabpedido.statuspedido) AS qtd, tabstatus.nomestatus FROM tabpedido
                                                            INNER JOIN tabstatus ON tabpedido.statuspedido = tabstatus.idtabstatus
                                                        GROUP BY tabpedido.statuspedido");
                $sqlSelecionaStatus->execute();
                $resultStatus = $sqlSelecionaStatus->get_result();
            ?>
                <?php
                    while ($resStatus = $resultStatus->fetch_assoc()){
                        echo "['".$resStatus['nomestatus']."', ".$resStatus['qtd'].", ".$resStatus['qtd']."],";
                    }
                ?>
            ]);

            var options = {
            title : 'Quantidade de pedidos por status',
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: 'black',
                    auraColor: 'none'
                }
            },
            vAxis: {title: 'Quantidade'},
            seriesType: 'bars',
            series: {5: {type: 'line'}}        };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            google.visualization.events.addListener(chart, 'click', function () {
                var imgUri = chart.getImageURI();
                // do something with the image URI, like:
                window.open(imgUri);
            });
            chart.draw(data, options);
        });

        $('#grafico4').click(function(){
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
            ['Status', 'Mes', {type: 'number', role: 'annotation'}, 'Semana', {type: 'number', role: 'annotation'}],
            <?php
                include_once "../config/conexao.php";

                $sqlSelecionaEmergMes = $connect->prepare("SELECT COUNT(tabpedido.statuspedido) AS qtd, tabstatus.nomestatus FROM tabpedido
                                                            INNER JOIN tabstatus ON tabpedido.statuspedido = tabstatus.idtabstatus
                                                        WHERE tabpedido.emergencial = 2 AND tabpedido.final_real BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -30 DAY) AND CURRENT_DATE()");
                $sqlSelecionaEmergMes->execute();
                $resultMes = $sqlSelecionaEmergMes->get_result();
                $resMes = $resultMes->fetch_assoc();

                $sqlSelecionaStatusEmergSem = $connect->prepare("SELECT COUNT(tabpedido.statuspedido) AS qtd, tabstatus.nomestatus FROM tabpedido
                                                            INNER JOIN tabstatus ON tabpedido.statuspedido = tabstatus.idtabstatus
                                                        WHERE tabpedido.emergencial = 2 AND tabpedido.final_real BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -7 DAY) AND CURRENT_DATE()");
                $sqlSelecionaStatusEmergSem->execute();
                $resultSem = $sqlSelecionaStatusEmergSem->get_result();
                $resSem = $resultSem->fetch_assoc();
                
            ?>
            ['Emergencial', <?php echo $resMes['qtd'] ?>, <?php echo $resMes['qtd'] ?>, <?php echo $resSem['qtd'] ?>, <?php echo $resSem['qtd'] ?>]
            ]);

            var options = {
            title : 'Quantidade de pedidos emeregenciais',
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: 'black',
                    auraColor: 'none'
                }
            },
            vAxis: {title: 'Quantidade'},
            seriesType: 'bars',
            series: {5: {type: 'line'}}        };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            google.visualization.events.addListener(chart, 'click', function () {
                var imgUri = chart.getImageURI();
                // do something with the image URI, like:
                window.open(imgUri);
            });
            chart.draw(data, options);
        });
    </script>
</body>

</html>

<?php } ?>