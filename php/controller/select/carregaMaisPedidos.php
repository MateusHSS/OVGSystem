<?php
    include_once "../../config/conexao.php";

    $inicio = $_POST['inicio'];

    $sqlCarregaPedidos = $connect->prepare("SELECT tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto, tabpedido.quantidadepedido, tabpedido.dimensaopedido, tabpedido.statuspedido, tabstatus.nomestatus, tabpedido.atividade, tabatividade.descricao AS nomeatividade, tabpedido.seguranca, tabseguranca.descricao AS nomeseguranca, tabpedido.formulariopedido, DATEDIFF (NOW(), tabpedido.datainclusao) AS quantidade_dias
                                                FROM tabpedido
                                            INNER JOIN tabcliente ON tabcliente.idcliente = tabpedido.clientepedido
                                            INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido
                                            INNER JOIN tabstatus ON tabstatus.idtabstatus = tabpedido.statuspedido
                                            INNER JOIN tabatividade ON tabatividade.idtabatividade = tabpedido.atividade
                                            INNER JOIN tabseguranca	ON tabseguranca.idtabseguranca = tabpedido.seguranca
                                            ORDER BY tabpedido.statuspedido LIMIT 100 OFFSET $inicio");
    $sqlCarregaPedidos->execute();

    $resultPedidos = $sqlCarregaPedidos->get_result();

    while($resPedidos = $resultPedidos->fetch_assoc()){
        ?>
<tr>
    <td><?php echo $resPedidos['idpedido'] ?></td>
    <td><?php echo $resPedidos['nomecliente'] ?></td>
    <td><?php echo $resPedidos['nomeproduto'] ?></td>
    <td><?php echo $resPedidos['quantidadepedido'] ?></td>
    <td><?php echo $resPedidos['nomestatus'] ?></td>
    <td><?php echo $resPedidos['quantidade_dias'] ?> dias</td>
    <?php
                                    if($resPedidos['statuspedido'] == 1 || $resPedidos['statuspedido'] == 3 || $resPedidos['statuspedido'] == 6){
                                        ?>
    <td>
        <button data-target="edita" data-id="<?php echo $resPedidos['idpedido'] ?>"
            class="btn-small white modal-trigger atualiza ">
            <i class="material-icons orange-text text-darken-3">edit</i>
        </button>
        <button data-target="detalhes" data-id="<?php echo $resPedidos['idpedido'] ?>"
            class="btn-small white modal-trigger detalhes">
            <i class="material-icons blue-text text-darken-3">list</i>
        </button>
    </td>
    <?php
                                    }else{
                                        ?>
    <td>
        <button data-target="detalhes" data-id="<?php echo $resPedidos['idpedido'] ?>"
            class="btn-small white modal-trigger detalhes">
            <i class="material-icons orange-text text-darken-3">list</i>
        </button>
    </td>
    <?php
                                    }
                                ?>
</tr>
<?php
    }
    if($resultPedidos->num_rows >= 100){
        ?>
<tr class="center carregar_mais">
    <td colspan="6">Carregar mais...</td>
</tr>
<?php
    }


?>
<script src="../../js/listas/listaPedidos.js"></script>