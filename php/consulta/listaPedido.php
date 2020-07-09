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

                        <?php

if($_SESSION['perfil'] == 1){
    ?>
                        <li class="tab"><a class="dropdown-trigger active" data-target="programacao-menu">PROGRAMAÇÃO<i
                                    class='material-icons right'>arrow_drop_down</i></a></li>
                        <?php
}
?>

                    </ul>

                </div>
            </div>
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
                    <table class="table centered card" id="lista_pedidos">
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
                        <tbody>
                            <?php

                include_once '../config/conexao.php';

                $sql = $connect->prepare("SELECT tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto, tabpedido.quantidadepedido, tabpedido.dimensaopedido, tabpedido.statuspedido, tabstatus.nomestatus, tabpedido.atividade, tabatividade.descricao AS nomeatividade, tabpedido.seguranca, tabseguranca.descricao AS nomeseguranca, tabpedido.formulariopedido, DATEDIFF (NOW(), tabpedido.datainclusao) AS quantidade_dias
                                            FROM tabpedido
                                        INNER JOIN tabcliente ON tabcliente.idcliente = tabpedido.clientepedido
                                        INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido
                                        INNER JOIN tabstatus ON tabstatus.idtabstatus = tabpedido.statuspedido
                                        INNER JOIN tabatividade ON tabatividade.idtabatividade = tabpedido.atividade
                                        INNER JOIN tabseguranca	ON tabseguranca.idtabseguranca = tabpedido.seguranca
                                        ORDER BY tabpedido.statuspedido, tabpedido.datainclusao LIMIT 100");
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
                                    if($res['statuspedido'] == 1 || $res['statuspedido'] == 3 || $res['statuspedido'] == 6){
                                        ?>
                                <td>
                                    <a class='dropdown-trigger btn-flat' href='#'
                                        data-target='drop_completo<?php echo $res['idpedido'] ?>'><i
                                            class="material-icons">more_vert</i></a>

                                    <!-- Dropdown Structure -->
                                    <ul id='drop_completo<?php echo $res['idpedido'] ?>' class='dropdown-content' style="width: 360px !important">
                                        
                                        <li><a data-target="detalhes" data-id="<?php echo $res['idpedido'] ?>"
                                                class="modal-trigger detalhes blue-text text-darken-3">
                                                <i class="material-icons blue-text text-darken-3">list</i>Detalhes
                                            </a>
                                        </li>
                                        <li>
                                            <a data-target="edita" data-id="<?php echo $res['idpedido'] ?>"
                                                class="modal-trigger atualiza orange-text text-darken-3">
                                                <i class="material-icons orange-text text-darken-3">edit</i>Editar
                                            </a>
                                        </li>
                                        <li><a data-target="exclui" data-id="<?php echo $res['idpedido'] ?>"
                                                class="modal-trigger exclui red-text text-darken-3">
                                                <i class="material-icons red-text text-darken-3">delete</i>Excluir
                                            </a></li>
                                    </ul>
                                    <!-- <button data-target="edita" data-id="<?php echo $res['idpedido'] ?>"
                                        class="btn-small white modal-trigger atualiza ">
                                        <i class="material-icons orange-text text-darken-3">edit</i>
                                    </button>
                                    <button data-target="detalhes" data-id="<?php echo $res['idpedido'] ?>"
                                        class="btn-small white modal-trigger detalhes">
                                        <i class="material-icons blue-text text-darken-3">list</i>
                                    </button>
                                    <button data-target="exclui" data-id="<?php echo $res['idpedido'] ?>"
                                        class="btn-small white modal-trigger exclui">
                                        <i class="material-icons red-text text-darken-3">delete</i>
                                    </button> -->
                                </td>
                                <?php
                                    }else{
                                        ?>
                                <td>
                                    <a class='dropdown-trigger btn-flat' href='#'
                                        data-target='drop_detalhes<?php echo $res['idpedido'] ?>'><i
                                            class="material-icons">more_vert</i></a>
                                    <!-- <button data-target="detalhes" data-id="<?php echo $res['idpedido'] ?>"
                                        class="btn-small white modal-trigger detalhes">
                                        <i class="material-icons orange-text text-darken-3">list</i>
                                    </button> -->

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
                            <div class="input-field col l2">
                                <input id="dimensao" type="text" class="validate" name="dimensao">
                                <label for="dimensao">Dimensão</label>
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
                            <div class="input-field col l4">
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
    </main>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script src="../../js/listas/listaPedidos.js"></script>
</body>

</html>