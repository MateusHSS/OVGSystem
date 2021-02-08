$('.dropdown-trigger').dropdown({
    container: document.body
});

$(document).ready(function() {
    $(".modal").modal();

    $(".confirma").click(function(){

        $.ajax({
            url: "../controller/select/dadosPedido.php",
            type: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function(data) {
                var retorno = $.parseJSON(data);
                $("#confirma_entrega").attr("data-id", retorno.idpedido);
                $("#id_entrega").text(retorno.idpedido);
                $("#nome_cliente_entrega").text(retorno.nomecliente);
                $("#nome_produto_entrega").text(retorno.nomeproduto);
                $("#qtd_produto_entrega").text(retorno.quantidadepedido);
                $("#dimensao_entrega").text(retorno.altura+'X'+retorno.largura+'X'+retorno.espessura);
                $("#atividade_entrega").text(retorno.nomeatividade);
                $("#seguranca_entrega").text(retorno.nomeseguranca);
            }
        });
    });

    $("#confirma_entrega").click(function(e){
        
        $.post( "../controller/update/entregaPedido.php", {'id' : $(this).attr("data-id")})
            .done(function(data) {
                data = $.parseJSON(data);
                
                if(data.cod == '1'){
                    M.toast({
                        html: "Pedido entregue!",
                        classes: "green"
                    });
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }else{
                    M.toast({
                        html: "Erro ao atualizar pedido",
                        classes: "red"
                    });
                }
        }, "json");

        e.preventDefault();
    });

    $(".carregar_mais").click(function() {
        var inicio = $("tbody tr").length - 1;

        $.ajax({

            url: '../controller/select/carregaMaisPedidos.php',
            type: 'POST',
            dataType: 'html',
            data: {'inicio': inicio},
            success: function(data) {
                $(".carregar_mais").remove();
                $('#lista_pedidos').append(data);
            }
        });

        return false;
    });
});