<?php
    include_once "../../config/conexao.php";

    $id = $_POST['id'];

    $sqlSelecionaMateriais = $connect->prepare("SELECT tabmaterialproduto.idmaterial FROM tabmaterialproduto WHERE idproduto = ?");
    $sqlSelecionaMateriais->bind_param("i", $id);
    $sqlSelecionaMateriais->execute();
    $resultMateriais = $sqlSelecionaMateriais->get_result();

    $ret = true;

    while($resMateriais = $resultMateriais->fetch_assoc()){
        $id_material = $resMateriais['idmaterial'];

        $sqlSelecionaMedidas = $connect->prepare("SELECT tabmaterial.altura, tabmaterial.largura, tabmaterial.codigo_SAP FROM tabmaterial WHERE tabmaterial.idmaterial = ?");
        $sqlSelecionaMedidas->bind_param("i", $id_material);
        $sqlSelecionaMedidas->execute();
        $resultMedidas = $sqlSelecionaMedidas->get_result();
        $resMedidas = $resultMedidas->fetch_assoc();

        $sapMaterial = $resMedidas['codigo_SAP'];

        $altMat = (int)$resMedidas['altura'];
        $largMat = (int)$resMedidas['largura'];
        $areaMat = $altMat * $largMat;

        if(isset($_POST['qtd'])){
            $areaMat = ($altMat * $largMat) * $_POST['qtd'];
        }

        $sqlVerificaEstoque = $connect->prepare("SELECT tabestoque.mm2 FROM tabestoque WHERE tabestoque.SAP_material = ?");
        $sqlVerificaEstoque->bind_param("s", $sapMaterial);
        $sqlVerificaEstoque->execute();

        $resultEstoque = $sqlVerificaEstoque->get_result();

        $resEstoque = $resultEstoque->fetch_assoc();

        if($areaMat > $resEstoque['mm2']){
            $ret = false;
            break;
        }
    }

    echo json_encode($ret);  

?>
