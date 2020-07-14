$('.dropdown-trigger').dropdown({
    container: document.body
});

$('.dropdown-trigger.btn-flat').dropdown({
    constrainWidth: false
});

$(document).ready(function() {
    $('.tempo').mask('00:00:00');

    $(".modal").modal();

    $(".exclui").click(function(){

        $.ajax({
            url: "../controller/select/dadosPedido.php",
            type: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function(data) {
                var retorno = $.parseJSON(data);
                $("#confirma_exclui_button").attr("data-id", retorno.idpedido);
                $("#id_exclui").text(retorno.idpedido);
                $("#nome_cliente_exclui").text(retorno.nomecliente);
                $("#nome_produto_exclui").text(retorno.nomeproduto);
                $("#qtd_produto_exclui").text(retorno.quantidadepedido);
                $("#dimensao_exclui").text(retorno.dimensaopedido);
                $("#atividade_exclui").text(retorno.nomeatividade);
                $("#seguranca_exclui").text(retorno.nomeseguranca);
                if (retorno.formulariopedido != null) {
                    $("#form_exclui").html("<p><a href='../formulariosPedidos/" + retorno.formulariopedido + "' target='_blank'>Acessar</a></p>");
                } else {
                   $("#form_exclui").text("Não anexado");
                }
            }
        });
    });

    $("#confirma_exclui_button").click(function(e){
        
        $.post( "../controller/delete/excluiPedido.php", {'id' : $(this).attr("data-id")})
            .done(function(data) {
                data = $.parseJSON(data);
                
                if(data.cod == '1'){
                    M.toast({
                        html: "Pedido excluído!",
                        classes: "green"
                    });
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }else{
                    M.toast({
                        html: "Erro ao excluir pedido",
                        classes: "red"
                    });
                }
        }, "json");

        e.preventDefault();
    });

    $(".atualiza").click(function() {
        $.ajax({
            url: "../controller/select/dadosPedido.php",
            type: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function(data) {
                var retorno = $.parseJSON(data);
                $("#nome_cliente").text(retorno.nomecliente);
                $("#nome_produto").text(retorno.nomeproduto);
                $("#qtd").select();
                $("#qtd").val(retorno.quantidadepedido);
                $("#dimensao").select();
                $("#dimensao").val(retorno.dimensaopedido);
                $("#dimensao").blur();
                $("#atividade").val(retorno.atividade);
                $("select").formSelect();
                $("#seguranca").val(retorno.seguranca);
                $("select").formSelect();
                $("#form_edita").attr("data-idpedido", retorno.idpedido);
                if (retorno.formulariopedido != null) {
                    $("#formPed").hide();
                    $("#formPedText").show();
                    $("#formPedText").html(
                        "<p>Formulario: <a href='../formulariosPedidos/" + retorno
                        .formulariopedido + "'>Acessar</a></p>");
                } else {
                    $("#formPedText").hide();
                    $("#formPed").show();
                }
            }
        });
    });

    $(".detalhes").click(function() {
        $.ajax({
            url: "../controller/select/dadosPedido.php",
            type: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function(data) {
                var retorno = $.parseJSON(data);
                $("#nome_cliente_detalhes").text(retorno.nomecliente);
                $("#nome_produto_detalhes").text(retorno.nomeproduto);
                $("#qtd_detalhes").text(retorno.quantidadepedido);
                $("#dimensao_detalhes").text(retorno.dimensaopedido);
                $("#atividade_detalhes").text(retorno.nomeatividade);
                $("#seguranca_detalhes").text(retorno.nomeseguranca);
                if (retorno.formulariopedido != null) {
                    $("#form_detalhes").html("<a target='_blank' href='../formulariosPedidos/" + retorno
                        .formulariopedido + "'>Acessar</a></p>");
                } else {
                    $("#form_detalhes").text("Não anexado");
                }
            }
        });
    });

    $("#form_edita").submit(function() {
        event.preventDefault();
        var id = this.getAttribute("data-idpedido");
        var dados = new FormData(this);
        dados.append('id', id);

        // Exibição dos valores chave/valor
        for (var pair of dados.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        $.ajax({
            url: "../controller/update/atualizaPedido.php",
            type: "POST",
            data: dados,
            processData: false,
            contentType: false,
            success: function(data) {
                var retorno = $.parseJSON(data);
                if (retorno.cod == '1') {
                    M.toast({
                        html: 'Pedido atualizado!',
                        classes: 'green'
                    });
                    location.reload();
                } else {
                    M.toast({
                        html: 'Erro ao atualizar!',
                        classes: 'red'
                    });
                }
            }
        });
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