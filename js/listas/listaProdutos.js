$('.dropdown-trigger').dropdown({
    container: document.body
});

$('.dropdown-trigger.btn-flat').dropdown({
    constrainWidth: false
});

$(document).ready(function() {
    $('.tempo').mask('00:00:00');

    $("select").formSelect();

    $(".modal").modal();

    $("#filtro_nome_form").submit(function(e){
        e.preventDefault();

        $.ajax({
            url: "../controller/select/filtros/produtos.php",
            type: "POST",
            data: {
                filtro_nome: function(){
                    return $("#filtro_nome").val()
                }
            },
            success: function(data) {
                // console.log(data)
                var response = $.parseJSON(data);
                var html = '';
                for(item in response) {
                    html += "<tr>"
                    html += "<td>"+response[item].idproduto+"</td>"
                    html += "<td>"+response[item].nomeproduto+"</td>"
                    html += "<td>"+response[item].datacadastro+"</td>"
                    html += "<td class='edita'><a href='#edita"+response[item].idproduto+"' class='modal-trigger orange-text text-darken-3'><i class='material-icons'>create</i></a></td>"
                    html += "</tr>"
                    html += "<div class='modal fade' id='edita"+response[item].idproduto+"'>"
                    html += "<div class='modal-content'>"
                    html += "<div class='row right'><i class='material-icons modal-close'>close</i></div>"
                    html += "<h4>Editar informações</h4>"
                    html += "<div class='divider'></div>"
                    html += "<form method='post' action='../controller/update/editaProduto.php?id="+response[item].idproduto+"' id='form-edita"+response[item].idproduto+"'>"
                    html += "<div class='row'>"
                    html += "<div class='input-field col l12'>"
                    html += "<input id='nome-produto"+response[item].idproduto+"' type='text' class='validate' name='nome-produto' value='"+response[item].idproduto+"' onkeyup='this.value = this.value.toUpperCase();'>"
                    html += "<label for='nome-produto"+response[item].idproduto+"'>Nome do produto</label>"
                    html += "</div>"
                    html += "</div>"
                    html += "<div class='row center'>"
                    html += "<div class='btn light-blue darken-3 botao' type='submit' name='action' id='"+response[item].idproduto+"'>Atualizar<i class='material-icons right'>check</i></div>"
                    html += "</div>"
                    html += "</form>"
                    html += "</div>"
                    html += "</div>"
                    
                    
                }
                $("#prod_list_body").html()
                $("#prod_list_body").html(html)

                $('.edita').hide();
            }
        });
    })

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
                $("#dimensao_exclui").text(retorno.largura + "X" + retorno.altura);
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
                $("#alt").select();
                $("#alt").val(retorno.altura);
                $("#larg").select();
                $("#larg").val(retorno.largura);
                $("#larg").blur();
                $("#atividade").val(retorno.atividade);
                $("select").formSelect();
                $("#seguranca").val(retorno.seguranca);
                $("select").formSelect();
                $("#form_edita").attr("data-idpedido", retorno.idpedido);
                if(retorno.emergencial == 2){
                    $("#emergencial_modal").attr('checked', 'checked');
                    $("#emergencial_modal").attr('disabled', 'disabled');
                }else{
                    $("#emergencial_modal").removeAttr('disabled');
                    $("#emergencial_modal").removeAttr('checked');
                }
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
                $("#dimensao_detalhes").text(retorno.largura + "X" + retorno.altura);
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

    $("#form_edita").submit(function(e) {
        e.preventDefault();
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
                    setTimeout(function(){
                        M.toast({
                            html: 'Pedido atualizado!',
                            classes: 'green'
                        })
                    }, 2000);
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