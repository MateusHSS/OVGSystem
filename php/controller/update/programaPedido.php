<?php
    include_once '../../config/conexao.php';

    $idPed = $_POST['pedido'];
    $tempo = $_POST['tempo_pedido'];
    $tempo_unt = $_POST['tempo_unt'];

    //REGISTRA OS PROCESSOS QUE O PEDIDO PRECISA PARA SER FEITO
    $connect->begin_transaction(0, 'insere_processos');
    try{
        $errors = array();
        foreach($_POST['processo'] as $processo){
            $idProcesso = (int)$processo['id'];
            $tempoProcesso = $processo['tempo'];
            $tempoHoras = explode(":", $processo['tempo'])[0];
            $tempoMinutos = explode(":", $processo['tempo'])[1];
            $qtdProcesso = (int)$processo['qtd'];
            $funcProcesso = (int)$processo['funcionarios'];

            $sqlCadastraProcessosProduto = $connect->prepare("INSERT INTO tabprocessosproduto (idproduto, idprocesso, vezes, funcionarios, tempo, tempoHoras, tempoMinutos) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $sqlCadastraProcessosProduto->bind_param("iiiisss", $idPed, $idProcesso, $qtdProcesso, $funcProcesso, $tempoProcesso, $tempoHoras, $tempoMinutos);
            $sqlCadastraProcessosProduto->execute();
    
            if($sqlCadastraProcessosProduto->affected_rows <= 0){
                array_push($errors, $idProcesso);
            }
        }

        if(!empty($errors)){
            throw new Exception("Erro ao inserir processos do produto!");
        }

        $connect->commit(0, 'insere_processos');

    }catch(Exception $e){

        $connect->rollback(0, 'insere_processos');

        echo json_encode(array('cod' => 0, 'erro' => $e->getMessage()));
    }

    //SELECIONA OS DADOS DO PEDIDO
    try{
        $dadosPedido = $connect->prepare("SELECT tabpedido.*, tabatividade.peso + tabseguranca.peso AS pesoTotal 
                                        FROM tabpedido 
                                            INNER JOIN tabatividade ON tabatividade.idtabatividade = tabpedido.atividade
                                            INNER JOIN tabseguranca ON tabseguranca.idtabseguranca = tabpedido.seguranca
                                        WHERE idpedido = ?");
        $dadosPedido->bind_param("i", $idPed);
        $dadosPedido->execute();
        $resultDadosPedido = $dadosPedido->get_result();

        if($resultDadosPedido->num_rows <= 0){
            throw new Exception('Erro ao buscar dados do pedido');
        }
    }catch(Exception $e){
        echo json_encode(array('cod' => 0, 'erro' => $e->getMessage()));
    }

    $resDadosPedido = $resultDadosPedido->fetch_assoc();

    $id = $resDadosPedido['idpedido'];
    $idProd = $resDadosPedido['produtopedido'];
    $qtdPedido = $resDadosPedido['quantidadepedido'];
    $data = $resDadosPedido['datainclusao'];
    $peso = $resDadosPedido['pesoTotal'];
    $tempoPedido = $tempo;
    $emergencial = $resDadosPedido['emergencial'];


    //ATUALIZA O ESTOQUE
    try {
        $sqlSelecionaMateriais = $connect->prepare("SELECT tabmaterialproduto.*, tabmaterial.codigo_SAP, tabmaterial.peso_KG FROM tabmaterialproduto 
                                                        INNER JOIN tabmaterial ON tabmaterial.idmaterial = tabmaterialproduto.idmaterial
                                                    WHERE idproduto = ?");
        $sqlSelecionaMateriais->bind_param("i", $idProd);
        $sqlSelecionaMateriais->execute();
        $resultMateriais = $sqlSelecionaMateriais->get_result();

        if($resultMateriais->num_rows <= 0){
            throw new Exception("Erro ao encontrar os materiais do produto pedido!");
        }
        
    }catch(Exception $e){
        echo json_encode(array('cod' => 0, 'erro' => $e->getMessage()));
    }
    
    $connect->begin_transaction(0, 'atualiza_estoque');
    try{
        while($resMateriais = $resultMateriais->fetch_assoc()){
            $idMaterial = $resMateriais['idmaterial'];
            $sapMaterial = $resMateriais['codigo_SAP'];
            $qtdMaterial = (float)number_format(((float)$resMateriais['mm2'] * (float)$qtdPedido), 2, '.', '');
            
    
            if($qtdMaterial < 1){
                (float)$qtdMaterial = 1;
            }
            
            try{
                $sqlSelecionaIdEstoque = $connect->prepare("SELECT tabestoque.idtabestoque FROM tabestoque WHERE tabestoque.SAP_material = ?");
                $sqlSelecionaIdEstoque->bind_param("s", $sapMaterial);
                $sqlSelecionaIdEstoque->execute();
                $resIdEstoque = $sqlSelecionaIdEstoque->get_result();

                if($resIdEstoque->num_rows <= 0){
                    throw new Exception("Erro ao encontrar o ID do material com SAP: " .$sapMaterial);
                }

                $idEstoque = $resIdEstoque->fetch_row()[0];

            }catch(Exception $e){
                throw $e;
            }
            
            $sqlSelecionaIdMaterialProduto = $connect->prepare("SELECT tabmaterialproduto.idtabmaterialproduto FROM tabmaterialproduto WHERE tabmaterialproduto.idproduto = ? AND tabmaterialproduto.idmaterial = ?");
            $sqlSelecionaIdMaterialProduto->bind_param("ii", $idProd, $idMaterial);
            $sqlSelecionaIdMaterialProduto->execute();
            $resIdMaterialProduto = $sqlSelecionaIdMaterialProduto->get_result();
    
            $idMaterialProduto = $resIdMaterialProduto->fetch_row()[0];

            try{
                $sqlAtualizaEstoque = $connect->prepare("UPDATE tabestoque SET tabestoque.mm2 = tabestoque.mm2 - ? WHERE tabestoque.idtabestoque = ?");
                $sqlAtualizaEstoque->bind_param("di", $qtdMaterial, $idEstoque);
                $sqlAtualizaEstoque->execute();
                $sqlAtualizaEstoque->affected_rows;

                if($sqlAtualizaEstoque->affected_rows <= 0){
                    throw new Exception("Erro ao atualizar o estoque");
                }

                try{
                    $sqlRegistraMovimentacao = $connect->prepare("INSERT INTO tabmovimentacaoestoque (SAP_material, tipo_movimentacao, mm2, data, quantidade) VALUES (?, 2, ?, NOW(), ?)");
                    $sqlRegistraMovimentacao->bind_param("sds", $sapMaterial, $qtdMaterial, $qtdMaterial);
                    $sqlRegistraMovimentacao->execute();

                    if($sqlRegistraMovimentacao->affected_rows <= 0){
                        throw new Exception('Erro ao registrar movimentacao do estoque');
                    }
    
                }catch(Exception $e){
                    throw $e;
                }
    
            }catch(Exception $e){
                throw $e;
            }
        }

        $connect->commit(0, 'atualiza_estoque');
    }catch(Exception $e){
        $connect->rollback(0, 'atualiza_estoque');
        echo json_encode(array('cod' => 0, 'erro' => $e->getMessage()));
    }
    
    //INSERE O PEDIDO NA FILA DE PEDIDOS
    $connect->begin_transaction(0, 'insere_pedido_fila');
    try{
        $inserePedido = $connect->prepare("INSERT INTO tabpedidos_dia (id_pedido, data, peso, tempo, emergencial) VALUES (?, ?, ?, ?, ?)");
        $inserePedido->bind_param('isdsi', $id, $data, $peso, $tempoPedido, $emergencial);
        $inserePedido->execute();

        if($inserePedido->affected_rows <= 0){
            throw new Exception("Erro ao inserir pedido na fila");
        }

        $atualizaTabPedido = $connect->prepare("UPDATE tabpedido SET statuspedido = 6, tempo = ?, tempo_unt = ? WHERE tabpedido.idpedido = ?");
        $atualizaTabPedido->bind_param("ssi", $tempo, $tempo_unt, $idPed);
        $atualizaTabPedido->execute();
        
        if($atualizaTabPedido->affected_rows <= 0){
            throw new Exception("Erro ao atualizar status do pedido");
        }

        $connect->commit(0, 'insere_pedido_fila');

        
    }catch(Exception $e){
        $connect->rollback(0, 'insere_pedido_fila');

        echo json_encode(array('cod' => 0, 'erro' => $e->getMessage()));
    }

    //ORDENACAO DOS PEDIDOS CADASTRADOS
    try{
        include_once "../insert/turno-maquina.php";

        echo json_encode(array('cod' => 1));
        
    }catch(Exception $e){
        echo json_encode(array('cod' => 0, 'erro' => $e->getMessage()));
    }

    
?>