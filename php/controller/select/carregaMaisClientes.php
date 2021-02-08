<?php
    include_once "../../config/conexao.php";

    $inicio = $_POST['inicio'];

    $sqlCarregaClientes = $connect->prepare("SELECT tabcliente.corredorcliente, tabcliente.idsetorcliente, tabcliente.ativo, tabcliente.idcliente, tabcliente.nomecliente, tabcliente.telefonecliente, tabsetor.nomesetor, tabcorredor.nomecorredor
                                                FROM tabcliente
                                            INNER JOIN tabsetor ON tabcliente.idsetorcliente = tabsetor.idsetor
                                            INNER JOIN tabcorredor ON tabcorredor.idcorredor = tabcliente.corredorcliente
                                            ORDER BY tabcliente.datacadastrocliente DESC LIMIT 100 OFFSET $inicio");
    $sqlCarregaClientes->execute();

    $resultClientes = $sqlCarregaClientes->get_result();

    while($resClientes = $resultClientes->fetch_assoc()){
        ?>
<tr>
    <td><?php echo $resClientes['idcliente'] ?></td>
    <td><?php echo $resClientes['nomecliente'] ?></td>
    <td><?php echo $resClientes['telefonecliente'] ?></td>
    <td><?php echo $resClientes['nomesetor'] ?></td>
    <td><?php echo $resClientes['nomecorredor'] ?></td>
    <td>
        <button data-target="edita" data-id="<?php echo $resClientes['idcliente'] ?>"
            class="btn-small white orange-text text-darken-3 modal-trigger edita">
            <i class="material-icons">create</i>
        </button>
        <button data-target="exclui" data-id="<?php echo $resClientes['idcliente'] ?>"
            class="btn-small white red-text text-darken-3 modal-trigger exclui">
            <i class="material-icons">delete</i>
        </button>
    </td>
</tr>
<?php
    }
    if($resultClientes->num_rows >= 100){
        ?>
<tr class="center carregar_mais">
    <td colspan="6" >Carregar mais...</td>
</tr>
<?php
    }


?>
<script src="../../js/listas/listaClientes.js"></script>