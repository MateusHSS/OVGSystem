<?php
    include_once '../config/conexao.php';

    $nomeProduto = $_POST['produto_pedido'];

    $sql = $connect->prepare("SELECT * FROM tabproduto WHERE nomeproduto LIKE '%$nomeProduto%' ");
    $sql->execute();
    $result = $sql->get_result();

    if(!empty($nomeProduto)){
        while($row = $result->fetch_assoc()){
            ?>
            <div class="prod" data-id='<?php echo $row['idproduto'] ?>|<?php echo $row['nomeproduto'] ?>' >
                <div style='padding: 2% 1% 2% 0%;text-align: left;'>
                    <?php echo $row['nomeproduto'] ?>
                </div>
            </div>
            <div class="divider"></div>
            
            
            <?php
        }
    }
    

?>