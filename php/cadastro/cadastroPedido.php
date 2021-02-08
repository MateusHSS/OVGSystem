<?php
    session_start();

    if(!isset($_SESSION['logado'])){
        header('location: ../../index.php');
    }else{

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OVGSYSTEM - Novo pedido</title>
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
    <link rel="stylesheet" href="../../css/cadastroPedido.css">

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
                <li><a href='cadastroAtividade.php'>Atividade</a></li>
                <li><a href='cadastroCliente.php'>Cliente</a></li>
                <li><a href='cadastroCorredor.php'>Corredor</a></li>
                <li><a href='cadastroFuncionario.php'>Funcionário</a></li>
                <li><a href='cadastroMaterial.php'>Material</a></li>
                <li><a href='cadastroProcesso.php'>Processo</a></li>
                <li><a href='cadastroProduto.php'>Produto</a></li>
                <li><a href='cadastroSeguranca.php'>Segurança</a></li>
                <li><a href='cadastroSetor.php'>Setor</a></li>
                <li><a href='cadastroStatus.php'>Status</a></li>
                <li><a href='cadastroUsuario.php'>Usuário</a></li>
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
                <li><a href='cadastroPedido.php'>Incluir Novo</a></li>
                <li><a href='../consulta/listaPedido.php'>Lista</a></li>
                <li><a href='../consulta/retirada.php'>Retirada</a></li>
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
                <li><a href='cadastroAtividade.php'>Atividade</a></li>
                <li><a href='cadastroCliente.php'>Cliente</a></li>
                <li><a href='cadastroCorredor.php'>Corredor</a></li>
                <li><a href='cadastroFuncionario.php'>Funcionário</a></li>
                <li><a href='cadastroMaterial.php'>Material</a></li>
                <li><a href='cadastroProcesso.php'>Processo</a></li>
                <li><a href='cadastroProduto.php'>Produto</a></li>
                <li><a href='cadastroSeguranca.php'>Segurança</a></li>
                <li><a href='cadastroSetor.php'>Setor</a></li>
                <li><a href='cadastroStatus.php'>Status</a></li>
                <li><a href='cadastroUsuario.php'>Usuário</a></li>
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
                <li><a href='cadastroPedido.php'>Incluir Novo</a></li>
                <li><a href='../consulta/listaPedido.php'>Lista</a></li>
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

            <!-- MENU ESTOQUE -->
            <ul id="estoque-menu" class="dropdown-content">
                <li><a href='consulta/listaEstoque.php'>Controle</a></li>
                <li><a href='cadastro/entradaEstoque.php'>Entrada</a></li>
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
                <li><a href='cadastroProduto.php'>Produto</a></li>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='cadastroPedido.php'>Incluir Novo</a></li>
                <li><a href='../consulta/listaPedido.php'>Lista</a></li>
            </ul>

            <!-- MENU PROGRAMACAO -->
            <ul id="programacao-menu" class="dropdown-content">
                <li><a href='../consulta/programados.php'>Programados</a></li>
                <li><a href='../consulta/apontamento.php'>Apontamento</a></li>
            </ul>

            <!-- MENU ESTOQUE -->
            <ul id="estoque-menu" class="dropdown-content">
                <li><a href='../consulta/listaEstoque.php'>Controle</a></li>
                <li><a href='entradaEstoque.php'>Entrada</a></li>
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
        <div class="container">
            <div class="row right">
                <a href="../home.php"><i class='material-icons right' id='fechar'>close</i></a>
            </div>
            <h4 class='center'>Cadastro de pedido</h4>
            <form action="" method='post' class='center' id='form_pedido' enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field col l6">
                        <input id="cliente_pedido" type="text" class="autocomplete" name='cliente_pedido'
                            onkeyup="this.value = this.value.toUpperCase();">
                        <label for="cliente_pedido">Cliente</label>
                    </div>
                    <div class="input-field col l5">
                        <input id="produto_pedido" type="text" class="autocomplete" name='produto_pedido'
                            onkeyup="this.value = this.value.toUpperCase();">
                        <label for="produto_pedido">Produto</label>
                    </div>
                    <div class="input-field col l1">
                        <input id="qtd_pedido" type="text" class="validate" name='qtd_pedido'>
                        <label for="qtd_pedido">Quantidade</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l2">
                        <input id="altura" type="text" class="validate" name='altura'
                            onkeyup="this.value = this.value.toUpperCase();">
                        <label for="altura">Altura (mm)</label>
                    </div>
                    <div class="input-field col l2">
                        <input id="largura" type="text" class="validate" name='largura'
                            onkeyup="this.value = this.value.toUpperCase();">
                        <label for="largura">Largura (mm)</label>
                    </div>
                    <div class="input-field col l2">
                        <input id="espessura" type="text" class="validate" name='espessura'
                            onkeyup="this.value = this.value.toUpperCase();">
                        <label for="espessura">Espessura (mm)</label>
                    </div>
                    <div class="input-field col l3">
                        <select name="atividade_pedido">
                            <option value="" disabled selected>Atividade</option>
                            <?php
                                include_once "../config/conexao.php";

                                $sqlAtv = $connect->prepare("SELECT * FROM tabatividade");
                                $sqlAtv->execute();

                                $resultAtv = $sqlAtv->get_result();

                                while($resAtv = $resultAtv->fetch_assoc()){
                                    ?>
                            <option value="<?php echo $resAtv['idtabatividade'] ?>"><?php echo $resAtv['descricao'] ?>
                            </option>

                            <?php
                                }


                            ?>
                        </select>
                        <label>Atividade</label>
                    </div>
                    <div class="input-field col l3">
                        <select name="seguranca_pedido">
                            <option value="" disabled selected>Segurança</option>
                            <?php
                                include_once "../config/conexao.php";

                                $sqlAtv = $connect->prepare("SELECT * FROM tabseguranca");
                                $sqlAtv->execute();

                                $resultAtv = $sqlAtv->get_result();

                                while($resAtv = $resultAtv->fetch_assoc()){
                                    ?>
                            <option value="<?php echo $resAtv['idtabseguranca'] ?>"><?php echo $resAtv['descricao'] ?>
                            </option>

                            <?php
                                }
                            ?>
                        </select>
                        <label>Segurança</label>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field col l6">
                        <div class="btn small">
                            <span>Procurar<i class="material-icons right">computer</i></span>
                            <input type="file" name='formulario_pedido' id='formulario_pedido'>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder='Anexar formulário'>
                        </div>
                    </div>
                    <?php
                        if($_SESSION['perfil'] == 1){
                            ?>
                    <div class="col l3">
                        <p>
                            <label>
                                <input type="checkbox" name="emerg" id="emerg" />
                                <span>Emergencial</span>
                            </label>
                        </p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="obs_pedido" class="materialize-textarea" data-length="255"
                            name="obs_pedido"></textarea>
                        <label for="obs_pedido">Observações</label>
                    </div>
                </div>
                <button class="btn botao" type="submit" name="action">Cadastrar
                    <i class="material-icons right">check</i>
                </button>
            </form>
        </div>

        <!-- Modal Structure -->
        <div id="cadastro_cliente" class="modal">
            <div class="modal-content">
                <h4>Cliente não cadastrado</h4>
                <p>Preencha o formulário a seguir</p>
                <form action="" method='post' class='center' id="form_cadastro_cliente">
                    <div class="row">
                        <div class="input-field col l6">
                            <input id="nome_cliente" type="text" class="validate" name='nome_cliente'
                                onkeyup="this.value = this.value.toUpperCase();">
                            <label for="nome_cliente">Nome completo</label>
                        </div>
                        <div class="input-field col l6">
                            <input id="telefone_cliente" type="text" class="validate" name='telefone_cliente'>
                            <label for="telefone_cliente">Telefone</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l3">
                            <select name='setor_cliente' id='setor_cliente' title="Please select something!">
                                <option value="" disabled selected>Setor</option>
                                <?php
                        include '../config/conexao.php';
                        $sql = $connect->prepare("SELECT * FROM tabsetor");
                        $sql->execute();
                        $result = $sql->get_result();
                        while($res = $result->fetch_assoc()){
                            ?>
                                <option value='<?php echo $res['idsetor'] ?>'><?php echo $res['nomesetor'] ?></option>
                                <?php
                        }
                        ?>
                            </select>
                            <label>Setor</label>
                        </div>
                        <div class="input-field col l3">
                            <select name='corredor_cliente' id='corredor_cliente'>
                                <option value="" disabled selected>Corredor</option>
                                <?php
                        include '../config/conexao.php';
                        $sql = "SELECT * FROM tabcorredor";
                        $result=$connect->query($sql);
                        while($res = $result->fetch_array()){
                            ?>
                                <option value='<?php echo $res['idcorredor'] ?>'><?php echo $res['nomecorredor'] ?>
                                </option>
                                <?php
                        }
                        ?>
                            </select>
                            <label>Corredor</label>
                        </div>
                        <div class='col l3'>
                            <p>
                                <label>
                                    <input type="checkbox" class="filled-in" name='ativo' checked="checked" />
                                    <span>Ativo</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light" type="submit" name="action">Incluir
                        <i class="material-icons right">send</i>
                    </button>
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
    <script src="../../js/cadastro/cadastroPedido.js"></script>
</body>

</html>
<?php } ?>