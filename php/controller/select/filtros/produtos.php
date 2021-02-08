<?php
    include_once "../../../config/conexao.php";

    $nomeProd = $_POST['filtro_nome'];

    $sqlSelecionaProdutos = $connect->prepare("SELECT tabproduto.idproduto, tabproduto.nomeproduto, DATE_FORMAT(tabproduto.datacadastro, '%d/%m/%Y') AS datacadastro
                                                FROM tabproduto WHERE tabproduto.nomeproduto LIKE '%$nomeProd%'");
    $sqlSelecionaProdutos->execute();

    $resultProdutos = $sqlSelecionaProdutos->get_result();

    if($resultProdutos->num_rows > 0){

        while($resProdutos = $resultProdutos->fetch_assoc()){
            echo json_encode($resProdutos);
        }
        
        ?>
        <?php
    }else{
        ?>
        <tr>
            <td colspan="7">Nenhum pedido encontrado...</td>
        </tr>
        <?php
    }

?>