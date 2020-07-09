function limpa_formulario_cep() {
    // Limpa valores do formulário de cep.
    $("#rua").val("");
    $("#bairro").val("");
    $("#cidade").val("");
}

//Quando o campo cep perde o foco.
$("#cep").blur(function() {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#rua").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#rua").select();
                    $("#rua").val(dados.logradouro);
                    $("#bairro").select();
                    $("#bairro").val(dados.bairro);
                    $("#cidade").select();
                    $("#cidade").val(dados.localidade);
                    $("#num").select();
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulario_cep();
                    alert("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpa_formulario_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulario_cep();
    }
});

$(document).ready(function(){
    $('.dropdown-trigger').dropdown({
        container: document.body
    });
    $("select").formSelect();
    $('input#obs, textarea#textarea2').characterCounter();
    $("#cpf").mask('000.000.000-00');
    $('#cep').mask('00000-000');
    $('#tel').focus(function(){
        $('#tel').mask('(00)00000-0000');
        $('#tel').blur(function(event) {
            if ($(this).val().length == 14) { // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
                $('#tel').mask('(00)00000-0000');
            } else {
                $('#tel').mask('(00)0000-0000');
            }
        });
    });
})

