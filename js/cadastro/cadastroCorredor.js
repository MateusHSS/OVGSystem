$('.dropdown-trigger').dropdown({
    container: document.body
});

$(document).ready(function(){
    $("#form_cadastro_corredor").validate({
        rules: {
            nome_corredor: {
                required: true
            }
        },
        messages: {
            nome_corredor: {
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

    //INSERCAO DOS DADOS DO CORREDOR
    $('#form_cadastro_corredor').submit(function (e) {
        if($(this).validate().errorList.length == 0){
            e.preventDefault();

            var formCorredor = new FormData(this);
    
            // // Display the key/value pairs
            // for (var pair of formCorredor.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
    
            $.ajax({
                url: "../controller/insert/insereCorredor.php",
                type: "POST",
                data: formCorredor,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = $.parseJSON(data);
                    console.log(data);
                    if (data.cod == '1') {
                        M.toast({
                            html: 'Corredor cadastrado',
                            classes: 'green'
                        });
                        $("#form_cadastro_corredor").each(function(){
                            this.reset();
                        });
                    } else {
                        M.toast({
                            html: 'Erro ao cadastrar corredor!',
                            classes: 'red'
                        });
                    }
                }
            });
        }
        
    });
});