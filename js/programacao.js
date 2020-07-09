$('.dropdown-trigger').dropdown({
    container: document.body
});
$(document).ready(function() {
    $("select").formSelect();

    $(".modal#programar").modal({
        onOpenStart: function(){
            $("input[type='text']").each(function(){
                $(this).val('1');
            })
        },
        onOpenEnd: function(){
            calculaTempo();
        }
    })

    $(".programa").click(function(){
        var id = $(this).attr("data-id");
        $.ajax({
            url: "../controller/select/dadosPedido.php",
            type: "POST",
            data: {id : id},
            success: function(data) {
                var retorno = $.parseJSON(data);
                $("#titulo_modal").text(retorno.nomeproduto + " (" + retorno.quantidadepedido + " und)");
                $("#form_programa_pedido").attr("data-id-pedido", retorno.idpedido);
                $("#form_programa_pedido").attr("data-qtd-pedido", retorno.quantidadepedido);
            }
        });
    });

    $('.tooltipped').tooltip();

    function calculaTempo(){
        var segundos = 0;

        var idPed = $("#form_programa_pedido").attr("data-id-pedido");
        var qtdPed = $("#form_programa_pedido").attr("data-qtd-pedido");

        $(".processos:checked").each(function() {
            var tempo = $(this).attr("data-tempo-proc").split(":");
            var horas = parseInt(tempo[0]);
            var min = parseInt(tempo[1]);
            var seg = parseInt(tempo[2]);

            var id_proc = $(this).attr("data-id-processo");
            var qtd = $("#qtd_proc_" + id_proc).val();

            var tempoProcesso = ((horas * 3600 + min * 60 + seg) * qtd)*qtdPed;

            if(tempoProcesso / 3600 < 10){
                var hProcesso = '0'+parseInt(tempoProcesso / 3600);
            }else{
                var hProcesso = parseInt(tempoProcesso / 3600);
            }

            var auxProc = tempoProcesso % 3600;

            if(auxProc / 60 < 10){
                var mProc = '0'+parseInt(auxProc / 60);
            }else{
                var mProc = parseInt(auxProc / 60);
            }
    
            if(auxProc % 60 < 10){
                var sProc = '0'+parseInt(auxProc % 60);
            }else{
                var sProc = parseInt(auxProc % 60);
            }
            
            $("#tempo_processo_"+id_proc).text(hProcesso + ":" + mProc + ":" + sProc);

            segundos += (horas * 3600 + min * 60 + seg) * qtd;
        });

        var tempoTotal = segundos*qtdPed;

        if(tempoTotal / 3600 < 10){
            var hFinalPed = '0'+parseInt(tempoTotal / 3600);
        }else{
            var hFinalPed = parseInt(tempoTotal / 3600);
        }

        var auxPed = tempoTotal % 3600;

        if(auxPed / 60 < 10){
            var mFinalPed = '0'+parseInt(auxPed / 60);
        }else{
            var mFinalPed = parseInt(auxPed / 60);
        }

        if(auxPed % 60 < 10){
            var sFinalPed = '0'+parseInt(auxPed % 60);
        }else{
            var sFinalPed = parseInt(auxPed % 60);
        }
        
        if(segundos / 3600 < 10){
            var hFinalPeca = '0'+parseInt(segundos / 3600);
        }else{
            var hFinalPeca = parseInt(segundos / 3600);
        }
        
        var auxP = segundos % 3600;
        
        if(auxP / 60 < 10){
            var mFinalPeca = '0'+parseInt(auxP / 60);
        }else{
            var mFinalPeca = parseInt(auxP / 60);
        }

        if(auxP % 60 < 10){
            var sFinalPeca = '0'+parseInt(auxP % 60);
        }else{
            var sFinalPeca = parseInt(auxP % 60);
        }

        $("#tempo_peca").text(hFinalPeca + ":" + mFinalPeca + ":" + sFinalPeca);
        $("#tempo_pedido").text(hFinalPed + ":" + mFinalPed + ":" + sFinalPed);
    }
    
    $(".processos").click(function() {
        calculaTempo();
    });

    $(".qtd").keyup(function() {
        calculaTempo();
    });

    //INSERCAO DOS DADOS DO PEDIDO
    $('#form_programa_pedido').submit(function (e) {
            e.preventDefault();

            var formPrograma = new FormData();
            formPrograma.append("pedido", $(this).attr("data-id-pedido"));
            formPrograma.append("qtd_pedido", $(this).attr("data-qtd-pedido"));
            formPrograma.append("tempo_unt", $("#tempo_peca").text());
            formPrograma.append("tempo_pedido", $("#tempo_pedido").text());

            $(".processos:checked").each(function(){
                var processo = $(this).attr("data-id-processo");

                formPrograma.append("processo["+processo+"][id]", processo);
                formPrograma.append("processo["+processo+"][qtd]", $("input[name='processo["+processo+"][qtd]']").val());
                formPrograma.append("processo["+processo+"][funcionarios]", $("input[name='processo["+processo+"][funcionarios]']").val());
                formPrograma.append("processo["+processo+"][tempo]", $("#tempo_processo_"+processo).text());
            })
            
    
            // // Display the key/value pairs
            // for (var pair of formPrograma.entries()) {
            //     console.log(pair[0] + ', ' + pair[1]);
            // }

            
    
            $.ajax({
                url: "../controller/update/programaPedido.php",
                type: "POST",
                data: formPrograma,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = $.parseJSON(data);
                    if (data.cod == '1') {
                        M.toast({
                            html: 'Pedido programado',
                            classes: 'green'
                        });
                    } else {
                        M.toast({
                            html: 'Erro ao programar pedido!',
                            classes: 'red'
                        });
                    }
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }
            });
    });
        

});