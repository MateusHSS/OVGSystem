<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    $inicio = $_POST['inicio'];
    $fim = $_POST['fim'];

    require_once "../../classes/fpdf182/fpdf.php";
    require_once "../buscaDados/dados.php";
    require_once "../../classes/codifica_utf8.php";

    $dados = new Estoque();

    $codifica = new Funcoes();
    $pedidos = $dados->materiais_pedido($inicio, $fim);

    //INSTANCIA O PDF
    $pdf = new FPDF("P");
    $pdf->setTitle("Materiais por pedido", 1);

    //INICIALIZA O PDF COM A PRIMEIRA PAGINA
    $pdf->AddPage();

    //DEFINE O NOME DO ARQUIVO
    $arquivo = "materiais_por_pedido.pdf";

    $fonte = "Arial";
    $style = "B";
    $border = 1;
    $alinhaC = "C";
    $alinhaL = "L";
    $pdf->SetAutoPageBreak(1, 5);

    $pdf->Image('../../../img/logo_fundo_branco.png', 10, 0, 30);
    $pdf->Ln(40);
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Text(60, 15, $codifica->tratarCaracter("MATERIAIS POR PEDIDO", 1));
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Text(95, 20, $codifica->tratarCaracter("OVGSystem", 1));
    
    $pdf->Ln(10);

    //DADOS DO RELATORIO
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Text(10, 40, $codifica->tratarCaracter("Data:", 1));
    $pdf->SetFont('Arial', '', 15);
    $pdf->Text(25, 40, $codifica->tratarCaracter($inicio.' a '. $fim, 1));
    $pdf->SetFont('Arial', 'B', 15);
    
    // $pdf->setX(1);
    // $pdf->Cell(10, 8, "Id", 1, 0, "C");
    // $pdf->Cell(65, 8, "Cliente", 1, 0, "C");
    // $pdf->Cell(73, 8, "Produto", 1, 0, "C");
    // $pdf->Cell(40, 8, $codifica->tratarCaracter("Dimensões", 1), 1, 0, "C");
    // $pdf->Cell(20, 8, $codifica->tratarCaracter("Dt. ped.", 1), 1, 1, "C");
    $pdf->setX(1);

    

    foreach($pedidos as $pedido){
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(208, 8, "Pedido", 1, 1, "C");
        $pdf->setX(1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 5, "Id", 1, 0, "C");
        $pdf->Cell(80, 5, "Cliente", 1, 0, "C");
        $pdf->Cell(118, 5, "Produto", 1, 1, "C");

        $pdf->setX(1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(10, 8, $codifica->tratarCaracter($pedido['pedido']['idpedido'], 1), 1, 0, "C");
        $pdf->Cell(80, 8, $codifica->tratarCaracter($pedido['pedido']['nomecliente'], 1), 1, 0, "C");
        $pdf->Cell(118, 8, $codifica->tratarCaracter($pedido['pedido']['nomeproduto'], 1), 1, 1, "C");

        $pdf->setX(1);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(208, 8, "Materiais", 1, 1, "C");

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->setX(1);
        $pdf->Cell(10, 5, "Id", 1, 0, "C");
        $pdf->Cell(30, 5, "SAP", 1, 0, "C");
        $pdf->Cell(110, 5, "Nome", 1, 0, "C");
        $pdf->Cell(40, 5, $codifica->tratarCaracter("mm²", 1), 1, 0, "C");
        $pdf->Cell(18, 5, "Qtd", 1, 1, "C");

        foreach($pedido['materiais'] as $material){
            $pdf->setX(1);
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(10, 8, $codifica->tratarCaracter($material['idmaterial'], 1), 1, 0, "C");
            $pdf->Cell(30, 8, $codifica->tratarCaracter($material['codigo_SAP'], 1), 1, 0, "C");
            $pdf->Cell(110, 8, $codifica->tratarCaracter($material['nomematerial'], 1), 1, 0, "C");
            $pdf->Cell(40, 8, $codifica->tratarCaracter($material['mm2'], 1), 1, 0, "C");

            if($material['qtd'] == 0 ){
                $pdf->Cell(18, 8, $codifica->tratarCaracter("0.1", 1), 1, 1, "C");
            }else{
                $pdf->Cell(18, 8, $codifica->tratarCaracter($material['qtd'], 1), 1, 1, "C");
            }
        }
        $pdf->SetXY(1, $pdf->GetY()+10);
    }

    //TIPO DE ABERTURA DO ARQUIVO
    $tipo_pdf = "I";

    //SAIDA DO PDF (NOME, MODO DE ABERTURA)
    $pdf->Output($arquivo, $tipo_pdf);
?>