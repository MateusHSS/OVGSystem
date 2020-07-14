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

    //INSTANCIA O PDF
    $pdf = new FPDF("P");
    $pdf->setTitle("Movimentação por período", 1);

    //INICIALIZA O PDF COM A PRIMEIRA PAGINA
    $pdf->AddPage();

    //DEFINE O NOME DO ARQUIVO
    $arquivo = "movim_".$inicio."_".$fim.".pdf";

    $fonte = "Arial";
    $style = "B";
    $border = 1;
    $alinhaC = "C";
    $alinhaL = "L";

    $pdf->Image('../../../img/logo_fundo_branco.png', 10, 0, 30);
    $pdf->Ln(40);
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Text(45, 15, $codifica->tratarCaracter("MOVIMENTAÇÃO DO ESTOQUE", 1));
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Text(95, 20, $codifica->tratarCaracter("OVGSystem", 1));
    
    $pdf->Ln(10);

    //DADOS DO RELATORIO
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Text(10, 40, $codifica->tratarCaracter("Período: ", 1));
    $pdf->SetFont('Arial', '', 15);
    $pdf->Text(32, 40, $codifica->tratarCaracter($inicio." - ". $fim, 1));
    $pdf->SetY(50);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 12, "Data e hora", 1, 0, "C");
    $pdf->Cell(110, 6, "Material", 1, 0, "C");
    $pdf->SetXY($pdf->GetX()-110, $pdf->GetY()+6);
    $pdf->Cell(10, 6, "Id", 1, 0, "C");
    $pdf->Cell(20, 6, "SAP", 1, 0, "C");
    $pdf->Cell(80, 6, $codifica->tratarCaracter("Descrição", 1), 1, 0, "C");
    $pdf->SetXY($pdf->GetX(), $pdf->GetY()-6);
    $pdf->Cell(10, 12, "Qtd.", 1, 0, "C");
    $pdf->Cell(15, 12, "Kg", 1, 0, "C");
    $pdf->Cell(20, 12, $codifica->tratarCaracter("Movim.", 1), 1, 1, "C");

    foreach($dados->movimentacao_periodo($inicio, $fim) as $result){
        $pdf->SetFont($fonte, '', 7);
        $pdf->Cell(30, 5, $result['data'], $border, 0, $alinhaC);
        $pdf->Cell(10, 5, $result['idmaterial'], $border, 0, $alinhaC);
        $pdf->Cell(20, 5, $result['codigo_SAP'], $border, 0, $alinhaC);
        $pdf->Cell(80, 5, $codifica->tratarCaracter($result['nomematerial'], 1), $border, 0, $alinhaC);
        $pdf->Cell(10, 5, $result['quantidade'], $border, 0, $alinhaC);
        $pdf->Cell(15, 5, $result['KG'], $border, 0, $alinhaC);
        $pdf->Cell(20, 5, $result['descricao'], $border, 1, $alinhaC);
    }

    //TIPO DE ABERTURA DO ARQUIVO
    $tipo_pdf = "I";

    //SAIDA DO PDF (NOME, MODO DE ABERTURA)
    $pdf->Output($arquivo, $tipo_pdf);
?>