$('.dropdown-trigger').dropdown({
    container: document.body
});

$(document).ready(function() {
    $('select').formSelect();
    $('#telefone_cliente').focus(function() {
        $('#telefone_cliente').mask('(00)00000-0000');
        $('#telefone_cliente').blur(function(event) {
            if ($(this).val().length ==
                14) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                $('#telefone_cliente').mask('(00)00000-0000');
            } else {
                $('#telefone_cliente').mask('(00)0000-0000');
            }
        });
    });

    $.validator.setDefaults({
        ignore: []
    });

    $("#form_cadastro_cliente").validate({
        rules: {
            nome_cliente: {
                required: true
            },
            telefone_cliente: {
                required: true
            },
            setor_cliente: {
                required: true
            },
            corredor_cliente: {
                required: true
            }
        },
        messages: {
            nome_cliente: {
                required: "Campo obrigatório"
            },
            telefone_cliente: {
                required: "Campo obrigatório"
            },
            setor_cliente: {
                required: "Selecione um setor"
            },
            corredor_cliente: {
                required: "Selecione um corredor"
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

    //INSERCAO DOS DADOS DO CLIENTE
    $('#form_cadastro_cliente').submit(function (e) {
        if($(this).validate().errorList.length == 0){
            e.preventDefault();

            var formCliente = new FormData(this);
    
            // // Display the key/value pairs
            // for (var pair of formCliente.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
    
            $.ajax({
                url: "../controller/insert/insereCliente.php",
                type: "POST",
                data: formCliente,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = $.parseJSON(data);
                    
                    if (data.cod == '1') {
                        M.toast({
                            html: 'Cliente cadastrado',
                            classes: 'green'
                        });
                        $("#form_cadastro_cliente").each(function(){
                            this.reset();
                        });
                    } else {
                        M.toast({
                            html: 'Erro ao cadastrar cliente!',
                            classes: 'red'
                        });
                    }
                }
            });
        }
        
    });
})