$('.dropdown-trigger').dropdown({
    container: document.body
});
$(document).ready(function() {
    $("#dataFiltro").change(function(){
        $.post( "../controller/select/processosDia.php", {data : $(this).val()})
                .done(function(data) {
                    $("#corpo_lista").html(data);
            });
    });

    $("select").formSelect();

    $(".data").mask("00/00/0000");
    $(".hora").mask("00:00");

    $('.datepicker').datepicker({
        defaultDate: new Date(),
        container: document.body,
        format: 'dd/mm/yyyy',
        i18n: {
            cancel: "Cancelar",
            clear: "Limpar",
            done: "Ok",
            months: [
                'Janeiro',
                'Fevereiro',
                'Março',
                'Abril',
                'Maio',
                'Junho',
                'Julho',
                'Agosto',
                'Setembro',
                'Outubro',
                'Novembro',
                'Dezembro'
            ],
            monthsShort: [
                'Jan',
                'Fev',
                'Mar',
                'Abr',
                'Mai',
                'Jun',
                'Jul',
                'Ago',
                'Set',
                'Out',
                'Nov',
                'Dez'
            ],
            weekdays: [
                'Domingo',
                'Segunda',
                'Terça',
                'Quarta',
                'Quinta',
                'Sexta',
                'Sábado'
            ],
            weekdaysShort: [
                'Dom',
                'Seg',
                'Ter',
                'Qua',
                'Qui',
                'Sex',
                'Sáb'
            ],
            weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S']
        }
    });

    $('.timepicker').timepicker({
        container: 'body',
        i18n: {
            cancel: "Cancelar",
            clear: "Limpar",
            done: "Ok"
        },
        twelveHour: false
    });

    $(".finalizar").click(function(){
        var idProduto = $(this).attr("data-id-produto");

        $.ajax({
            url: "../controller/select/processosProduto.php",
            type: "POST",
            data: {produto: idProduto},
            success: (function (data) {
                var retorno = $.parseJSON(data);
                
                $("#lista_processos").html('');
                $("#form_processos").attr('data-id-pedido', retorno.pedido);
                retorno.processos.forEach(ret => {
                    if(ret.finalizado){
                        $("#lista_processos").append("<p><label><input type='checkbox' class='filled-in' checked disabled='disabled' /><span>"+ret.descricao+"</span></label></p>");
                    }else{
                        $("#lista_processos").append("<p><label><input type='checkbox' class='filled-in a_finalizar' data-id='"+ret.idprocesso+"' /><span>"+ret.descricao+"</span></label></p>");
                    }
                });
                $("#produto_processos").text(retorno.nome);
            })
        });
    });

    $("#form_processos").submit(function(e){
        e.preventDefault();
        var formProcessos = new FormData();

        formProcessos.append("pedido", $(this).attr("data-id-pedido"));

        var pos = 1;

        $("input[type='checkbox']:checked.a_finalizar").each(function(){
            formProcessos.append("processo["+pos+"][id]", $(this).attr("data-id"));
            pos++;
        });

        // // Display the key/value pairs
        // for (var pair of formProcessos.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }

         $.ajax({
            url: '../controller/update/finalizaProcesso.php',
            type: 'POST',
            data: formProcessos,
            processData: false,
            contentType: false,
            success: function(data){
                var retorno = $.parseJSON(data)

                if(retorno.cod == '1'){
                    M.toast({
                        html: "Processo(s) finalizado(s) com sucesso!",
                        classes: 'green'
                    });
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }else if(retorno.cod == 2){
                    M.toast({
                        html: "Processo(s) finalizado(s) com sucesso!",
                        classes: 'green'
                    });
                    M.toast({
                        html: "Todos os processos finalizados, pedido concluído",
                        classes: 'green'
                    });
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }else{
                    M.toast({
                        html: "Erro ao finalizar processos",
                        classes: 'red'
                    });
                }
            }
         })
    });

});