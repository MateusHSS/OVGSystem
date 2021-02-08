<?php

    class Estoque{

        function movimentacao_periodo($inicio, $fim){
            $dt_in = date('Y-m-d', strtotime(str_replace('/', '-', $inicio)));
            $dt_fim = date('Y-m-d', strtotime(str_replace('/', '-', $fim)));
            require_once "../../config/conexao.php";

            $sqlSelecionaTransacoes = $connect->prepare("SELECT tabmaterial.nomematerial, tabmaterial.idmaterial, tabmaterial.codigo_SAP, tabmovimentacaoestoque.quantidade, tabmovimentacaoestoque.KG, DATE_FORMAT(tabmovimentacaoestoque.data, '%d/%m/%Y %H:%i:%s') AS data, tabtipo_movimentacao_estoque.descricao FROM tabmovimentacaoestoque
                                                        INNER JOIN tabtipo_movimentacao_estoque ON tabtipo_movimentacao_estoque.idtabtipo_movimentacao_estoque = tabmovimentacaoestoque.tipo_movimentacao
                                                        INNER JOIN tabmaterial ON tabmaterial.codigo_SAP = tabmovimentacaoestoque.SAP_material
                                                        WHERE tabmovimentacaoestoque.data >= ? AND tabmovimentacaoestoque.data <= ? ORDER BY data");
            $sqlSelecionaTransacoes->bind_param("ss", $dt_in, $dt_fim);
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
            $dt_in = date('Y-m-d', strtotime(str_replace('/', '-', $inicio)));
            $dt_fim = date('Y-m-d', strtotime(str_replace('/', '-', $fim)));
            require_once "../../config/conexao.php";

            $sqlSelecionaQtdPrevistos = $connect->prepare("SELECT COUNT(tabpedido.previsao) AS previstos FROM tabpedido WHERE tabpedido.previsao >= ? AND tabpedido.previsao <= ?");
            $sqlSelecionaQtdPrevistos->bind_param("ss", $dt_in, $dt_fim);
            $sqlSelecionaQtdPrevistos->execute();
            $qtd_previstos = $sqlSelecionaQtdPrevistos->get_result()->fetch_assoc();

            $sqlSelecionaQtdEntregues = $connect->prepare("SELECT COUNT(tabpedido.final_real) AS entrega FROM tabpedido WHEREtabpedido.final_real >= ? AND tabpedido.final_real <= ?");
            $sqlSelecionaQtdEntregues->bind_param("ss", $dt_in, $dt_fim);
            $sqlSelecionaQtdEntregues->execute();
            $qtd_entregues = $sqlSelecionaQtdEntregues->get_result()->fetch_assoc();

            $sqlSelecionaEntregues = $connect->prepare("SELECT tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto, DATE_FORMAT(tabpedido.previsao, '%d/%m/%Y') AS previsao, DATE_FORMAT(tabpedido.final_real, '%d/%m/%Y') AS entrega FROM tabpedido
                                                            INNER JOIN tabcliente ON tabcliente.idcliente = tabpedido.clientepedido
                                                            INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido
                                                        WHERE tabpedido.final_real >= ? AND tabpedido.final_real <= ? AND tabpedido.statuspedido = 7");
            $sqlSelecionaEntregues->bind_param("ss", $dt_in, $dt_fim);
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

            $sqlSelecionaPedidosDia = $connect->prepare("SELECT tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto, tabpedido.altura, tabpedido.largura, tabatividade.descricao AS atividade, tabseguranca.descricao AS seguranca, DATE_FORMAT(tabpedido.datainclusao, '%d/%m/%Y') AS data_inclusao, datediff(tabpedido.final_real, tabpedido.previsao) AS tempo_gasto
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

        public function materiais_pedido($inicio, $fim)
        {
            $dt_in = date('Y-m-d', strtotime(str_replace('/', '-', $inicio)));
            $dt_fim = date('Y-m-d', strtotime(str_replace('/', '-', $fim)));
            require_once "../../config/conexao.php";


            $sqlSelecionaPedidos = $connect->prepare("SELECT tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto 
                                                        FROM tabpedido 
                                                    INNER JOIN tabcliente ON tabcliente.idcliente = tabpedido.clientepedido 
                                                    INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido
                                                        WHERE tabpedido.final_real >= ? AND tabpedido.final_real <= ?");
            $sqlSelecionaPedidos->bind_param("ss", $dt_in, $dt_fim);
            $sqlSelecionaPedidos->execute();

            $resultPedidos = $sqlSelecionaPedidos->get_result();

            $pedidos = array();
            while($resPedidos = $resultPedidos->fetch_assoc()){
                $idPedido = $resPedidos['idpedido'];

                $sqlSelecionaMateriaisPedido = $connect->prepare("SELECT tabmaterial_por_pedido.idmaterial, tabmaterial.codigo_SAP, tabmaterial.nomematerial, tabmaterial_por_pedido.mm2, FORMAT(tabmaterial_por_pedido.mm2 / tabmaterial.mm2, 1) AS qtd 
                                                                    FROM tabmaterial_por_pedido 
                                                                INNER JOIN tabmaterial ON tabmaterial_por_pedido.idmaterial = tabmaterial.idmaterial 
                                                                WHERE tabmaterial_por_pedido.idpedido = ?");
                $sqlSelecionaMateriaisPedido->bind_param("i", $idPedido);
                $sqlSelecionaMateriaisPedido->execute();

                $resultMateriaisPedido = $sqlSelecionaMateriaisPedido->get_result();

                $materiais = array();
                while($resMateriaisPedido = $resultMateriaisPedido->fetch_assoc()){
                  array_push($materiais, $resMateriaisPedido);
                }

                array_push($pedidos, array("pedido" => $resPedidos, "materiais" => $materiais));
            }
            return $pedidos;
        }
    }

?>