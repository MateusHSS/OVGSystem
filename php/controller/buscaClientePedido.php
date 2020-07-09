<?php
    include_once '../config/conexao.php';

    $nomeCliente = $_POST['cliente_pedido'];

    $sql = $connect->prepare("SELECT * FROM tabcliente WHERE nomecliente LIKE '%$nomeCliente%' ");
    // $sql->bind_param('s', $nomeCliente);
    $sql->execute();
    $result = $sql->get_result();

    if(!empty($nomeCliente)){
        while($row = $result->fetch_assoc()){
            ?>
            <div class="row cliente" data-id='<?php echo $row['idcliente'] ?>|<?php echo $row['nomecliente'] ?>'>
                <div class='white left'>
                    <?php echo $row['nomecliente'] ?>
                </div>
            </div>
            <div class="divider"></div>
            <?php
        }
    }
    

?>