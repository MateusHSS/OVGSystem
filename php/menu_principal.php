<html>

<head>
    <title>OVGSYSTEM</title>
    <link rel="shortcut icon" href="img/vli.ico" type="image/x-icon" />
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="../css/home.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
    header,
    main,
    footer {
        padding-left: 300px;
    }
    </style>
</head>

<body class="has-fixed-sidenav">
    <header>
        <div class="navbar-fixed">
            <nav class="navbar">
                <div class="nav-wrapper">
                    <div class="container">
                        <a href="#" class="brand-logo" id='logo'>OVG SYSTEM</a>
                        <div class="container">
                            <ul id="nav-mobile" class="right">
                                <li class="hide-on-med-and-down"><a href="../">Sair</a></li>
                                <li><img src="../img/logo-teste.png" id='nav-logo'></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <ul class="sidenav sidenav-fixed" style="transform: translateX(0%);">
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a href="home.php" class="collapsible-header white-text">Grupo de peças<i
                                class="material-icons chevron right white-text">chevron_right</i></a>
                    </li>
                    <li id="dados_ver">
                        <a class="collapsible-header white-text">Dados<i
                                class="material-icons chevron right white-text">chevron_right</i></a>
                    </li>
                </ul>
            </li>
        </ul>

    </header>
    <main class='center-align' style="height: 90vh; width: 100%;">
        <div class="center" id="dados">
            <!-- <div class="col l12">
                <div class="row">
                    <div class="col l6 left-align">
                        <p> <i class="material-icons small left">assessment</i>EBJ</p>
                    </div>
                    <div class="col l6 left-align">
                        <p> <i class="material-icons small left">assignment</i>EYU</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 left-align">
                        <p> <i class="material-icons small left">description</i>EDV DF</p>
                    </div>
                    <div class="col l6 left-align">
                        <p> <i class="material-icons small left">source</i>THP</p>
                    </div>
                </div>
                <div class="row ">
                    <div class="col l6 left-align">
                        <p> <i class="material-icons small left">sms_failed</i>Falhas</p>
                    </div>
                    <div class="col l6 left-align">
                        <p> <i class="material-icons small left">security</i>Segurança e saúde</p>
                    </div>
                </div>
                <div class="row ">
                    <div class="col l6 left-align">
                        <p> <i class="material-icons small left">admin_panel_settings</i>Painel de indicadores</p>
                    </div>
                    <div class="col l6 left-align">
                        <p> <i class="material-icons small left">account_tree</i>Árvore THP</p>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col l2 offset-l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title"><i class="material-icons small">assessment</i></span>
                            <p>EBJ</p>
                        </div>
                    </div>
                </div>
                <div class="col l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title"><i class="material-icons small">assignment</i></span>
                            <p>EYU</p>
                        </div>
                    </div>
                </div>
                <div class="col l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title"><i class="material-icons small">description</i></span>
                            <p>EDV DF</p>
                        </div>
                    </div>
                </div>
                <div class="col l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title"><i class="material-icons small">source</i></span>
                            <p>THP</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col l2 offset-l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title"><i class="material-icons small">sms_failed</i></span>
                            <p>Falhas</p>
                        </div>
                    </div>
                </div>
                <div class="col l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title"><i class="material-icons small">security</i></span>
                            <p>Segurança e saúde</p>
                        </div>
                    </div>
                </div>
                <div class="col l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title"><i class="material-icons small">admin_panel_settings</i></span>
                            <p>Painel de indicadores</p>
                        </div>
                    </div>
                </div>
                <div class="col l2">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title"><i class="material-icons small">account_tree</i></span>
                            <p>Árvore THP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#ovg").hide();
        $("#dados").hide();

        $("#ovg_ver").click(function() {
            $("#dados").hide();
            $("#ovg").show();
        });
        $("#dados_ver").click(function() {
            $("#ovg").hide();
            $("#dados").show();
        })
    })
    </script>
</body>

</html>