$('.dropdown-trigger').dropdown({
    container: document.body
});

$(document).ready(function() {

    $(".modal").modal();

    $("select").formSelect();

    $(".edita").click(function(){
        $.ajax({
            url: "../controller/select/dadosMaterial.php",
            type: "POST",
            data: {
                id: $(this).attr("data-id")
            },
            success: function(data) {
                var retorno = $.parseJSON(data);
                $("#nome_material").select();
                $("#nome_material").val(retorno.nomematerial);
                $("#nome_material").blur();
                $("#form_edita").attr("data-id", retorno.idmaterial);
            }
        });
    });

    $("#form_edita").submit(function() {
        event.preventDefault();
        var id = this.getAttribute("data-id");
        var dados = new FormData(this);
        dados.append('id', id);

        // // Exibição dos valores chave/valor
        // for (var pair of dados.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }

        $.ajax({
            url: "../controller/update/atualizaMaterial.php",
            type: "POST",
            data: dados,
            processData: false,
            contentType: false,
            success: function(data) {
                var retorno = $.parseJSON(data);
                if (retorno.cod == '1') {
                    M.toast({
                        html: 'Cliente atualizado!',
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

    $(".exclui").click(function(){
        var id = $(this).attr("data-id");

        $.ajax({
            url: "../controller/select/dadosCliente.php",
            type: "POST",
            data: {id: $(this).attr("data-id")},
            success: (function(data) {
                data = $.parseJSON(data);
                $("#confirma_exclui_button").attr("data-id", data.idcliente);
                $("#nome_exclui").text(data.nomecliente);
            })
        });
    });

    $("#confirma_exclui_button").click(function(e){
        $.ajax({
            url: "../controller/delete/excluiCliente.php",
            type: "POST",
            data: {'id': $(this).attr("data-id")},
            success: function(data){
                var retorno = $.parseJSON(data);
                if (retorno.cod == '1') {
                    M.toast({
                        html: 'Cliente excluído!',
                        classes: 'green'
                    });
                    location.reload();
                } else {
                    M.toast({
                        html: 'Erro ao excluir!',
                        classes: 'red'
                    });
                }
            }
        });
    });

    $(".carregar_mais").click(function() {
        var inicio = $("tbody tr").length - 1;

        $.ajax({

            url: '../controller/select/carregaMaisClientes.php',
            type: 'POST',
            dataType: 'html',
            data: {'inicio': inicio},
            success: function(data) {
                $(".carregar_mais").remove();
                $('#lista_clientes').append(data);
            }
        });

        return false;
    });

    

    $('#top').click(function(){
        //scroll suave
        $('html, body').animate({scrollTop:0}, 'slow'); //slow, medium, fast
    })

    $('.fixed-action-btn').floatingActionButton();

})