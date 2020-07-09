$('.dropdown-trigger').dropdown({
    container: document.body
});
$(document).ready(function () {
    $.validator.setDefaults({
        ignore: []
    });

    $("#telefone_cliente").mask("(99)99999-9999");

    $("#dimensao_pedido").mask('9999999999X9999999999X9999999999', {
        translation: {
            'X': {
                pattern: /[x, X]/
            }
        }
    });

    $('input#input_text, textarea#obs_pedido').characterCounter();

    $('select').formSelect();

    $(".modal").modal();

    $("#cliente_pedido").keyup(function(){
        $(this).removeAttr("data-idcliente");
    });

    $("#produto_pedido").keyup(function(){
        $(this).removeAttr("data-idproduto");
    });

    //SELECIONA OS NOMES QUE APARECERAO NA BUSCA DE CLIENTES
    $.ajax({

        url: '../controller/select/nomeClientes.php',
        type: 'POST',
        dataType: 'html',
        success: function (ret) {
            var retorno = $.parseJSON(ret);

            var acArray = [];
            var acData = {};

            // A CADA NOME, ADICIONA NO acArray
            retorno.nomes.forEach(res => {
                acArray.push(res)
            })
            acArray.forEach(acObj => {
                acData[acObj] = null;
            })

            $('input.autocomplete#cliente_pedido').autocomplete({
                data: acData,
                limit: 5,
                onAutocomplete: function(val){
                    var posicao = retorno.nomes.indexOf(val);          //SELECIONA A POSICAO DESSE NOME NO ARRAY
                    var id = retorno.ids[posicao];                      //SELECIONA O ID DO NOME, DE ACORDO COM A POSICAO
                    $("#cliente_pedido").attr("data-idcliente", id);
                }
            });
        }
    });

    //SELECIONA OS NOMES QUE APARECERAO NA BUSCA DE PRODUTOS
    $.ajax({

        url: '../controller/select/nomeProdutos.php',
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

            $('input.autocomplete#produto_pedido').autocomplete({
                data: acData,
                limit: 5,
                onAutocomplete: function(){
                    var nome = $("#produto_pedido").val();
                    var posicao = retorno.nomes.indexOf(nome);
                    var id = retorno.ids[posicao];
                    $("#produto_pedido").attr("data-idproduto", id);
                    $("#produto_pedido").select();
                    $("#produto_pedido").blur();
                }
            });
        }
    });

    //VALIDACAO DO FORMULARIO DE PEDIDO
    $("#form_pedido").validate({
        rules: {
            cliente_pedido: {
                required: true
            },
            produto_pedido: {
                required: true,
                produto: true,
                remote: {
                    url: "../controller/select/disponibilidadeMateriais.php",
                    type: 'POST',
                    data: {
                        id: function(){
                            return $("#produto_pedido").attr("data-idproduto");
                        }
                    }
                }
            },
            qtd_pedido: {
                required: true,
                number: true,
                remote: {
                    url: "../controller/select/disponibilidadeMateriais.php",
                    type: 'POST',
                    data: {
                        id: function(){
                            return $("#produto_pedido").attr("data-idproduto");
                        },
                        qtd: function(){
                            return $("#qtd_pedido").val();
                        }
                    }
                }
            },
            dimensao_pedido: {
                required: true
            },
            atividade_pedido: {
                required: true
            },
            seguranca_pedido: {
                required: true
            }
        },
        //For custom messages
        messages: {
            cliente_pedido: "Campo obrigatório",
            produto_pedido: {
                required: "Campo obrigatório",
                remote: "Materiais do produto não disponíveis"
            },
            qtd_pedido: {
                required: "Campo obrigatório",
                number: "Este campo precisa ser numérico",
                remote: "Materiais disponíveis insuficientes"
            },
            dimensao_pedido: "Campo obrigatório",
            atividade_pedido: "Campo obrigatório",
            seguranca_pedido: "Campo obrigatório"
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

    $.validator.addMethod("produto", function(value, element) {
        if($(element).attr("data-idproduto") == undefined){
            return false
        }else{
            return true
        }
    },"Selecione um produto da lista");

    $.validator.addMethod("disponibilidade_materiais", function(value, element) {
        function verifica(el){
            var aux;
            $.ajax({

                url: '../controller/select/disponibilidadeMateriais.php',
                type: 'POST',
                data: {'id': $(el).attr("data-idproduto")},
                dataType: 'html',
                success: function (ret) {
                    var retorno = $.parseJSON(ret);
                    if(retorno.cod == 1){
                        aux = retorno.cod
                    }else{
                        aux = retorno.cod
                    }
                }
            })

            return aux
        }
        console.log(verifica(element))
    },"Materiais nao disponiveis na regiao");
      

    //INSERCAO DOS DADOS DO PEDIDO
    $('#form_pedido').submit(function (e) {
        if($(this).validate().errorList.length == 0){
            e.preventDefault();

            var idcliente = $('#cliente_pedido').attr('data-idcliente');
    
            if($("#cliente_pedido").val() != "" && idcliente == undefined){
                $("#cadastro_cliente").modal("open");
                $("#nome_cliente").select();
                $("#nome_cliente").val($("#cliente_pedido").val());
                $("#telefone_cliente").select();
            }else{
                var idproduto = $('#produto_pedido').attr('data-idproduto');
    
                var formData = new FormData(this);
                formData.append('cliente', idcliente);
                formData.append('produto', idproduto);
        
                // // Display the key/value pairs
                // for (var pair of formData.entries()) {
                //     console.log(pair[0] + ', ' + pair[1]);
                // }
        
                $.ajax({
                    url: "../controller/insert/inserePedido.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        var data = $.parseJSON(data);
                        if (data.cod == '1') {
                            M.toast({
                                html: 'Pedido cadastrado',
                                classes: 'green'
                            });
                            $("#form_pedido").each(function(){
                                this.reset();
                            });
                        } else {
                            M.toast({
                                html: 'Erro ao cadastrar pedido!',
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
        }
        
    });

    // VALIDACAO DO FORMULARIO DE CADASTRO DE CLIENTE
    $("#form_cadastro_cliente").validate({
        rules: {
            nome_cliente: {
                required: true
            },
            telefone_cliente: {
                required: true
            },
            setor_cliente: {
                required: true,
                number: true
            },
            corredor_cliente: {
                required: true
            }
        },
        //For custom messages
        messages: {
            nome_cliente: "Campo obrigatório",
            telefone_cliente: "Campo obrigatório",
            setor_cliente: "Campo obrigatório",
            corredor_cliente: "Campo obrigatório"
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
                        $('#cliente_pedido').attr('data-idcliente', data.id);
                        $("#cadastro_cliente").modal("close");
                        $("#form_pedido").trigger('submit');
                    } else {
                        M.toast({
                            html: 'Erro ao cadastrar!',
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



