$('.dropdown-trigger').dropdown({
    container: document.body
});

$(document).ready(function() {
    $("#tempo_processo").mask('00:00:00');

    $.validator.setDefaults({
        ignore: []
    });

    $("#form_cadastro_processo").validate({
        rules: {
            descricao_processo: {
                required: true
            },
            tempo_processo: {
                required: true
            }
        },
        messages: {
            descricao_processo: {
                required: "Campo obrigatório"
            },
            tempo_processo: {
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

    //INSERCAO DOS DADOS DO PROCESSO
    $('#form_cadastro_processo').submit(function (e) {
        if($(this).validate().errorList.length == 0){
            e.preventDefault();

            var formProcesso = new FormData(this);
    
            // // Display the key/value pairs
            // for (var pair of formProcesso.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
    
            $.ajax({
                url: "../controller/insert/insereProcesso.php",
                type: "POST",
                data: formProcesso,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = $.parseJSON(data);
                    
                    if (data.cod == '1') {
                        M.toast({
                            html: 'Processo cadastrado',
                            classes: 'green'
                        });
                        $("#form_cadastro_processo").each(function(){
                            this.reset();
                        });
                    } else {
                        M.toast({
                            html: 'Erro ao cadastrar processo!',
                            classes: 'red'
                        });
                    }
                }
            });
        }
    });
})