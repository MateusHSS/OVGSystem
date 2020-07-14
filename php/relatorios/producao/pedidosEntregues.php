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
    $pedidos = $dados->pedidos_entregues_periodo($inicio, $fim);

    //INSTANCIA O PDF
    $pdf = new FPDF("P");
    $pdf->setTitle("Pedidos previstos", 1);

    //INICIALIZA O PDF COM A PRIMEIRA PAGINA
    $pdf->AddPage();

    //DEFINE O NOME DO ARQUIVO
    $arquivo = "pedidos_previstos_".$inicio."-".$fim.".pdf";

    $fonte = "Arial";
    $style = "B";
    $border = 1;
    $alinhaC = "C";
    $alinhaL = "L";

    $pdf->Image('../../../img/logo_fundo_branco.png', 10, 0, 30);
    $pdf->Ln(40);
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Text(45, 15, $codifica->tratarCaracter("PEDIDOS PREVISTOS E ENTREGUES", 1));
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Text(95, 20, $codifica->tratarCaracter("OVGSystem", 1));
    
    $pdf->Ln(10);

    //DADOS DO RELATORIO
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Text(10, 40, $codifica->tratarCaracter("Período: ", 1));
    $pdf->SetFont('Arial', '', 15);
    $pdf->Text(32, 40, $codifica->tratarCaracter($inicio." - ". $fim, 1));
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Text(10, 50, $codifica->tratarCaracter("Previstos: ", 1));
    $pdf->SetFont('Arial', '', 15);
    $pdf->Text(36, 50, $pedidos['qtd_previstos']['previstos']);
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Text(10, 60, $codifica->tratarCaracter("Entregues: ", 1));
    $pdf->SetFont('Arial', '', 15);
    $pdf->Text(38, 60, $pedidos['qtd_entregues']['entrega']);
    

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(185, 12, "Pedidos entregues", 1, 1, "C");
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, 8, "Id", 1, 0, "C");
    $pdf->Cell(65, 8, "Cliente", 1, 0, "C");
    $pdf->Cell(70, 8, "Produto", 1, 0, "C");
    $pdf->Cell(20, 8, $codifica->tratarCaracter("Previsão ", 1), 1, 0, "C");
    $pdf->Cell(20, 8, "Entrega", 1, 1, "C");

    

    foreach($pedidos['entregues'] as $result){
        $pdf->SetFont($fonte, '', 7);
        $pdf->Cell(10, 5, $result['idpedido'], $border, 0, $alinhaC);
        $pdf->Cell(65, 5, $result['nomecliente'], $border, 0, $alinhaC);
        $pdf->Cell(70, 5, $codifica->tratarCaracter($result['nomeproduto'], 1), $border, 0, $alinhaC);
        $pdf->Cell(20, 5, $result['previsao'], $border, 0, $alinhaC);
        $pdf->Cell(20, 5, $result['entrega'], $border, 1, $alinhaC);
    }

    //TIPO DE ABERTURA DO ARQUIVO
    $tipo_pdf = "I";

    //SAIDA DO PDF (NOME, MODO DE ABERTURA)
    $pdf->Output($arquivo, $tipo_pdf);
?>