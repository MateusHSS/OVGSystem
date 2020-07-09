$('.dropdown-trigger').dropdown({
    container: document.body
});

$(document).ready(function() {
    $('select').formSelect();

    $('#matricula_funcionario').mask('00000000');

    $.validator.setDefaults({
        ignore: []
    });

    $("#form_cadastro_funcionario").validate({
        rules: {
            nome_funcionario: {
                required: true
            },
            matricula_funcionario: {
                required: true
            },
            empresa_funcionario: {
                required: true
            },
            turno_funcionario: {
                required: true
            }
        },
        messages: {
            nome_funcionario: {
                required: "Campo obrigatório"
            },
            matricula_funcionario: {
                required: "Campo obrigatório"
            },
            empresa_funcionario: {
                required: "Campo obrigatório"
            },
            turno_funcionario: {
                required: "Selecione um turno"
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

    //INSERCAO DOS DADOS DO FUNCIONARIO
    $('#form_cadastro_funcionario').submit(function (e) {
        if($(this).validate().errorList.length == 0){
            e.preventDefault();

            var formFuncionario = new FormData(this);
    
            // // Display the key/value pairs
            // for (var pair of formFuncionario.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
    
            $.ajax({
                url: "../controller/insert/insereFuncionario.php",
                type: "POST",
                data: formFuncionario,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = $.parseJSON(data);
                    console.log(data);
                    if (data.cod == '1') {
                        M.toast({
                            html: 'Funcionário cadastrado',
                            classes: 'green'
                        });
                        $("#form_cadastro_funcionario").each(function(){
                            this.reset();
                        });
                    } else {
                        M.toast({
                            html: 'Erro ao cadastrar funcionário!',
                            classes: 'red'
                        });
                    }
                }
            });
        }
        
    });
})