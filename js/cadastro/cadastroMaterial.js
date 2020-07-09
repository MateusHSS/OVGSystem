$('.dropdown-trigger').dropdown({
    container: document.body
});

$(document).ready(function(){

    $.validator.setDefaults({
        ignore: []
    });

    $("#form_cadastro_material").validate({
        rules: {
            sap: {
                required: true,
                remote: {
                    url: "../controller/select/verificaSAP.php",
                    type: 'POST',
                    data: {
                        sap: function(){
                            return $("#sap_material").val();
                        }
                    }
                },
                number: true
            },
            nome_material: {
                required: true
            },
            peso_material: {
                required: true,
                number: true
            }

        },
        messages: {
            sap: {
                required: "Campo obrigatório",
                remote: "Código SAP ja consta no banco",
                number: "Este campo precisa ser numérico"
            },
            nome_material: {
                required: "Campo obrigatório"
            },
            peso_material: {
                required: "Campo obrigatório (ou preencha com '0')",
                number: "Este campo precisa ser numérico"
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

    //INSERCAO DOS DADOS DO MATERIAL
    $('#form_cadastro_material').submit(function (e) {
        if($(this).validate().errorList.length == 0){
            e.preventDefault();

            var formMaterial = new FormData(this);
    
            // // Display the key/value pairs
            // for (var pair of formMaterial.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }
    
            $.ajax({
                url: "../controller/insert/insereMaterial.php",
                type: "POST",
                data: formMaterial,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = $.parseJSON(data);
                    
                    if (data.cod == '1') {
                        M.toast({
                            html: 'Material cadastrado',
                            classes: 'green'
                        });
                        $("#form_cadastro_material").each(function(){
                            this.reset();
                        });
                    } else {
                        M.toast({
                            html: 'Erro ao cadastrar material!',
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