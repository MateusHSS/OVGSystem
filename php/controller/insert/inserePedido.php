<?php
    include_once '../../config/conexao.php';

    $idClientePedido = $_POST['cliente'];
    $nomeClientePedido = $_POST['cliente_pedido'];
    $produtoPedido = $_POST['produto'];
    $quantidadePedido = $_POST['qtd_pedido'];
    $altura = $_POST['altura'];
    $largura = $_POST['largura'];
    $espessura = $_POST['espessura'];
    $atividadePedido = $_POST['atividade_pedido'];
    $segurancaPedido = $_POST['seguranca_pedido'];
    $obs = $_POST['obs_pedido'];

    $nomeArq= $_FILES['formulario_pedido']['name'];
    $pastaArq= '../../formulariosPedidos/'.$_FILES['formulario_pedido']['name'];

    if(isset($_POST['emerg'])){
        $emerg = 2;
        $status = 3;
    }else{
        $emerg = 0;
        $status = 1;
    }

    $id = $_POST['produto'];

    $sqlSelecionaMateriais = $connect->prepare("SELECT tabmaterialproduto.idmaterial, tabmaterial.codigo_SAP FROM tabmaterialproduto INNER JOIN tabmaterial ON tabmaterialproduto.idmaterial = tabmaterial.idmaterial WHERE idproduto = ?");
    $sqlSelecionaMateriais->bind_param("i", $id);
    $sqlSelecionaMateriais->execute();
    $resultMateriais = $sqlSelecionaMateriais->get_result();

    $ret = true;

    while($resMateriais = $resultMateriais->fetch_assoc()){

        $sapMaterial = $resMateriais['codigo_SAP'];

        $areaPed = ((int)$altura * (int)$largura) * $quantidadePedido;

        $sqlVerificaEstoque = $connect->prepare("SELECT tabestoque.mm2 FROM tabestoque WHERE tabestoque.SAP_material = ?");
        $sqlVerificaEstoque->bind_param("s", $sapMaterial);
        $sqlVerificaEstoque->execute();

        $resultEstoque = $sqlVerificaEstoque->get_result();

        $resEstoque = $resultEstoque->fetch_assoc();

        if($areaPed > $resEstoque['mm2']){
            $ret = false;
            break;
        }
    }

    if($ret){

        if($nomeArq != ''){

            $id = $_POST['produto'];

            $sqlSelecionaMateriais = $connect->prepare("SELECT tabmaterialproduto.idmaterial, tabmaterial.codigo_SAP FROM tabmaterialproduto INNER JOIN tabmaterial ON tabmaterialproduto.idmaterial = tabmaterial.idmaterial WHERE idproduto = ?");
            $sqlSelecionaMateriais->bind_param("i", $id);
            $sqlSelecionaMateriais->execute();
            $resultMateriais = $sqlSelecionaMateriais->get_result();

            while($resMateriais = $resultMateriais->fetch_assoc()){
                $id_material = $resMateriais['idmaterial'];
                $sapMaterial = $resMateriais['codigo_SAP'];
    
                $sqlSelecionaIdEstoque = $connect->prepare("SELECT tabestoque.idtabestoque, tabmaterial.mm2, tabmaterial.peso_KG FROM tabestoque INNER JOIN tabmaterial ON tabmaterial.codigo_SAP = tabestoque.SAP_material WHERE tabestoque.SAP_material = ?");
                $sqlSelecionaIdEstoque->bind_param("s", $sapMaterial);
                $sqlSelecionaIdEstoque->execute();
                $resultIdEstoque = $sqlSelecionaIdEstoque->get_result();
                $resIdEstoque = $resultIdEstoque->fetch_assoc();
                $idEstoque = $resIdEstoque['idtabestoque'];
                $areaMat = $resIdEstoque['mm2'];
                $pesoMat = $resIdEstoque['peso_KG'];
    
                $areaPed = ((int)$altura * (int)$largura) * $quantidadePedido;
    
                $pesoPed = ($areaPed * $pesoMat)/$areaMat;
    
                $quantPed = number_format($areaPed/$areaMat, 2, '.', '');
    
                $sqlAtualizaEstoque = $connect->prepare("UPDATE tabestoque SET tabestoque.mm2 = tabestoque.mm2 - ?, tabestoque.KG = tabestoque.KG - ?, tabestoque.quantidade = tabestoque.quantidade - ? WHERE tabestoque.idtabestoque = ?");
                $sqlAtualizaEstoque->bind_param("iddi", $areaPed, $pesoPed, $quantPed, $sapMaterial);
                $sqlAtualizaEstoque->execute();
    
                
            }

            $sql = $connect->prepare("INSERT INTO tabpedido (clientepedido, produtopedido, quantidadepedido, altura, largura, espessura, formulariopedido, atividade, seguranca, datainclusao, statuspedido, emergencial, obs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?)");
            $sql->bind_param('sssssssssiis', $idClientePedido, $produtoPedido, $quantidadePedido, $altura, $largura, $espessura, $nomeArq, $atividadePedido, $segurancaPedido, $status, $emerg, $obs);
            $sql->execute();
    
            if($sql->affected_rows > 0 && move_uploaded_file($_FILES['formulario_pedido']['tmp_name'], $pastaArq)){
                echo json_encode(array("cod" => "1", "id" => $connect->insert_id, "opc" => '2'));
            }else{
                echo json_encode(array("cod" => "0", "erro" => $connect->error, "opc" => '2'));
            }
    
        }else{

            $id = $_POST['produto'];

            $sqlSelecionaMateriais = $connect->prepare("SELECT tabmaterialproduto.idmaterial, tabmaterial.codigo_SAP FROM tabmaterialproduto INNER JOIN tabmaterial ON tabmaterialproduto.idmaterial = tabmaterial.idmaterial WHERE idproduto = ?");
            $sqlSelecionaMateriais->bind_param("i", $id);
            $sqlSelecionaMateriais->execute();
            $resultMateriais = $sqlSelecionaMateriais->get_result();

            while($resMateriais = $resultMateriais->fetch_assoc()){
                $id_material = $resMateriais['idmaterial'];
                $sapMaterial = $resMateriais['codigo_SAP'];
    
                $sqlSelecionaIdEstoque = $connect->prepare("SELECT tabestoque.idtabestoque, tabmaterial.mm2, tabmaterial.peso_KG FROM tabestoque INNER JOIN tabmaterial ON tabmaterial.codigo_SAP = tabestoque.SAP_material WHERE tabestoque.SAP_material = ?");
                $sqlSelecionaIdEstoque->bind_param("s", $sapMaterial);
                $sqlSelecionaIdEstoque->execute();

                $resultIdEstoque = $sqlSelecionaIdEstoque->get_result();
                $resIdEstoque = $resultIdEstoque->fetch_assoc();
                $idEstoque = $resIdEstoque['idtabestoque'];
                $areaMat = $resIdEstoque['mm2'];
                $pesoMat = $resIdEstoque['peso_KG'];
    
                $areaPed = ((int)$altura * (int)$largura) * $quantidadePedido;
    
                $pesoPed = ($areaPed * $pesoMat)/$areaMat;
    
                $quantPed = number_format($areaPed/$areaMat, 1, '.', '');

                if($quantPed == 0){
                    $quantPed = 0.1;
                }
    
                $sqlAtualizaEstoque = $connect->prepare("UPDATE tabestoque SET tabestoque.mm2 = tabestoque.mm2 - ?, tabestoque.KG = tabestoque.KG - ?, tabestoque.quantidade = tabestoque.quantidade - ? WHERE tabestoque.idtabestoque = ?");
                $sqlAtualizaEstoque->bind_param("iddi", $areaPed, $pesoPed, $quantPed, $idEstoque);
                $sqlAtualizaEstoque->execute();

                $sqlRegistraMovimentacao = $connect->prepare("INSERT INTO tabmovimentacaoestoque (SAP_material, tipo_movimentacao, KG, quantidade, mm2, data) VALUES (?, 2, ?, ?, ?, NOW())");
                $sqlRegistraMovimentacao->bind_param("sddi", $sapMaterial, $pesoPed, $quantPed, $areaPed);
                $sqlRegistraMovimentacao->execute();

                $selecionaProximoIdPEdido = $connect->prepare("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'tabpedido' and table_schema = 'ongceu28_ovgsystem'");
                $selecionaProximoIdPEdido->execute();
                $resIDpedido = $selecionaProximoIdPEdido->get_result()->fetch_assoc();
                $idProxPed = $resIDpedido['AUTO_INCREMENT'];

                $sqlRegistraMateriaisGastos = $connect->prepare("INSERT INTO tabmaterial_por_pedido (idpedido, idmaterial, mm2) VALUES (?, ?, ?)");
                $sqlRegistraMateriaisGastos->bind_param("iid", $idProxPed, $id_material, $areaPed);
                $sqlRegistraMateriaisGastos->execute();
                
                if($sqlAtualizaEstoque->affected_rows == 0){
                    $trava = true;
                    break;
                }
                
            }
    
            if(!isset($trava)){
                $sql = $connect->prepare("INSERT INTO tabpedido (clientepedido, produtopedido, quantidadepedido, altura, largura, espessura, atividade, seguranca, datainclusao, statuspedido, emergencial, obs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?)");
                $sql->bind_param('ssssssssiss', $idClientePedido, $produtoPedido, $quantidadePedido, $altura, $largura, $espessura, $atividadePedido, $segurancaPedido, $status, $emerg, $obs);
                $sql->execute();
        
                if($sql->affected_rows > 0){
                    echo json_encode(array("cod" => "1", "id" => $connect->insert_id, "opc" => '3'));
                }else{
                    echo json_encode(array("cod" => "0", "erro" => $connect->error, "opc" => '4'));
                }
            }else{
                echo json_encode(array("cod" => "0", "erro" => $connect->error));
            }
        }

    }else{
        echo json_encode(array("cod" => '2', "op" => "5"));
    }

    

    

?>