<?php
    include_once "../../config/conexao.php";

    $sap = $_POST['sap'];
    $qtd = $_POST['qtd'];
    $peso = $_POST['peso'];

    $sqlInsereEstoque = $connect->prepare("UPDATE tabestoque SET quantidade = quantidade + $qtd, KG = KG + $peso WHERE SAP_material = $sap");
    $sqlInsereEstoque->execute();

    if($sqlInsereEstoque->affected_rows > 0){

        $sqlRegistraMovimentacao = $connect->prepare("INSERT INTO tabmovimentacaoestoque (tipo_movimentacao, quantidade, KG) VALUES (1, $qtd, $peso)");
        $sqlRegistraMovimentacao->execute();

        if($sqlRegistraMovimentacao->affected_rows > 0){
            echo json_encode(array("cod" => '1'));
        }else{
            echo json_encode(array("cod" => '0', "erro" => $connect->error));
        }
    }else{
        echo json_encode(array("cod" => '0', "erro" => $connect->error));
    }

    

?>