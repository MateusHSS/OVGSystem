<?php
    include_once "../../config/conexao.php";

    $id = $_POST['id'];

    if(isset($_POST['qtd'])){
        $qtd = $_POST['qtd'];
    }else{
        $qtd = 1;
    }

    $retorno = true;

    $sqlSelecionaMateriais = $connect->prepare("SELECT tabmaterialproduto.* FROM tabmaterialproduto WHERE idproduto = ?");
    $sqlSelecionaMateriais->bind_param("i", $id);
    $sqlSelecionaMateriais->execute();

    $resultMateriais = $sqlSelecionaMateriais->get_result();

    while($resMateriais = $resultMateriais->fetch_assoc()){

        $idMaterial = $resMateriais['idmaterial'];

        $sqlVerificaEstoque = $connect->prepare("SELECT tabestoque.quantidade, tabmaterial.idmaterial, tabmaterial.nomematerial FROM tabestoque
                                                    INNER JOIN tabmaterial ON tabmaterial.codigo_SAP = tabestoque.SAP_material
                                                    WHERE tabmaterial.idmaterial = ?");
        $sqlVerificaEstoque->bind_param("i", $idMaterial);
        $sqlVerificaEstoque->execute();

        $resultEstoque = $sqlVerificaEstoque->get_result();

        $resEstoque = $resultEstoque->fetch_assoc();

        if($resEstoque['quantidade'] < $resMateriais['quantidadematerial'] * $qtd){
            $retorno = false;
            break;
        }
    }

    echo json_encode($retorno);


?>
