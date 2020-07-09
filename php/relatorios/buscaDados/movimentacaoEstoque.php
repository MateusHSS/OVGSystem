<?php
    Class Estoque{
        function transacoes($inicio, $fim){

            require_once "../config/conexao.php";

            $sqlSelecionaTransacoes = $connect->prepare("SELECT tabmaterial.nomematerial, tabmovimentacaoestoque.quantidade, tabmovimentacaoestoque.KG, DATE_FORMAT(tabmovimentacaoestoque.data, '%d/%m/%Y %H:%i:%s') AS data, tabtipo_movimentacao_estoque.descricao FROM tabmovimentacaoestoque
                                                        INNER JOIN tabtipo_movimentacao_estoque ON tabtipo_movimentacao_estoque.idtabtipo_movimentacao_estoque = tabmovimentacaoestoque.tipo_movimentacao
                                                        INNER JOIN tabmaterial ON tabmaterial.codigo_SAP = tabmovimentacaoestoque.SAP_material");
            $sqlSelecionaTransacoes->execute();
    
            $resultTransacoes = $sqlSelecionaTransacoes->get_result();

            while($resTransacoes = $resultTransacoes->fetch_assoc()){
                $found[] = $resTransacoes;
            }

            return $found;

            
        }
    }
?>