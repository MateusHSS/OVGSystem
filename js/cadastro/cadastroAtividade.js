$('.dropdown-trigger').dropdown({
    container: document.body
});
$(document).ready(function() {
    $("#form_cadastro_atividade").validate({
        rules: {
            descricao_atividade: {
                required: true
            },
            peso_atividade: {
                required: true
            }
        },
        messages: {
            descricao_atividade: {
                required: "Adicione uma descrição à atividade"
            },
            peso_atividade: {
                required: "Adicione um peso à atividade"
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

    //INSERCAO DOS DADOS DA ATIVIDADE
    $('#form_cadastro_atividade').submit(function (e) {
        if($(this).validate().errorList.length == 0){
            e.preventDefault();

            var formAtividade = new FormData(this);
    
            // // Display the key/value pairs
            // for (var pair of formCliente.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
    
            $.ajax({
                url: "../controller/insert/insereAtividade.php",
                type: "POST",
                data: formAtividade,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = $.parseJSON(data);
                    console.log(data);
                    if (data.cod == '1') {
                        M.toast({
                            html: 'Atividade cadastrada',
                            classes: 'green'
                        });
                        $("#form_cadastro_atividade").each(function(){
                            this.reset();
                        });
                    } else {
                        M.toast({
                            html: 'Erro ao cadastrar atividade!',
                            classes: 'red'
                        });
                        M.toast({
                            html: 'Erro: '+ data.erro,
                            classes: 'red'
                        });
                    }
                }
            });
        }
        
    });

    
})