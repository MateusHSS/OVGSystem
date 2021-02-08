<?php 
    include_once "../../config/conexao.php";

    $data = $_POST['data'];

    $sqlSelecionaProcessoDia = $connect->prepare("SELECT tabprocessosproduto.idproduto, tabprocessosproduto.idprocesso, tabprocessosproduto.finalizado, date_format(final_real, '%H:%i') AS final_real, tabprocesso.descricao, tabprocesso.maquina, tabmaquinas.nome_maquina, DATE_FORMAT(tabprocessosproduto.pros_inicial, '%H:%i') AS hora_inicial, DATE_FORMAT(tabprocessosproduto.pros_final, '%H:%i') AS hora_final, tabprocessosproduto.pros_inicial, DATE_FORMAT(tabprocessosproduto.pros_final, '%Y-%m-%d') AS data_final FROM tabprocessosproduto
    INNER JOIN tabprocesso ON tabprocesso.idtabprocesso = tabprocessosproduto.idprocesso
    INNER JOIN tabmaquinas ON tabmaquinas.idtabmaquinas = tabprocesso.maquina
    WHERE date_format(pros_final, '%d/%m/%Y') = '$data'  ORDER BY pros_inicial");
    $sqlSelecionaProcessoDia->execute();

    $resultProcessosDia = $sqlSelecionaProcessoDia->get_result();

    if($resultProcessosDia->num_rows > 0){
        while($resProcessosDia = $resultProcessosDia->fetch_assoc()){
            ?>
<tr>
    <td><?php echo $resProcessosDia['idproduto'] ?></td>
    <td><?php echo $resProcessosDia['descricao'] ?></td>
    <td><?php echo $resProcessosDia['nome_maquina'] ?></td>
    <td><?php echo $resProcessosDia['hora_inicial'] ?></td>
    <td><?php echo $resProcessosDia['hora_final'] ?></td>
    <?php
            if($resProcessosDia['finalizado'] == 1){
                ?>
    <td><i class="material-icons green-text">check</i></td>
    <?php
            }else{
                ?>
    <td><button data-id-produto="<?php echo $resProcessosDia['idproduto'] ?>" data-id-processo="<?php echo $resProcessosDia['idprocesso'] ?>"
            class="btn btn-small finalizar">Finalizar</button></td>
    <?php
            }
        ?>

</tr>
<?php
        }
    }else{
        ?>
<tr>
    <td colspan="6">Nenhum processo previsto para a data selecionada...</td>
</tr>
<?php
    }

    ?>
<script>
$(document).ready(function() {
    $(".finalizar").click(function() {
        var idProd = $(this).attr('data-id-produto');
        var idProc = $(this).attr('data-id-processo');
        $.post("../controller/update/finalizaProcesso.php", {
                idProd: idProd,
                idProc: idProc
            })
            .done(function(data) {
                data = $.parseJSON(data);
                M.toast({
                    html: data.msg,
                    classes: data.class
                });
                if (data.cod == '1') {
                    location.reload();
                } else if (data.cod == 2) {
                    alert(data.alert);
                    location.reload();
                } else {
                    console.log(data.erro);
                }
            }, "json");
    });
})
</script>
<?php


?>