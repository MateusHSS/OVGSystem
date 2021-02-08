$('.dropdown-trigger').dropdown({
    container: document.body
});

$(document).ready(function() {
    $(".modal").modal();

    $('.botao').click(function(){
        var id = $(this).attr('id');
        var url = $('#form-edita'+id).attr('action');
        var setor = $('#setor-cliente'+id).val();
        if(setor != null){
            url += '&setor-cliente='+setor;
        }
        var unid = $('#corredor-cliente'+id).val();
        if(unid != null){
            url += '&corredor-cliente='+unid;
        }
        $('#form-edita'+id).attr('action', url).submit();

        
    });

    $('.edita').hide();

    // $('.exclui').hide();

    $("select").formSelect();

    $('.modal').modal();

    $('.editar').click(function(){
        $('.edita').toggle();
    })

    $('.excluir').click(function(){
        $('.exclui').toggle();
    })

    $('.exclui').click(function(){
        var apagar = confirm('Deseja realmente excluir este registro?');
        var opc = $(this).attr('data-opc');
        var id = $(this).attr('id');
        if (apagar) {
            window.location.href = '../controller/delete/exclui'+opc+'.php?id='+id;
        } else {
            event.preventDefault();
        }
    })

    $('#top').click(function(){
        //scroll suave
        $('html, body').animate({scrollTop:0}, 'slow'); //slow, medium, fast
    })

    $('.fixed-action-btn').floatingActionButton();

    

})