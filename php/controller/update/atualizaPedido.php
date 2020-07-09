<?php
    include_once "../../config/conexao.php";

    $id = $_POST['id'];
    $qtd = $_POST['qtd'];
    $dimensao = $_POST['dimensao'];
    $atividade = $_POST['atividade'];
    $seguranca = $_POST['seguranca'];

    

    if($_FILES['formulario_pedido']['name'] != ''){
        $nomeArq= $_FILES['formulario_pedido']['name'];
        $pastaArq= '../../formulariosPedidos/'.$_FILES['formulario_pedido']['name'];
        if(move_uploaded_file($_FILES['formulario_pedido']['tmp_name'], $pastaArq) ){

            //ATUALIZA A TABELA DO PEDIDO
            $sqlAtualizaTabPedido = $connect->prepare("UPDATE tabpedido SET quantidadepedido = ?, dimensaopedido = ?, atividade = ?, seguranca = ?, formulariopedido = ? WHERE idpedido = ?");
            $sqlAtualizaTabPedido->bind_param('ssssss', $qtd, $dimensao, $atividade, $seguranca, $nomeArq, $id);
            $sqlAtualizaTabPedido->execute();
    
            if($sqlAtualizaTabPedido->affected_rows > 0){
                //VERIFICA SE O PEDIDO JA HAVIA SIDO PROGRAMADO
                $sqlVerificaProgramacao = $connect->prepare("SELECT tabpedido.statuspedido, tabstatus.nomestatus FROM tabpedido INNER JOIN tabstatus ON tabstatus.idtabstatus = tabpedido.statuspedido WHERE tabpedido.idpedido = $id");
                $sqlVerificaProgramacao->execute();
                $status = $sqlVerificaProgramacao->get_result()->fetch_assoc();
    
                //SE O PEDIDO JA ESTIVER PROGRAMADO, REPROGRAMA DE ACORDO COM AS ATUALIZACOES
                if($status['nomestatus'] == 'PROGRAMADO'){
    
                    //SELECIONA O TEMPO INDIVIDUAL DE CADA PECA
                    $sqlTempoUnt = $connect->prepare("SELECT tabpedido.tempo_unt FROM tabpedido WHERE tabpedido.idpedido = $id");
                    $sqlTempoUnt->execute();
                    $tempo_unt = $sqlTempoUnt->get_result()->fetch_assoc();
    
                    //TRANSFORMA TEMPO EM SEGUNDOS E MULTIPLICA PELA QUANTIDADE DO PEDIDO
                    $tempoUnt = explode(":", $tempo_unt['tempo_unt']);
                    $tempoTotal = (intval($tempoUnt[0]) * 3600 + intval($tempoUnt[1]) * 60 + intval($tempoUnt[2])) * $qtd;
                    $auxTempo = intval($tempoTotal%3600);
                    $novoTempoTotal = intval($tempoTotal/3600) . ":" . intval($auxTempo/60) . ":" . intval($auxTempo%60);
    
                    //ATUALIZA TEMPO DO PEDIDO NA TABELA
                    $sqlAtualizaTempo = $connect->prepare("UPDATE tabpedido SET tempo = ? WHERE tabpedido.idpedido = ?");
                    $sqlAtualizaTempo->bind_param("si", $novoTempoTotal, $id);
                    $sqlAtualizaTempo->execute();
    
                    //SELECIONA PROCESSOS DO PEDIDO
                    $sqlProcessosPedido = $connect->prepare("SELECT tabprocesso.tempo, tabprocessosproduto.idproduto, tabprocessosproduto.vezes
                                                                FROM tabprocessosproduto 
                                                                    INNER JOIN tabprocesso ON tabprocesso.idtabprocesso = tabprocessosproduto.idprocesso 
                                                                WHERE tabprocesso.idtabprocesso 
                                                                    IN (SELECT tabprocessosproduto.idprocesso FROM tabprocessosproduto WHERE tabprocessosproduto.idproduto = ?)");
                    $sqlProcessosPedido->bind_param("i", $id);
                    $sqlProcessosPedido->execute();
    
                    $resultProcessosPedido = $sqlProcessosPedido->get_result();
    
                    if($resultProcessosPedido->num_rows > 0){
                        while($resProcessosPedido = $resultProcessosPedido->fetch_assoc()){
                            $tempoProcesso = explode(":", $resProcessosPedido['tempo']);
                            $tempoTotalProcesso = ((intval($tempoProcesso[0]) * 3600 + intval($tempoProcesso[1]) * 60 + intval($tempoProcesso[2])) * $qtd) * $resProcessosPedido['vezes'] ;
                            $auxTempoProcesso = intval($tempoTotalProcesso%3600);
                            $novoTempoTotalProcesso = intval($tempoTotalProcesso/3600) . ":" . intval($auxTempoProcesso/60) . ":" . intval($auxTempoProcesso%60);
    
                            //ATUALIZA O TEMPO QUE CADA PROCESSO LEVA PRA SER COMPLETADO
                            $sqlAtualizaTempoProcesso = $connect->prepare("UPDATE tabprocessosproduto SET tempo = ? WHERE idproduto = ?");
                            $sqlAtualizaTempoProcesso->bind_param("ss", $novoTempoTotalProcesso, $id);
                            $sqlAtualizaTempoProcesso->execute();
                            
                        }
    
                        //SELECIONA OS DADOS DO PEDIDO
                        $dadosPedido = $connect->prepare("SELECT tabpedido.*, tabatividade.peso + tabseguranca.peso AS pesoTotal 
                            FROM tabpedido 
                                INNER JOIN tabatividade ON tabatividade.idtabatividade = tabpedido.atividade
                                INNER JOIN tabseguranca ON tabseguranca.idtabseguranca = tabpedido.seguranca
                            WHERE idpedido = $id");
                        $dadosPedido->execute();
                        $resultDadosPedido = $dadosPedido->get_result();
                        $resDadosPedido = $resultDadosPedido->fetch_assoc();
    
                        $id = $resDadosPedido['idpedido'];
                        $data = $resDadosPedido['datainclusao'];
                        $peso = $resDadosPedido['pesoTotal'];
                        $tempoPedido = $resDadosPedido['tempo'];
    
                        //REMOVE O PEDIDO DA FILA PRA INSERIR ATUALIZADO
                        $sqlRemovePedido = $connect->prepare("DELETE FROM tabpedidos_dia WHERE id_pedido = $id");
                        $sqlRemovePedido->execute();
    
                        //INSERE O PEDIDO NA FILA DE PEDIDOS
                        $inserePedido = $connect->prepare("INSERT INTO tabpedidos_dia (id_pedido, data, peso, tempo) VALUES ($id, '$data', $peso, '$tempoPedido')");
                        $inserePedido->execute();
    
                        include_once "ordenaPedidos.php";
                    
                        echo json_encode(array("cod" => '1', "dados" => $_FILES['formulario_pedido']));
    
                    }else{
                        echo json_encode(array("cod" => '0', "dados" => $_FILES, "n" => "1"));
                    }
    
                }else{
                    echo json_encode(array("cod" => '1', "dados" => $_FILES['formulario_pedido'], "id" => $id));
                }
            }else{
                echo json_encode(array("cod" => '0', "dados" => $_FILES, "n" => "2", "erro" => $sqlAtualizaTabPedido->error));
            }
    
            
        }else{
            echo json_encode(array("cod" => '0', "dados" => $_FILES, "n" => "3"));
        }
    }else{
        //ATUALIZA A TABELA DO PEDIDO
        $sqlAtualizaTabPedido = $connect->prepare("UPDATE tabpedido SET quantidadepedido = ?, dimensaopedido = ?, atividade = ?, seguranca = ? WHERE idpedido = ?");
        $sqlAtualizaTabPedido->bind_param('sssss', $qtd, $dimensao, $atividade, $seguranca, $id);
        $sqlAtualizaTabPedido->execute();

        if($sqlAtualizaTabPedido->affected_rows > 0){
            //VERIFICA SE O PEDIDO JA HAVIA SIDO PROGRAMADO
            $sqlVerificaProgramacao = $connect->prepare("SELECT tabpedido.statuspedido, tabstatus.nomestatus FROM tabpedido INNER JOIN tabstatus ON tabstatus.idtabstatus = tabpedido.statuspedido WHERE tabpedido.idpedido = $id");
            $sqlVerificaProgramacao->execute();
            $status = $sqlVerificaProgramacao->get_result()->fetch_assoc();

            //SE O PEDIDO JA ESTIVER PROGRAMADO, REPROGRAMA DE ACORDO COM AS ATUALIZACOES
            if($status['nomestatus'] == 'PROGRAMADO'){

                //SELECIONA O TEMPO INDIVIDUAL DE CADA PECA
                $sqlTempoUnt = $connect->prepare("SELECT tabpedido.tempo_unt FROM tabpedido WHERE tabpedido.idpedido = $id");
                $sqlTempoUnt->execute();
                $tempo_unt = $sqlTempoUnt->get_result()->fetch_assoc();

                //TRANSFORMA TEMPO EM SEGUNDOS E MULTIPLICA PELA QUANTIDADE DO PEDIDO
                $tempoUnt = explode(":", $tempo_unt['tempo_unt']);
                $tempoTotal = (intval($tempoUnt[0]) * 3600 + intval($tempoUnt[1]) * 60 + intval($tempoUnt[2])) * $qtd;
                $auxTempo = intval($tempoTotal%3600);
                $novoTempoTotal = intval($tempoTotal/3600) . ":" . intval($auxTempo/60) . ":" . intval($auxTempo%60);

                //ATUALIZA TEMPO DO PEDIDO NA TABELA
                $sqlAtualizaTempo = $connect->prepare("UPDATE tabpedido SET tempo = ? WHERE tabpedido.idpedido = ?");
                $sqlAtualizaTempo->bind_param("si", $novoTempoTotal, $id);
                $sqlAtualizaTempo->execute();

                //SELECIONA PROCESSOS DO PEDIDO
                $sqlProcessosPedido = $connect->prepare("SELECT tabprocesso.tempo, tabprocessosproduto.idproduto, tabprocessosproduto.vezes
                                                            FROM tabprocessosproduto 
                                                                INNER JOIN tabprocesso ON tabprocesso.idtabprocesso = tabprocessosproduto.idprocesso 
                                                            WHERE tabprocesso.idtabprocesso 
                                                                IN (SELECT tabprocessosproduto.idprocesso FROM tabprocessosproduto WHERE tabprocessosproduto.idproduto = ?)");
                $sqlProcessosPedido->bind_param("i", $id);
                $sqlProcessosPedido->execute();

                $resultProcessosPedido = $sqlProcessosPedido->get_result();

                if($resultProcessosPedido->num_rows > 0){
                    while($resProcessosPedido = $resultProcessosPedido->fetch_assoc()){
                        $tempoProcesso = explode(":", $resProcessosPedido['tempo']);
                        $tempoTotalProcesso = ((intval($tempoProcesso[0]) * 3600 + intval($tempoProcesso[1]) * 60 + intval($tempoProcesso[2])) * $qtd) * $resProcessosPedido['vezes'] ;
                        $auxTempoProcesso = intval($tempoTotalProcesso%3600);
                        $novoTempoTotalProcesso = intval($tempoTotalProcesso/3600) . ":" . intval($auxTempoProcesso/60) . ":" . intval($auxTempoProcesso%60);

                        //ATUALIZA O TEMPO QUE CADA PROCESSO LEVA PRA SER COMPLETADO
                        $sqlAtualizaTempoProcesso = $connect->prepare("UPDATE tabprocessosproduto SET tempo = ? WHERE idproduto = ?");
                        $sqlAtualizaTempoProcesso->bind_param("ss", $novoTempoTotalProcesso, $id);
                        $sqlAtualizaTempoProcesso->execute();
                        
                    }

                    //SELECIONA OS DADOS DO PEDIDO
                    $dadosPedido = $connect->prepare("SELECT tabpedido.*, tabatividade.peso + tabseguranca.peso AS pesoTotal 
                        FROM tabpedido 
                            INNER JOIN tabatividade ON tabatividade.idtabatividade = tabpedido.atividade
                            INNER JOIN tabseguranca ON tabseguranca.idtabseguranca = tabpedido.seguranca
                        WHERE idpedido = $id");
                    $dadosPedido->execute();
                    $resultDadosPedido = $dadosPedido->get_result();
                    $resDadosPedido = $resultDadosPedido->fetch_assoc();

                    $id = $resDadosPedido['idpedido'];
                    $data = $resDadosPedido['datainclusao'];
                    $peso = $resDadosPedido['pesoTotal'];
                    $tempoPedido = $resDadosPedido['tempo'];

                    //REMOVE O PEDIDO DA FILA PRA INSERIR ATUALIZADO
                    $sqlRemovePedido = $connect->prepare("DELETE FROM tabpedidos_dia WHERE id_pedido = $id");
                    $sqlRemovePedido->execute();

                    //INSERE O PEDIDO NA FILA DE PEDIDOS
                    $inserePedido = $connect->prepare("INSERT INTO tabpedidos_dia (id_pedido, data, peso, tempo) VALUES ($id, '$data', $peso, '$tempoPedido')");
                    $inserePedido->execute();

                    include_once "ordenaPedidos.php";
                
                    echo json_encode(array("cod" => '1', "dados" => $_FILES['formulario_pedido']));

                }else{
                    echo json_encode(array("cod" => '0', "dados" => $_FILES, "n" => "4"));
                }

            }else{
                echo json_encode(array("cod" => '1', "dados" => $_FILES['formulario_pedido'], "id" => $id));
            }
        }else{
            echo json_encode(array("cod" => '0', "dados" => $_FILES, "n" => "5", "erro" => $sqlAtualizaTabPedido->error));
        }
    }

    

    

    

    

?>