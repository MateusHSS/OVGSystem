$(document).ready(function(){
    $("#form_login").validate({
        rules: {
            user: {
                required: true
            },
            pass: {
                required: true
            }
        },
        messages: {
            user: {
                required: "Campo obrigatório"
            },
            pass: {
                required: "Campo obrigatório"
            }
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.css({'color' : 'red', 'float' : 'left', 'font-size' : '80%'});
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        }
    });

    //LOGIN
    $('#form_login').submit(function (e) {
        if($(this).validate().errorList.length == 0){
            e.preventDefault();

            var formLogin = new FormData(this);
    
            // // Display the key/value pairs
            // for (var pair of formMaterial.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
    
            $.ajax({
                url: "php/controller/login.php",
                type: "POST",
                data: formLogin,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = $.parseJSON(data);
                    
                    if (data.cod == 1) {
                        if(data.pAcesso == 1){
                            window.location.href ="php/controller/pAcesso.php";
                        }else{
                            if(data.adm == 1){
                                window.location.href ="php/menu_principal.php";
                            }else{
                                window.location.href ="php/home.php";
                            }
                        }
                    } else {
                        M.toast({
                            html: 'Usuário ou senha incorretos',
                            classes: 'red'
                        });
                    }
                }
            });
        }
        
    });
})