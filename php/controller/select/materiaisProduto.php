<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    include_once '../../config/conexao.php';

    $id = $_POST['id'];

    $sqlSelecionaMateriaisProduto = $connect->prepare("SELECT tabmaterialproduto.*, tabmaterial.nomematerial FROM tabmaterialproduto
                                                            INNER JOIN tabmaterial ON tabmaterial.idmaterial = tabmaterialproduto.idmaterial
                                                        WHERE tabmaterialproduto.idproduto = ?");
    $sqlSelecionaMateriaisProduto->bind_param("i", $id);
    $sqlSelecionaMateriaisProduto->execute();

    $resultMateriaisProduto = $sqlSelecionaMateriaisProduto->get_result();

    $dados = array();

    while($resMateriaisProduto = $resultMateriaisProduto->fetch_assoc()){
        array_push($dados, $resMateriaisProduto);
    }

    echo json_encode($dados);

?>