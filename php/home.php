<?php
    session_start();

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
    <link rel="shortcut icon" href="../img/vli.ico" type="image/x-icon" />

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

    <link rel="stylesheet" href="../css/home.css">

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
                    <li><a href="controller/logout.php">Sair</a></li>
                    <li><img src="../img/logo-teste.png" id='nav-logo'></li>
                </ul>
            </div>

            <?php
            switch($_SESSION['perfil']){
                case 1:
                ?>
            <!-- MENU CADASTRO -->

            <ul id="cadastro-menu" class="dropdown-content">
                <li><a href='cadastro/cadastroAtividade.php'>Atividade</a></li>
                <li><a href='cadastro/cadastroCliente.php'>Cliente</a></li>
                <li><a href='cadastro/cadastroCorredor.php'>Corredor</a></li>
                <li><a href='cadastro/cadastroFuncionario.php'>Funcionário</a></li>
                <li><a href='cadastro/cadastroMaterial.php'>Material</a></li>
                <li><a href='cadastro/cadastroProcesso.php'>Processo</a></li>
                <li><a href='cadastro/cadastroProduto.php'>Produto</a></li>
                <li><a href='cadastro/cadastroSeguranca.php'>Segurança</a></li>
                <li><a href='cadastro/cadastroSetor.php'>Setor</a></li>
                <li><a href='cadastro/cadastroStatus.php'>Status</a></li>
                <li><a href='cadastro/cadastroUsuario.php'>Usuário</a></li>
            </ul>

            <!-- MENU CONSULTA -->

            <ul id="consulta-menu" class="dropdown-content">
                <li><a href='consulta/listaAtividade.php'>Atividades</a></li>
                <li><a href='consulta/listaCliente.php'>Clientes</a></li>
                <li><a href='consulta/listaCorredor.php'>Corredores</a></li>
                <li><a href='consulta/listaFuncionario.php'>Funcionários</a></li>
                <li><a href='consulta/listaMaterial.php'>Materiais</a></li>
                <li><a href='consulta/listaProcessos.php'>Processos</a></li>
                <li><a href='consulta/listaProduto.php'>Produtos</a></li>
                <li><a href='consulta/listaSeguranca.php'>Seguranças</a></li>
                <li><a href='consulta/listaSetor.php'>Setores</a></li>
                <li><a href='consulta/listaStatus.php'>Status</a></li>
                <li><a href='consulta/listaUsuario.php'>Usuários</a></li>
            </ul>

            <!-- MENU ESTOQUE -->
            <ul id="estoque-menu" class="dropdown-content">
                <li><a href='consulta/listaEstoque.php'>Controle</a></li>
                <li><a href='cadastro/entradaEstoque.php'>Entrada</a></li>
            </ul>

            <!-- MENU RELATORIOS -->

            <ul id="relatorio-menu" class="dropdown-content">
                <li><a href='relatorios/relatorio1.php' target="_blank">Opcao 1</a></li>
                <li><a href='#'>Opcao 2</a></li>
                <li><a href='#'>Opcao 3</a></li>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='cadastro/cadastroPedido.php'>Incluir Novo</a></li>
                <li><a href='consulta/listaPedido.php'>Lista</a></li>
            </ul>

            <!-- MENU PROGRAMACAO -->
            <ul id="programacao-menu" class="dropdown-content">
                <li><a href='consulta/programacao.php'>Programar</a></li>
                <li><a href='consulta/programados.php'>Programados</a></li>
                <li><a href='consulta/turno.php'>Turnos</a></li>
                <li><a href='consulta/apontamento.php'>Apontamento</a></li>
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

                    <li class="tab"><a class="dropdown-trigger active" data-target="relatorio-menu">RELATÓRIOS<i
                                class='material-icons right'>arrow_drop_down</i></a></li>

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
                <li><a href='cadastro/cadastroAtividade.php'>Atividade</a></li>
                <li><a href='cadastro/cadastroCliente.php'>Cliente</a></li>
                <li><a href='cadastro/cadastroCorredor.php'>Corredor</a></li>
                <li><a href='cadastro/cadastroFuncionario.php'>Funcionário</a></li>
                <li><a href='cadastro/cadastroMaterial.php'>Material</a></li>
                <li><a href='cadastro/cadastroProcesso.php'>Processo</a></li>
                <li><a href='cadastro/cadastroProduto.php'>Produto</a></li>
                <li><a href='cadastro/cadastroSeguranca.php'>Segurança</a></li>
                <li><a href='cadastro/cadastroSetor.php'>Setor</a></li>
                <li><a href='cadastro/cadastroStatus.php'>Status</a></li>
                <li><a href='cadastro/cadastroUsuario.php'>Usuário</a></li>
            </ul>

            <!-- MENU CONSULTA -->

            <ul id="consulta-menu" class="dropdown-content">
                <li><a href='consulta/listaAtividade.php'>Atividades</a></li>
                <li><a href='consulta/listaCliente.php'>Clientes</a></li>
                <li><a href='consulta/listaCorredor.php'>Corredores</a></li>
                <li><a href='consulta/listaFuncionario.php'>Funcionários</a></li>
                <li><a href='consulta/listaMaterial.php'>Materiais</a></li>
                <li><a href='consulta/listaProcessos.php'>Processos</a></li>
                <li><a href='consulta/listaProduto.php'>Produtos</a></li>
                <li><a href='consulta/listaSeguranca.php'>Seguranças</a></li>
                <li><a href='consulta/listaSetor.php'>Setores</a></li>
                <li><a href='consulta/listaStatus.php'>Status</a></li>
                <li><a href='consulta/listaUsuario.php'>Usuários</a></li>
            </ul>

            <!-- MENU RELATORIOS -->

            <ul id="relatorio-menu" class="dropdown-content">
                <li><a href='#'>Opcao 1</a></li>
                <li><a href='#'>Opcao 2</a></li>
                <li><a href='#'>Opcao 3</a></li>
            </ul>

            <!-- MENU PEDIDOS -->
            <ul id="pedido-menu" class="dropdown-content">
                <li><a href='cadastro/cadastroPedido.php'>Incluir Novo</a></li>
                <li><a href='consulta/listaPedido.php'>Lista</a></li>
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

        <div id="conteudo">

            <div id='dale123'>

                <div class="container">

                    <div class="section">



                        <!--   Icon Section   -->

                        <div class="row">

                            <div class="col s12 m4">

                                <div class="card">

                                    <div class="card-image waves-effect waves-block waves-light">

                                        <img class="activator" src="../img/solda4.png">

                                    </div>

                                    <div class="card-content">

                                        <span class="card-title activator grey-text text-darken-4">Grupo de peças<i
                                                class="material-icons right">more_vert</i></span>

                                    </div>

                                    <div class="card-reveal">

                                        <span class="card-title grey-text text-darken-4">Quem somos?<i
                                                class="material-icons right">close</i></span>

                                        <p>

                                            O Grupo de peças é uma área de caldeiraria pertencente a Gerência de
                                            Manutenção de Vagões Centro Leste responsável pela confecção, corte,
                                            manutenção, elaboração e reparos com soldas em instrumentos metálicos.
                                            Produzem peças destinadas a manutenção de Vagões e confecção de projetos
                                            conforme a necessidade de cada cliente.

                                        </p>

                                    </div>

                                </div>

                            </div>



                            <div class="col s12 m4">

                                <div class="card">

                                    <div class="card-image waves-effect waves-block waves-light">

                                        <img class="activator" src="../img/vagoes2.png">

                                    </div>

                                    <div class="card-content">

                                        <span class="card-title activator grey-text text-darken-4">Vagões<i
                                                class="material-icons right">more_vert</i></span>

                                    </div>

                                    <div class="card-reveal">

                                        <span class="card-title grey-text text-darken-4">Vagões CL<i
                                                class="material-icons right">close</i></span>

                                        <p>

                                            A Gerência de Manutenção de Vagões é uma área responsável pelas manutenções
                                            preventivas e corretivas em vagões tanque, graneleiros, gôndolas e
                                            plataformas. A Gerência é composta por 114 funcionários própios que estão
                                            distribuídos entre as localidades de Divinópolis, Araguari, Pedro Leopoldo,
                                            Imbiruçu e Garças.

                                        </p>

                                    </div>

                                </div>

                            </div>

                            <div class="col s12 m4">

                                <div class="card">

                                    <div class="card-image waves-effect waves-block waves-light">

                                        <img class="activator" src="../img/vli.png">

                                    </div>

                                    <div class="card-content">

                                        <span class="card-title activator grey-text text-darken-4">A VLI<i
                                                class="material-icons right">more_vert</i></span>

                                    </div>

                                    <div class="card-reveal">

                                        <span class="card-title grey-text text-darken-4">VLI<i
                                                class="material-icons right">close</i></span>

                                        <p>

                                            A VLI é uma empresa que oferece soluções logísticas que integram portos,

                                            ferrovias e terminais,

                                            com capacidade para atender com cada vez mais eficiência.

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>



                    </div>

                    <br><br>

                </div>

            </div>

        </div>

    </main>











    <!--JavaScript at end of body for optimized loading-->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>

    <script type='text/javascript'>
    $('.dropdown-trigger').dropdown({

        container: document.body

    });



    $(document).ready(function() {

    })
    </script>
</body>

</html>

<?php } ?>