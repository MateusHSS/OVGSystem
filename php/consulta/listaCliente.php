<?php
session_start();

if (!isset($_SESSION['logado'])) {
    header('location: ../../index.php');
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>OVGSYSTEM - Clientes</title>
        <link rel="shortcut icon" href="../../img/vli.ico" type="image/x-icon" />
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.css" media="screen,projection" />

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
                        <form id="filtro">
                            <div class="input-field col l12">
                                <input id="filter" type="text" class="validate">
                                <label for="filter">Procurar</label>
                            </div>
                            <div class="row">
                                <button class="btn" type="submit" name="action">Filtrar<i class="material-icons right">check</i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col l8">
                <div class="">
                    <div class="row right">
                        <a href="../home.php"><i class='material-icons right' id='fechar'>close</i></a>
                    </div>
                    <h4 class='center'>Clientes</h4>
                    <div class="row">
                        <div class="col l12">
                            <table class="centered responsive-table card" id="listagem_clientes">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th>Setor</th>
                                        <th>Corredor</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="lista_clientes">
                                    <?php

                                    include_once '../config/conexao.php';

                                    $sql = $connect->prepare("SELECT tabcliente.corredorcliente, tabcliente.idsetorcliente, tabcliente.ativo, tabcliente.idcliente, tabcliente.nomecliente, tabcliente.telefonecliente, tabsetor.nomesetor, tabcorredor.nomecorredor
                                                        FROM tabcliente
                                                    INNER JOIN tabsetor ON tabcliente.idsetorcliente = tabsetor.idsetor
                                                    INNER JOIN tabcorredor ON tabcorredor.idcorredor = tabcliente.corredorcliente
                                                    ORDER BY tabcliente.datacadastrocliente DESC LIMIT 100");
                                    $sql->execute();
                                    $result = $sql->get_result();
                                    if ($result->num_rows == 0) {
                                    ?>
                                        <tr>
                                            <td colspan='7'>Nenhum registro encontrado...</td>
                                        </tr>
                                        <?php
                                    } else {
                                        while ($res = $result->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $res['idcliente'] ?></td>
                                                <td><?php echo $res['nomecliente'] ?></td>
                                                <td><?php echo $res['telefonecliente'] ?></td>
                                                <td><?php echo $res['nomesetor'] ?></td>
                                                <td><?php echo $res['nomecorredor'] ?></td>
                                                <td>
                                                    <button data-target="edita" data-id="<?php echo $res['idcliente'] ?>" class="btn-small white orange-text text-darken-3 modal-trigger edita">
                                                        <i class="material-icons">create</i>
                                                    </button>
                                                    <button data-target="exclui" data-id="<?php echo $res['idcliente'] ?>" class="btn-small white red-text text-darken-3 modal-trigger exclui">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        if ($result->num_rows >= 100) {
                                        ?>
                                            <tr class="carregar_mais">
                                                <td colspan="6">Carregar mais...</td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l2"></div>
        </div>

        <!-- MODAL EDITA -->
        <div class='modal fade' id='edita'>
            <div class='modal-content'>
                <div class='row right'><i class='material-icons modal-close'>close</i></div>
                <h4>Editar informações</h4>
                <div class='divider'></div>
                <form method='post' action='#' id='form_edita'>
                    <div class="row">
                        <div class="input-field col l6">
                            <input id="nome_cliente" type="text" class="validate" name='nome_cliente' onkeyup="this.value = this.value.toUpperCase();">
                            <label for="nome_cliente">Nome completo</label>
                        </div>
                        <div class="input-field col l6">
                            <input id="telefone_cliente" type="text" class="validate" name='telefone_cliente'>
                            <label for="telefone_cliente">Telefone</label>
                        </div>
                        <div class="input-field col l3">
                            <select name='setor_cliente' id='setor_cliente'>
                                <?php
                                $sqlSetor = $connect->prepare('SELECT * FROM tabsetor');
                                $sqlSetor->execute();

                                $resultSetor = $sqlSetor->get_result();

                                while ($resSetor = $resultSetor->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $resSetor['idsetor'] ?>"><?php echo $resSetor['nomesetor'] ?></option>
                                <?php
                                }


                                ?>
                            </select>
                            <label>Setor</label>
                        </div>
                        <div class="input-field col l3">
                            <select name='corredor_cliente' id='corredor_cliente'>
                                <?php
                                $sqlUnid = $connect->prepare('SELECT * FROM tabcorredor');
                                $sqlUnid->execute();

                                $resultUnid = $sqlUnid->get_result();

                                while ($resUnid = $resultUnid->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $resUnid['idcorredor'] ?>"><?php echo $resUnid['nomecorredor'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <label>Corredor</label>
                        </div>
                        <div class='col l3'>
                            <p>
                                <label>
                                    <input type="checkbox" class="filled-in" name='ativo' id="ativo" />
                                    <span>Ativo</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <div class="row center">
                        <button class='btn light-blue darken-3 botao' type='submit' name='action' data-id="" id="enviar">
                            Atualizar
                            <i class='material-icons right'>check</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EXCLUI -->
        <div id="exclui" class="modal">
            <div class="modal-content">
                <i class='material-icons right modal-close' id='fechar_modal'>close</i>
                <h5>Confirma que deseja excluir <span id="nome_exclui"></span></h5>
                <p class="red-text">ATENÇÃO: Esta ação não poderá ser revertida posteriormente!</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat green-text" id="confirma_exclui_button" data-id="">Confirma</a>
                <a href="" class="modal-close waves-effect waves-red btn-flat red-text">Cancela</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script src="../../js/listas/listaClientes.js"></script>
</body>

</html>

<?php } ?>