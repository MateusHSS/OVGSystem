<?php
    session_start();
    include_once '../config/conexao.php';
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
        <div class="row">
            <div class="col l2">
                <div class="container">
                    <div class="row">
                        <h5>Filtros</h5>
                    </div>
                    <div class="row center">
                        <form id="filtro_status">
                            <div class="input-field col l12">
                                <select name="filtro" id="filtro">
                                    <?php
                                    $sqlFiltroStatus = $connect->prepare("SELECT * FROM tabstatus");
                                    $sqlFiltroStatus->execute();
                                    $resultFiltroStatus = $sqlFiltroStatus->get_result();

                                    while($resFiltroStatus = $resultFiltroStatus->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $resFiltroStatus['idtabstatus'] ?>"><?php echo $resFiltroStatus['nomestatus'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <label>Status</label>
                            </div>
                            <div class="row">
                                <button class="btn" type="submit" name="action">Filtrar<i class="material-icons right">check</i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col l8">
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
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="lista_pedidos">
                                <?php
                $sql = $connect->prepare("SELECT tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto, tabpedido.quantidadepedido, tabpedido.dimensaopedido, tabpedido.statuspedido, tabstatus.nomestatus, tabpedido.atividade, tabatividade.descricao AS nomeatividade, tabpedido.seguranca, tabseguranca.descricao AS nomeseguranca, tabpedido.formulariopedido, DATEDIFF (NOW(), tabpedido.datainclusao) AS quantidade_dias
                                            FROM tabpedido
                                        INNER JOIN tabcliente ON tabcliente.idcliente = tabpedido.clientepedido
                                        INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido
                                        INNER JOIN tabstatus ON tabstatus.idtabstatus = tabpedido.statuspedido
                                        INNER JOIN tabatividade ON tabatividade.idtabatividade = tabpedido.atividade
                                        INNER JOIN tabseguranca	ON tabseguranca.idtabseguranca = tabpedido.seguranca
                                            WHERE  DATEDIFF (NOW(), tabpedido.datainclusao) < 90 ORDER BY tabpedido.statuspedido, tabpedido.datainclusao LIMIT 100");
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
                                    <?php
                                    if($res['statuspedido'] == 1 || $res['statuspedido'] == 3 || $res['statuspedido'] == 6 || $res['statuspedido'] == 8){
                                        ?>
                                    <td>
                                        <a class='dropdown-trigger btn-flat' href='#'
                                            data-target='drop_completo<?php echo $res['idpedido'] ?>'><i
                                                class="material-icons">more_vert</i></a>

                                        <!-- Dropdown Structure -->
                                        <ul id='drop_completo<?php echo $res['idpedido'] ?>' class='dropdown-content'
                                            style="width: 360px !important">

                                            <li><a data-target="detalhes" data-id="<?php echo $res['idpedido'] ?>"
                                                    class="modal-trigger detalhes blue-text text-darken-3">
                                                    <i class="material-icons blue-text text-darken-3">list</i>Detalhes
                                                </a>
                                            </li>
                                            <?php
                                                if($_SESSION['perfil'] == 1){
                                                    ?>
                                            <li>
                                                <a data-target="edita" data-id="<?php echo $res['idpedido'] ?>"
                                                    class="modal-trigger atualiza orange-text text-darken-3">
                                                    <i class="material-icons orange-text text-darken-3">edit</i>Editar
                                                </a>
                                            </li>
                                            <li>
                                                <a data-target="exclui" data-id="<?php echo $res['idpedido'] ?>"
                                                    class="modal-trigger exclui red-text text-darken-3">
                                                    <i class="material-icons red-text text-darken-3">delete</i>Excluir
                                                </a>
                                            </li>
                                                    <?php
                                                }
                                            ?>
                                        </ul>
                                    </td>
                                    <?php
                                    }else{
                                        ?>
                                    <td>
                                        <a class='dropdown-trigger btn-flat' href='#'
                                            data-target='drop_detalhes<?php echo $res['idpedido'] ?>'><i
                                                class="material-icons">more_vert</i></a>

                                        <!-- Dropdown Structure -->
                                        <ul id='drop_detalhes<?php echo $res['idpedido'] ?>' class='dropdown-content'>
                                            <li>
                                                <a data-target="detalhes" data-id="<?php echo $res['idpedido'] ?>"
                                                    class="modal-trigger detalhes blue-text text-darken-3"><i
                                                        class="material-icons blue-text text-darken-3">list</i>Detalhes</a>
                                            </li>
                                        </ul>
                                    </td>
                                    <?php
                                    }
                                ?>
                                </tr>
                                <?php
                }
                if($result->num_rows >= 100){
                    ?>
                                <tr class="carregar_mais">
                                    <td colspan="6">Carregar mais...</td>
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


                <div class='modal fade' id="detalhes">
                    <div class='modal-content'>
                        <div class='row right'><i class='material-icons modal-close'>close</i></div>
                        <h4>Detalhes</h4>
                        <div class='divider'></div>
                        <div class="row left-align">
                            <div class="col l6">
                                <p>Cliente: <span id="nome_cliente_detalhes"></span></p>
                                <p>Produto: <span id="nome_produto_detalhes"></span></p>
                                <p>Quantidade: <span id="qtd_detalhes"></span></p>
                                <p>Dimensao: <span id="dimensao_detalhes"></span></p>
                            </div>
                            <div class="col l6">
                                <p>Atividade: <span id="atividade_detalhes"></span></p>
                                <p>Seguranca: <span id="seguranca_detalhes"></span></p>
                                <p>Formulário: <span id="form_detalhes"></span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='modal fade' id="edita">
                    <div class='modal-content'>
                        <div class='row right'><i class='material-icons modal-close'>close</i></div>
                        <h4>Editar</h4>
                        <div class='divider'></div>
                        <div class="row">
                            <p>Cliente: <span id="nome_cliente"></span></p>
                            <p>Produto: <span id="nome_produto"></span></p>
                        </div>
                        <form method='post' action='#' id='form_edita' enctype="multipart/form-data">
                            <div class="row">
                                <div class="input-field col l2">
                                    <input id="qtd" type="text" class="validate" name="qtd">
                                    <label for="qtd">Quantidade</label>
                                </div>
                                <div class="input-field col l1">
                                    <input id="alt" type="text" class="validate" name="alt">
                                    <label for="alt">Altura</label>
                                </div>
                                <div class="input-field col l1">
                                    <input id="larg" type="text" class="validate" name="larg">
                                    <label for="larg">Largura</label>
                                </div>
                                <div class="input-field col l3">
                                    <select name="atividade" id="atividade">
                                        <?php
                                        $sqlAtividades = $connect->prepare("SELECT * FROM tabatividade");
                                        $sqlAtividades->execute();

                                        $resultAtividades = $sqlAtividades->get_result();

                                        while($resAtividades = $resultAtividades->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $resAtividades['idtabatividade'] ?>"><?php echo $resAtividades['descricao'] ?></option>
                                        <?php
                                        }
                                    ?>
                                    </select>
                                    <label>Atividade</label>
                                </div>
                                <div class="input-field col l3">
                                    <select name="seguranca" id="seguranca">
                                        <?php
                                        $sqlSegurancas = $connect->prepare("SELECT * FROM tabseguranca");
                                        $sqlSegurancas->execute();

                                        $resultSegurancas = $sqlSegurancas->get_result();

                                        while($resSegurancas = $resultSegurancas->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $resSegurancas['idtabseguranca'] ?>"><?php echo $resSegurancas['descricao'] ?></option>
                                        <?php
                                        }
                                    ?>
                                    </select>
                                    <label>Segurança</label>
                                </div>
                                <?php 
                                    if($_SESSION['perfil'] == 1){
                                        ?>
                                        <div class="col l2">
                                            <p>
                                                <label>
                                                    <input type="checkbox" id="emergencial_modal" name="emergencial"/>
                                                    <span>Emergencial</span>
                                                </label>
                                            </p>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="row">
                                <div class="file-field input-field col l6" id="formPed">
                                    <div class="btn small">
                                        <span>Procurar<i class="material-icons right">computer</i></span>
                                        <input type="file" name='formulario_pedido' id='formulario_pedido'>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder='Anexar formulário'>
                                    </div>
                                </div>
                                <div class="col l6" id="formPedText">

                                </div>
                            </div>
                            <div class="row">
                                <button class="btn" id="enviar" type="submit" name="action">Atualizar
                                    <i class="material-icons right">check</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- MODAL EXCLUI -->
                <div id="exclui" class="modal">
                    <div class="modal-content">
                        <i class='material-icons right modal-close' id='fechar_modal'>close</i>
                        <h5>Confirma que deseja excluir o pedido </h5>
                        <p class="red-text">ATENÇÃO: Esta ação não poderá ser revertida posteriormente!</p>
                        <div class="row left-align">
                            <div class="col l6">
                                <p>Cliente: <span id="nome_cliente_exclui"></span></p>
                                <p>Produto: <span id="nome_produto_exclui"></span></p>
                                <p>Quantidade: <span id="qtd_produto_exclui"></span></p>
                                <p>Dimensao: <span id="dimensao_exclui"></span></p>
                            </div>
                            <div class="col l6">
                                <p>Atividade: <span id="atividade_exclui"></span></p>
                                <p>Seguranca: <span id="seguranca_exclui"></span></p>
                                <p>Formulário: <span id="form_exclui"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat green-text"
                            id="confirma_exclui_button" data-id="">Confirma</a>
                        <a href="" class="modal-close waves-effect waves-red btn-flat red-text">Cancela</a>
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
    <script src="../../js/listas/listaPedidos.js"></script>
</body>

</html>