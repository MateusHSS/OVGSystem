<html>

<head>
    <title>OVGSYSTEM</title>
    <link rel="shortcut icon" href="img/vli.ico" type="image/x-icon" />
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="css/index.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body class='valign-wrapper'>
    <div class="container center">
        <h4 id='login-text'>Nova senha pessoal</h4>
        <div class="row center">
            <div class="col m4 offset-m4 card grey-ligthen-4" id='login'>
                <form class="col m12" action="update/setSenha.php" method='POST' id="nova_senha">
                    <div class="row">
                        <div class="input-field col m12">
                            <input id="senha" type="password" class="validate" name='senha'>
                            <label for="senha">Nova senha</label>
                        </div>
                        <div class="input-field col m12">
                            <input id="confirma_senha" type="password" class="validate" name='confirma_senha'>
                            <label for="confirma_senha">Confirma senha</label>
                            <span class="helper-text" data-error='As senhas não coincidem'></span>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light" type="submit" name="action">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
    <script>
    $(document).ready(function() {
        $("#nova_senha").validate({
            rules: {
                senha: {
                    required: true
                },
                confirma_senha: {
                    required: true,
                    equalTo: "#senha"
                }
            },
            //For custom messages
            messages: {
                senha: {
                    required: "Informe uma nova senha"
                },
                confirma_senha: {
                    required: "Confirme sua senha",
                    equalTo: "As senhas precisam ser iguais"
                }
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
    </script>
</body>

</html>