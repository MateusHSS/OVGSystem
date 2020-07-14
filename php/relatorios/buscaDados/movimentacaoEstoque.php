<?php
    Class Estoque{
        function transacoes($inicio, $fim){

            require_once "../config/conexao.php";

            $sqlSelecionaTransacoes = $connect->prepare("SELECT tabmaterial.nomematerial, tabmaterial.idmaterial, tabmaterial.codigo_SAP, tabmovimentacaoestoque.quantidade, tabmovimentacaoestoque.KG, DATE_FORMAT(tabmovimentacaoestoque.data, '%d/%m/%Y %H:%i:%s') AS data, tabtipo_movimentacao_estoque.descricao FROM tabmovimentacaoestoque
                                                        INNER JOIN tabtipo_movimentacao_estoque ON tabtipo_movimentacao_estoque.idtabtipo_movimentacao_estoque = tabmovimentacaoestoque.tipo_movimentacao
                                                        INNER JOIN tabmaterial ON tabmaterial.codigo_SAP = tabmovimentacaoestoque.SAP_material
                                                        WHERE data > '$inicio' AND data <= '$fim' ORDER BY data");
            $sqlSelecionaTransacoes->execute();
    
            $resultTransacoes = $sqlSelecionaTransacoes->get_result();

            $dados = array();

            while($resTransacoes = $resultTransacoes->fetch_assoc()){
                array_push($dados, $resTransacoes);
            }

            return $dados;

            
        }
    }
?>