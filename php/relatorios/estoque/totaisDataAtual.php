<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    require_once "../../classes/fpdf182/fpdf.php";
    require_once "../buscaDados/dados.php";
    require_once "../../classes/codifica_utf8.php";

    $dados = new Estoque();

    $codifica = new Funcoes();

    //INSTANCIA O PDF
    $pdf = new FPDF("P");
    $pdf->setTitle("Saldo estoque", 1);

    //INICIALIZA O PDF COM A PRIMEIRA PAGINA
    $pdf->AddPage();

    $data = date('d/m/Y');

    //DEFINE O NOME DO ARQUIVO
    $arquivo = "estoque_".$data.".pdf";

    $fonte = "Arial";
    $style = "B";
    $border = 1;
    $alinhaC = "C";
    $alinhaL = "L";

    $pdf->Image('../../../img/logo_fundo_branco.png', 10, 0, 30);
    $pdf->Ln(40);
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Text(75, 15, $codifica->tratarCaracter("SALDO ESTOQUE", 1));
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Text(95, 20, $codifica->tratarCaracter("OVGSystem", 1));
    
    $pdf->Ln(10);

    //DADOS DO RELATORIO
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Text(10, 40, $codifica->tratarCaracter("Data: ", 1));
    $pdf->SetFont('Arial', '', 15);
    $pdf->Text(25, 40, $codifica->tratarCaracter($data, 1));

    $pdf->SetY(50);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, 10, "Id", 1, 0, "C");
    $pdf->Cell(20, 10, "SAP", 1, 0, "C");
    $pdf->Cell(110, 10, "Material", 1, 0, "C");
    $pdf->Cell(20, 10, "Qtd.", 1, 0, "C");
    $pdf->Cell(20, 10, "Kg.", 1, 1, "C");

    foreach($dados->totais_data_atual() as $result){
        $pdf->SetFont($fonte, '', 7);
        $pdf->Cell(20, 5, $result['idmaterial'], $border, 0, $alinhaC);
        $pdf->Cell(20, 5, $result['SAP_material'], $border, 0, $alinhaC);
        $pdf->Cell(110, 5, $codifica->tratarCaracter($result['nomematerial'], 1), $border, 0, $alinhaC);
        $pdf->Cell(20, 5, $result['quantidade'], $border, 0, $alinhaC);
        $pdf->Cell(20, 5, $result['KG'], $border, 1, $alinhaC);
    }

    //TIPO DE ABERTURA DO ARQUIVO
    $tipo_pdf = "I";

    //SAIDA DO PDF (NOME, MODO DE ABERTURA)
    $pdf->Output($arquivo, $tipo_pdf);
?>