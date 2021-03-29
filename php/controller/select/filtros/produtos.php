<?php
    include_once "../../../config/conexao.php";

    $nomeProd = '%'.$_POST['filtro_nome'].'%';

    $sqlSelecionaProdutos = $connect->prepare("SELECT tabproduto.idproduto, tabproduto.nomeproduto, DATE_FORMAT(tabproduto.datacadastro, '%d/%m/%Y') AS datacadastro
                                                FROM tabproduto WHERE tabproduto.nomeproduto LIKE ? OR tabproduto.idproduto LIKE ?");
    $sqlSelecionaProdutos->bind_param("ss", $nomeProd, $nomeProd);
    $sqlSelecionaProdutos->execute();

    $resultProdutos = $sqlSelecionaProdutos->get_result();

    if($resultProdutos->num_rows > 0){
        $dados = array();
        while($resProdutos = $resultProdutos->fetch_assoc()){
            array_push($dados,$resProdutos);
        }

        echo json_encode($dados);
    }else{
        ?>
        <tr>
            <td colspan="7">Nenhum pedido encontrado...</td>
        </tr>
        <?php
    }

?>