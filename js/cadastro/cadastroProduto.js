$('.dropdown-trigger').dropdown({
    container: document.body
});
$(document).ready(function() {

    $(".material").keyup(function(){
        $(this).removeAttr("material-id");
    })

    function atriubuiId(val, id){
        $('input.material').each(function(e){
            if($(this).val() == val){
               $(this).attr("material-id", id);
               $(this).select();
               $(this).blur();
            }
        });
    }

    selecionaMateriais();

    function selecionaMateriais(){
        //SELECIONA OS NOMES QUE APARECERAO NA BUSCA DE MATERIAIS
        $.ajax({

            url: '../controller/select/nomeMateriais.php',
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

                $('input.autocomplete.material').autocomplete({
                    data: acData,
                    limit: 5,
                    onAutocomplete: function(val){
                        var posicao = retorno.nomes.indexOf(val);           //SELECIONA A POSICAO DESSE NOME NO ARRAY
                        var id = retorno.ids[posicao];                      //SELECIONA O ID DO NOME, DE ACORDO COM A POSICAO
                        atriubuiId(val, id);
                    }
                });
            }
        });
    }

    $.validator.setDefaults({
        ignore: []
    });

    $("#form_cadastro_produto").validate({
        rules: {
            nome_produto: {
                required: true,
                remote: {
                    url: '../controller/select/verificaProduto.php',
                    type: 'POST'
                }
            }
        },
        messages: {
            nome_produto: {
                required: "Campo obrigatório",
                remote: "Produto já cadastrado"
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
        if($(element).attr("material-id") == undefined){
            return false
        }else{
            return true
        }
    },"Selecione um material da lista");

    $.validator.addClassRules('material', {
        required: true,
        material: true
    });

    $.validator.addClassRules('qtd', {
        required: true,
        number: true
    });

    $.validator.messages.required = 'Campo obrigatório';
    $.validator.messages.number = 'Este campo precisa ser numérico';
    $.validator.messages.material = 'Selecione um material da lista';

    //INSERCAO DOS DADOS DO PRODUTO
    $('#form_cadastro_produto').submit(function (e) {
        if($(this).validate().errorList.length == 0){
            e.preventDefault();

            var formProduto = new FormData(this);

            $(".material").each(function(){
                var name = $(this).attr("name");
                var id = $(this).attr("id");
                formProduto.append(name.replace("[nome]", '') + '[id]', $("#" + id).attr("material-id"));
            });
            
    
            // Display the key/value pairs
            for (var pair of formProduto.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }
    
            $.ajax({
                url: "../controller/insert/insereProduto.php",
                type: "POST",
                data: formProduto,
                processData: false,
                contentType: false,
                success: function(data) {
                    var data = $.parseJSON(data);
                    console.log(data);
                    if (data.cod == '1') {
                        M.toast({
                            html: 'Produto cadastrado',
                            classes: 'green'
                        });
                        $("#form_cadastro_produto").each(function(){
                            this.reset();
                        });
                    } else {
                        M.toast({
                            html: 'Erro ao cadastrar produto!',
                            classes: 'red'
                        });
                    }
                }
            });
        }
        
    });

    $('select').formSelect();

    var wrapper = $("#linha"); //Fields wrapper
    
    var x = 1; //initlal text box count
    $(".add").click(function(e){ //on add input button click
        e.preventDefault();
        var pos = wrapper.find("input:text.material").length+1;
        $(wrapper).append('<div><div class="input-field col l5"><input type="text" class="autocomplete material" id="nome_material_'+pos+'" name="material['+pos+'][nome]"/><label for="nome_material_'+pos+'">Material</label><span class="helper-text right red-text remove" style="cursor: pointer;" data-pos="'+pos+'">Remover</span></div>'); //add input box
        x++; //text box increment

        //BUSCA O NOME DOS MATERIAIS PRO NOVO INPUT
        selecionaMateriais();
        
        $(".remove").click(function(e){ //user click on remove text
            e.preventDefault(); 
            var pos = $(this).attr('data-pos');
            $("#nome_material_"+pos).parent('div').remove(); 
            x--;
        });

        $(".material").keyup(function(){
            $(this).removeAttr("material-id");
        })
    });

});