<?php
    include_once '../config/conexao.php';

    $nomeMaterial = $_GET['nome-material'];
    $id = $_GET['idinput'];

    $sql = $connect->prepare("SELECT * FROM tabmaterial WHERE nomematerial LIKE '%$nomeMaterial%' ");
    $sql->execute();
    $result = $sql->get_result();

    if(!empty($nomeMaterial)){
        while($row = $result->fetch_assoc()){
            ?>
            <div class=" mat" data-id='<?php echo $row['idmaterial'] ?>|<?php echo $row['nomematerial'] ?>|<?php echo $id ?>' >
                <div style='padding: 2% 1% 2% 0%;text-align: left;'>
                    <?php echo $row['nomematerial'] ?>
                </div>
            </div>
            <div class="divider"></div>
            
            
            <?php
        }
    }
    

?>