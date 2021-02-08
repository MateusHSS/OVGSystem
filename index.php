<html>

<head>
    <title>OVGSYSTEM</title>
    <link rel="shortcut icon" href="img/vli.ico" type="image/x-icon" />
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
    <link rel="stylesheet" href="css/index.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<body class='valign-wrapper'>
    <div class="container center">
        <h4 class='white-text' id='login-text'>Login de acesso</h4>
        <div class="row center">
            <div class="col m4 offset-m4 card grey-ligthen-4" id='login'>
                <form class="col m12" action="" id="form_login" method='POST'>
                    <div class="row">
                        <div class="input-field col m12">
                            <input id="user" type="text" class="validate" name='user'>
                            <label for="user">Usuário</label>
                        </div>
                        <div class="input-field col m12">
                            <input id="pass" type="password" class="validate" name='pass'>
                            <label for="pass">Senha</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light" type="submit" name="action">Entrar
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
        integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"
        integrity="sha512-6Uv+497AWTmj/6V14BsQioPrm3kgwmK9HYIyWP+vClykX52b0zrDGP7lajZoIY1nNlX4oQuh7zsGjmF7D0VZYA=="
        crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
</body>

</html>