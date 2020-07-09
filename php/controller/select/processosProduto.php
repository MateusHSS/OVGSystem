<?php
    include_once "../../config/conexao.php";

    $produto = $_POST['produto'];
    $dados = array();

    $sqlSelecionaProduto = $connect->prepare("SELECT tabproduto.nomeproduto FROM tabpedido
                                                    INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido 
                                                WHERE tabpedido.idpedido = ?");
    $sqlSelecionaProduto->bind_param("i", $produto);
    $sqlSelecionaProduto->execute();
    $resultProduto = $sqlSelecionaProduto->get_result();

    $resProduto = $resultProduto->fetch_assoc();

    $nome = $resProduto['nomeproduto'];
    
    $sqlSelecionaProcessosProduto = $connect->prepare("SELECT tabprocessosproduto.idprocesso, tabprocessosproduto.finalizado, tabprocesso.descricao FROM tabprocessosproduto
                                                            INNER JOIN tabprocesso ON tabprocessosproduto.idprocesso = tabprocesso.idtabprocesso
                                                        WHERE tabprocessosproduto.idproduto = ? ORDER BY tabprocessosproduto.idprocesso ASC");
    $sqlSelecionaProcessosProduto->bind_param("i", $produto);
    $sqlSelecionaProcessosProduto->execute();

    $resultProcessosProduto = $sqlSelecionaProcessosProduto->get_result();

    foreach($resultProcessosProduto as $res){
        array_push($dados, $res);
    }

    echo json_encode(array("nome" => $nome, "pedido" => $produto, "processos" => $dados));

?>