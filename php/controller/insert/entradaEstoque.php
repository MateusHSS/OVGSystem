<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    include_once "../../config/conexao.php";

    $sap = $_POST['sap'];
    $qtd = $_POST['qtd'];
    $peso = $_POST['peso'];

    $sqlSelecionaIdEstoque = $connect->prepare("SELECT tabestoque.idtabestoque FROM tabestoque WHERE tabestoque.SAP_material = ?");
    $sqlSelecionaIdEstoque->bind_param("i", $sap);
    $sqlSelecionaIdEstoque->execute();
    $resIdEstoque = $sqlSelecionaIdEstoque->get_result()->fetch_assoc();

    $idEstoque = $resIdEstoque['idtabestoque'];

    $sqlInsereEstoque = $connect->prepare("UPDATE tabestoque SET quantidade = quantidade + $qtd, KG = KG + $peso, mm2 = mm2 + (SELECT tabmaterial.mm2 FROM tabmaterial WHERE tabmaterial.codigo_SAP = $sap) * $qtd WHERE tabestoque.idtabestoque = $idEstoque");
    $sqlInsereEstoque->execute();

    if($sqlInsereEstoque->affected_rows > 0){
        $sqlSelecionaIdTabMaterial = $connect->prepare("SELECT tabmaterial.mm2 FROM tabmaterial WHERE tabmaterial.codigo_SAP = ?");
        $sqlSelecionaIdTabMaterial->bind_param("s", $sap);
        $sqlSelecionaIdTabMaterial->execute();
        $resIdTabMaterial = $sqlSelecionaIdTabMaterial->get_result()->fetch_assoc();

        $area = (((int)$resIdTabMaterial['mm2']) * ((int)$qtd));

        $sqlRegistraMovimentacao = $connect->prepare("INSERT INTO tabmovimentacaoestoque (SAP_material, tipo_movimentacao, quantidade, KG, mm2) VALUES (?, 1, ?, ?, ?)");
        $sqlRegistraMovimentacao->bind_param("sidi", $sap, $qtd, $peso, $area);
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