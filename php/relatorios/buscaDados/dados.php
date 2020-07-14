<?php

    class Estoque{

        function movimentacao_periodo($inicio, $fim){
            require_once "../../config/conexao.php";

            $sqlSelecionaTransacoes = $connect->prepare("SELECT tabmaterial.nomematerial, tabmaterial.idmaterial, tabmaterial.codigo_SAP, tabmovimentacaoestoque.quantidade, tabmovimentacaoestoque.KG, DATE_FORMAT(tabmovimentacaoestoque.data, '%d/%m/%Y %H:%i:%s') AS data, tabtipo_movimentacao_estoque.descricao FROM tabmovimentacaoestoque
                                                        INNER JOIN tabtipo_movimentacao_estoque ON tabtipo_movimentacao_estoque.idtabtipo_movimentacao_estoque = tabmovimentacaoestoque.tipo_movimentacao
                                                        INNER JOIN tabmaterial ON tabmaterial.codigo_SAP = tabmovimentacaoestoque.SAP_material
                                                        WHERE DATE_FORMAT(tabmovimentacaoestoque.data, '%d/%m/%Y') >= ? AND DATE_FORMAT(tabmovimentacaoestoque.data, '%d/%m/%Y') <= ? ORDER BY data");
            $sqlSelecionaTransacoes->bind_param("ss", $inicio, $fim);
            $sqlSelecionaTransacoes->execute();
    
            $resultTransacoes = $sqlSelecionaTransacoes->get_result();

            $dados = array();

            while($resTransacoes = $resultTransacoes->fetch_assoc()){
                array_push($dados, $resTransacoes);
            }

            return $dados;
        }

        function totais_data_atual(){
            require_once "../../config/conexao.php";

            $sqlSelecionaTotais = $connect->prepare("SELECT tabmaterial.idmaterial, tabmaterial.nomematerial, tabestoque.SAP_material, tabestoque.quantidade, tabestoque.KG FROM tabestoque
                                                        INNER JOIN tabmaterial ON tabmaterial.codigo_SAP = tabestoque.SAP_material
                                                    ORDER BY tabmaterial.idmaterial");
            $sqlSelecionaTotais->execute();
    
            $resultTotais = $sqlSelecionaTotais->get_result();

            $dados = array();

            while($resTotais = $resultTotais->fetch_assoc()){
                array_push($dados, $resTotais);
            }

            return $dados;
        }

        function pedidos_entregues_periodo($inicio, $fim){
            require_once "../../config/conexao.php";

            $sqlSelecionaQtdPrevistos = $connect->prepare("SELECT COUNT(tabpedido.previsao) AS previstos FROM tabpedido WHERE DATE_FORMAT(tabpedido.previsao, '%d/%m/%Y') >= ? AND DATE_FORMAT(tabpedido.previsao, '%d/%m/%Y') <= ?");
            $sqlSelecionaQtdPrevistos->bind_param("ss", $inicio, $fim);
            $sqlSelecionaQtdPrevistos->execute();
            $qtd_previstos = $sqlSelecionaQtdPrevistos->get_result()->fetch_assoc();

            $sqlSelecionaQtdEntregues = $connect->prepare("SELECT COUNT(tabpedido.final_real) AS entrega FROM tabpedido WHERE DATE_FORMAT(tabpedido.final_real, '%d/%m/%Y') >= ? AND DATE_FORMAT(tabpedido.final_real, '%d/%m/%Y') <= ?");
            $sqlSelecionaQtdEntregues->bind_param("ss", $inicio, $fim);
            $sqlSelecionaQtdEntregues->execute();
            $qtd_entregues = $sqlSelecionaQtdEntregues->get_result()->fetch_assoc();

            $sqlSelecionaEntregues = $connect->prepare("SELECT tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto, DATE_FORMAT(tabpedido.previsao, '%d/%m/%Y') AS previsao, DATE_FORMAT(tabpedido.final_real, '%d/%m/%Y') AS entrega FROM tabpedido
                                                            INNER JOIN tabcliente ON tabcliente.idcliente = tabpedido.clientepedido
                                                            INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido
                                                        WHERE DATE_FORMAT(tabpedido.final_real, '%d/%m/%Y') >= ? AND DATE_FORMAT(tabpedido.final_real, '%d/%m/%Y') <= ? AND tabpedido.statuspedido = 7");
            $sqlSelecionaEntregues->bind_param("ss", $inicio, $fim);
            $sqlSelecionaEntregues->execute();

            $resultEntregues = $sqlSelecionaEntregues->get_result();

            $entregues = array();

            while($resEntregues = $resultEntregues->fetch_assoc()){
                array_push($entregues, $resEntregues);
            }

            return array("qtd_previstos" => $qtd_previstos, "qtd_entregues" => $qtd_entregues, "entregues" => $entregues);
        }

        function pedidos_dia($data){
            require_once "../../config/conexao.php";

            $sqlSelecionaQtdPedidosDia = $connect->prepare("SELECT COUNT(*) AS total FROM tabpedido WHERE DATE_FORMAT(tabpedido.final_real, '%d/%m/%Y') = ?");
            $sqlSelecionaQtdPedidosDia->bind_param("s", $data);
            $sqlSelecionaQtdPedidosDia->execute();

            $qtdPedidosDia = $sqlSelecionaQtdPedidosDia->get_result()->fetch_assoc();

            $sqlSelecionaPedidosDia = $connect->prepare("SELECT tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto, tabpedido.dimensaopedido, tabatividade.descricao AS atividade, tabseguranca.descricao AS seguranca, DATE_FORMAT(tabpedido.datainclusao, '%d/%m/%Y') AS data_inclusao, datediff(tabpedido.final_real, tabpedido.previsao) AS tempo_gasto
                                                            FROM tabpedido 
                                                        INNER JOIN tabcliente ON tabcliente.idcliente = tabpedido.clientepedido
                                                        INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido
                                                        INNER JOIN tabatividade ON tabatividade.idtabatividade = tabpedido.atividade
                                                        INNER JOIN tabseguranca ON tabseguranca.idtabseguranca = tabpedido.seguranca
                                                            WHERE DATE_FORMAT(tabpedido.final_real, '%d/%m/%Y') = ?");
            $sqlSelecionaPedidosDia->bind_param("s", $data);
            $sqlSelecionaPedidosDia->execute();

            $resultPedidosDia = $sqlSelecionaPedidosDia->get_result();

            $pedidos = array();

            while($resPedidosDia = $resultPedidosDia->fetch_assoc()){
                array_push($pedidos, $resPedidosDia);
            }

            return array("qtd" => $qtdPedidosDia, "pedidos" => $pedidos);
        }
    }

?>