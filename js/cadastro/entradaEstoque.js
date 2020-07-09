$(document).ready(function(){

    $("#material").keyup(function(){
        $(this).removeAttr("data-sap");
    });

    //SELECIONA OS NOMES QUE APARECERAO NA BUSCA DE MATERIAIS
    $.ajax({

        url: '../controller/select/nomeMateriais.php',
        type: 'POST',
        dataType: 'html',
        success: function (ret) {
            var retorno = $.parseJSON(ret);

            var acArray = [];
            var acData = {};
            retorno.nomes.forEach(res => {
                acArray.push(res)
            })
            acArray.forEach(acObj => {
                acData[acObj] = null;
            })

            $('input.autocomplete#material').autocomplete({
                data: acData,
                limit: 10,
                onAutocomplete: function(){
                    var nome = $("#material").val();
                    var posicao = retorno.nomes.indexOf(nome);
                    var sap = retorno.saps[posicao];
                    var peso = retorno.pesos[posicao];
                    $("#material").attr("data-sap", sap);
                    $("#qtd").attr("peso", peso);
                    $("#peso_total").text(peso + "Kg");
                    $("#material").select();
                    $("#material").blur();
                }
            });
        }
    });

    $("#qtd").keyup(function(){
        var peso = $(this).attr("peso");
        var qtd = $(this).val();
        var total = parseFloat((peso*qtd).toFixed(2));

        $("#peso_total").text(total + "Kg");
        $(this).val($(this).val().replace(',', '.'));
    })

    $("#form_entrada_estoque").validate({
        rules: {
            material: {
                required: true,
                material: true
            },
            qtd: {
                required: true,
                number: true
            }
        },
        messages: {
            material: {
                required: "Campo obrigatório"
            },
            qtd: {
                required: "Campo obrigatório",
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

    $.validator.addMethod("material", function(value, element) {
        if($(element).attr("data-sap") == undefined){
            return false
        }else{
            return true
        }
    },"Selecione um material da lista");

    $("#form_entrada_estoque").submit(function(e){
        e.preventDefault();

        if($(this).validate().errorList.length == 0){
    
            var formMaterial = new FormData(this);

            if($("#qtd").attr("peso") != undefined){
                var peso = parseFloat(parseFloat($("#qtd").attr("peso")) * parseFloat($("#qtd").val())).toFixed(2);
            }else{
                var peso = 0;
            }

            

            formMaterial.append("sap", $("#material").attr("data-sap"));
            formMaterial.append("peso", peso);
    
            // Display the key/value pairs
            for (var pair of formMaterial.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }
    
            $.ajax({
                url: "../controller/insert/entradaEstoque.php",
                type: "POST",
                data: formMaterial,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = $.parseJSON(data);
                    if (data.cod == '1') {
                        M.toast({
                            html: 'Estoque atualizado',
                            classes: 'green'
                        });
                        $("#form_entrada_estoque").each(function(){
                            this.reset();
                        });
                    } else {
                        M.toast({
                            html: 'Erro ao atualizar estoque!',
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
    })
})