$(document).ready(function() {
    $('.tempo').mask('00:00:00');

    $(".modal").modal();

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
                $("#atividade option:contains('" + retorno.nomeatividade + "')").attr(
                    'selected', true);
                $("#seguranca").val(retorno.seguranca);
                $("#enviar").attr("data-idpedido", retorno.idpedido);
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
                $("#seguranca").text(retorno.nomeseguranca);
                if (retorno.formulariopedido != null) {
                    $("#form_detalhes").html("<a href='../formulariosPedidos/" + retorno
                        .formulariopedido + "'>Acessar</a></p>");
                } else {
                    $("#form_detalhes").text("Não anexado");
                }
            }
        });
    });

    $("#enviar").click(function() {
        event.preventDefault();
        var form = document.getElementById('form_edita');
        var id = this.getAttribute("data-idpedido");
        var dados = new FormData(form);
        dados.append('id', id);

        // // Exibição dos valores chave/valor
        // for (var pair of dados.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }

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