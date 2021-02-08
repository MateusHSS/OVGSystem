<?php
    include_once '../../config/conexao.php';

    $idPed = $_POST['pedido'];
    $tempo = $_POST['tempo_pedido'];
    $tempo_unt = $_POST['tempo_unt'];

    $atualizaTabPedido = $connect->prepare("UPDATE tabpedido SET statuspedido = 6, tempo = ?, tempo_unt = ? WHERE tabpedido.idpedido = ?");
    $atualizaTabPedido->bind_param("ssi", $tempo, $tempo_unt, $idPed);
    $atualizaTabPedido->execute();

    if($atualizaTabPedido->affected_rows > 0){

        //REGISTRA OS PROCESSOS QUE O PEDIDO PRECISA PARA SER FEITO
        foreach($_POST['processo'] as $processo){
            $idProcesso = $processo['id'];
            $tempoProcesso = $processo['tempo'];
            $qtdProcesso = $processo['qtd'];
            $funcProcesso = $processo['funcionarios'];
    
            $sqlCadastraProcessosProduto = $connect->prepare("INSERT INTO tabprocessosproduto (idproduto, idprocesso, vezes, funcionarios, tempo) VALUES (?, ?, ?, ?, ?)");
            $sqlCadastraProcessosProduto->bind_param('sssss', $idPed, $idProcesso, $qtdProcesso, $funcProcesso, $tempoProcesso);
            $sqlCadastraProcessosProduto->execute();
    
            if($sqlCadastraProcessosProduto->affected_rows <= 0){
                echo json_encode(array("cod" => 0, "erro" => $connect->error, "op" => 1));
                break;
            }
        }

        // //REGISTRA A QUANTIDADE NECESSARIA DE CADA MATERIAL
        // foreach($_POST['material'] as $material){
        //     $idMaterial = $material['id'];
        //     $alt = $material['alt'];
        //     $larg = $material['larg'];
        //     $mm2 = ((double)$alt) * ((double)$larg);
    
        //     $sqlMateriaisProduto = $connect->prepare("INSERT INTO tabmaterialproduto (idproduto, idmaterial, altura, largura, mm2) VALUES (?, ?, ?, ?, ?)");
        //     $sqlMateriaisProduto->bind_param('iiiid', $idPed, $idMaterial, $alt, $larg, $mm2);
        //     $sqlMateriaisProduto->execute();
    
        //     if($sqlMateriaisProduto->affected_rows <= 0){
        //         echo json_encode(array("cod" => 0, "erro" => $connect->error, "op" => 2));
        //         break;
        //     }
        // }

        //SELECIONA OS DADOS DO PEDIDO
        $dadosPedido = $connect->prepare("SELECT tabpedido.*, tabatividade.peso + tabseguranca.peso AS pesoTotal 
                                            FROM tabpedido 
                                                INNER JOIN tabatividade ON tabatividade.idtabatividade = tabpedido.atividade
                                                INNER JOIN tabseguranca ON tabseguranca.idtabseguranca = tabpedido.seguranca
                                            WHERE idpedido = ?");
        $dadosPedido->bind_param("i", $idPed);
        $dadosPedido->execute();
        $resultDadosPedido = $dadosPedido->get_result();
        
        if($resultDadosPedido->num_rows > 0){

            $resDadosPedido = $resultDadosPedido->fetch_assoc();

            $id = $resDadosPedido['idpedido'];
            $idProd = $resDadosPedido['produtopedido'];
            $qtdPedido = $resDadosPedido['quantidadepedido'];
            $data = $resDadosPedido['datainclusao'];
            $peso = $resDadosPedido['pesoTotal'];
            $tempoPedido = $resDadosPedido['tempo'];
            $emergencial = $resDadosPedido['emergencial'];

            //ATUALIZA O ESTOQUE
            $sqlSelecionaMateriais = $connect->prepare("SELECT tabmaterialproduto.*, tabmaterial.codigo_SAP, tabmaterial.peso_KG FROM tabmaterialproduto 
                                                            INNER JOIN tabmaterial ON tabmaterial.idmaterial = tabmaterialproduto.idmaterial
                                                        WHERE idproduto = ?");
            $sqlSelecionaMateriais->bind_param("i", $idPed);
            $sqlSelecionaMateriais->execute();

            $resultMateriais = $sqlSelecionaMateriais->get_result();

            while($resMateriais = $resultMateriais->fetch_assoc()){

                $idMaterial = $resMateriais['idmaterial'];
                $sapMaterial = $resMateriais['codigo_SAP'];
                $qtdMaterial = $resMateriais['mm2'] * $qtdPedido;

                if($qtdMaterial == 0){
                    $qtdMaterial = 0.1;
                }
                

                $sqlSelecionaIdEstoque = $connect->prepare("SELECT tabestoque.idtabestoque FROM tabestoque WHERE tabestoque.SAP_material = ?");
                $sqlSelecionaIdEstoque->bind_param("s", $sapMaterial);
                $sqlSelecionaIdEstoque->execute();
                $resIdEstoque = $sqlSelecionaIdEstoque->get_result()->fetch_assoc();

                $idEstoque = $resIdEstoque['idtabestoque'];

                $sqlSelecionaIdMaterialProduto = $connect->prepare("SELECT tabmaterialproduto.idtabmaterialproduto FROM tabmaterialproduto WHERE tabmaterialproduto.idproduto = ? AND tabmaterialproduto.idmaterial = ?");
                $sqlSelecionaIdMaterialProduto->bind_param("ii", $idPed, $idMaterial);
                $sqlSelecionaIdMaterialProduto->execute();
                $resIdMaterialProduto = $sqlSelecionaIdMaterialProduto->get_result()->fetch_assoc();

                $idMaterialProduto = $resIdMaterialProduto['idtabmaterialproduto'];

                $sqlAtualizaEstoque = $connect->prepare("UPDATE tabestoque
                                                            INNER JOIN tabmaterialproduto ON tabmaterialproduto.idtabmaterialproduto = ?
                                                            INNER JOIN tabmaterial ON tabmaterial.idmaterial = ?
                                                        SET tabestoque.mm2 = tabestoque.mm2 - ?
                                                            WHERE tabestoque.idtabestoque = ?");
                $sqlAtualizaEstoque->bind_param("iiii", $idMaterialProduto, $idMaterial, $qtdMaterial, $idEstoque);
                $sqlAtualizaEstoque->execute();

                // echo json_encode(array($idMaterial, $idPed, $idMaterial, $qtdMaterial, $qtdPedido, $peso, $sapMaterial));

                // if($sqlAtualizaEstoque->affected_rows <= 0){
                //     echo json_encode(array($idPed, $idMaterial, $idMaterial, $qtdMaterial, $qtdPedido, $qtdPedido, $sapMaterial));
                //     break;
                // }

                $sqlRegistraMovimentacao = $connect->prepare("INSERT INTO tabmovimentacaoestoque (SAP_material, tipo_movimentacao, mm2, data) VALUES (?, 2, ?, NOW())");
                $sqlRegistraMovimentacao->bind_param("si", $sapMaterial, $qtdMaterial);
                $sqlRegistraMovimentacao->execute();

                if($sqlRegistraMovimentacao->affected_rows <= 0){
                    echo json_encode(array("cod" => 0, "erro" =>$connect->error, "op" => 4));
                    break;
                }
            }

            //INSERE O PEDIDO NA FILA DE PEDIDOS
            $inserePedido = $connect->prepare("INSERT INTO tabpedidos_dia (id_pedido, data, peso, tempo, emergencial) VALUES ($id, '$data', $peso, '$tempoPedido', '$emergencial')");
            $inserePedido->execute();

            if($inserePedido->affected_rows > 0){
                include_once "../insert/turno-maquina.php";
                include_once "ordenaPedidos.php";

                echo json_encode(array("cod" => 1));
            }
        }else{
            echo json_encode(array("cod" => 0, "erro" => $connect->error, "op" => 5));
        }
    }else{
        echo json_encode(array("cod" => 0, "erro" => $connect->error, "op" => 6));
    }


    
?>