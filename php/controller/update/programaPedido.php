<?php
    include_once '../../config/conexao.php';

    $idPed = $_POST['pedido'];
    $tempo = $_POST['tempo_pedido'];
    $tempo_unt = $_POST['tempo_unt'];

    $atualizaTabPedido = $connect->prepare("UPDATE tabpedido SET statuspedido = 6, tempo = ?, tempo_unt = ? WHERE tabpedido.idpedido = ?");
    $atualizaTabPedido->bind_param("ssi", $tempo, $tempo_unt, $idPed);
    $atualizaTabPedido->execute();

    if($atualizaTabPedido->affected_rows > 0){

        foreach($_POST['processo'] as $processo){
            $idProcesso = $processo['id'];
            $tempoProcesso = $processo['tempo'];
            $qtdProcesso = $processo['qtd'];
            $funcProcesso = $processo['funcionarios'];
    
            $sqlCadastraProcessosProduto = $connect->prepare("INSERT INTO tabprocessosproduto (idproduto, idprocesso, vezes, funcionarios, tempo) VALUES (?, ?, ?, ?, ?)");
            $sqlCadastraProcessosProduto->bind_param('sssss', $idPed, $idProcesso, $qtdProcesso, $funcProcesso, $tempoProcesso);
            $sqlCadastraProcessosProduto->execute();
    
            if($sqlCadastraProcessosProduto->affected_rows <= 0){
                echo json_encode(array("cod" => 0, "erro" => $connect->error));
            }
        }

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
            $sqlSelecionaMateriais->bind_param("i", $idProd);
            $sqlSelecionaMateriais->execute();

            $resultMateriais = $sqlSelecionaMateriais->get_result();

            while($resMateriais = $resultMateriais->fetch_assoc()){

                $idMaterial = $resMateriais['idmaterial'];
                $sapMaterial = $resMateriais['codigo_SAP'];
                $peso = $resMateriais['peso_KG'];
                

                $sqlAtualizaEstoque = $connect->prepare("UPDATE tabestoque 
                                                            INNER JOIN tabmaterialproduto ON tabmaterialproduto.idproduto = ? 
                                                            INNER JOIN tabmaterial ON tabmaterial.idmaterial = ? AND tabmaterialproduto.idmaterial = ? 
                                                        SET tabestoque.quantidade = tabestoque.quantidade - (tabmaterialproduto.quantidadematerial * ?), tabestoque.KG = tabestoque.KG - (? *?)
                                                            WHERE tabestoque.SAP_material = tabmaterial.codigo_SAP");
                $sqlAtualizaEstoque->bind_param("iiiidi", $idProd, $idMaterial, $idMaterial, $qtdPedido, $peso, $qtdPedido);
                $sqlAtualizaEstoque->execute();

                if($sqlAtualizaEstoque->affected_rows <= 0){

                    $sqlRegistraMovimentacao = $connect->prepare("INSERT INTO tabmovimentacaoestoque (SAP_material, tipo_movimentacao, quantidade, data, KG) VALUES (?, 2, ?, NOW(), ?)");
                    echo json_encode(array("cod" => 0, "erro" =>$connect->error));
                    break;
                }
            }

            //INSERE O PEDIDO NA FILA DE PEDIDOS
            $inserePedido = $connect->prepare("INSERT INTO tabpedidos_dia (id_pedido, data, peso, tempo, emergencial) VALUES ($id, '$data', $peso, '$tempoPedido', '$emergencial')");
            $inserePedido->execute();

            if($inserePedido->affected_rows > 0){
                include_once "ordenaPedidos.php";

                echo json_encode(array("cod" => 1));
            }
        }else{
            echo json_encode(array("cod" => 0, "erro" => $connect->error));
        }
    }else{
        echo json_encode(array("cod" => 0, "erro" => $connect->error));
    }


    
?>