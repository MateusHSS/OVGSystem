<?php
    require_once "../classes/fpdf182/fpdf.php";
    require_once "buscaDados/movimentacaoEstoque.php";
    require_once "../classes/codifica_utf8.php";

    $dados = new Estoque();

    $codifica = new Funcoes();

    //INSTANCIA O PDF
    $pdf = new FPDF("P");
    $pdf->setTitle("Relatório 1", 1);

    //INICIALIZA O PDF COM A PRIMEIRA PAGINA
    $pdf->AddPage();

    //DEFINE O NOME DO ARQUIVO
    $arquivo = "relatorio_1.pdf";

    $fonte = "Arial";
    $style = "B";
    $border = 1;
    $alinhaC = "C";
    $alinhaL = "L";

    $pdf->Image('../../img/logo_fundo_branco.png', 10, 0, 30);
    $pdf->Ln(40);
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Text(50, 15, $codifica->tratarCaracter("MOVIMENTAÇÃO DO ESTOQUE", 1));
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(30, 10, "Data e hora", 1, 0, "C");
    $pdf->Cell(100, 10, "Material", 1, 0, "C");
    $pdf->Cell(15, 10, "QTD", 1, 0, "C");
    $pdf->Cell(15, 10, "KG", 1, 0, "C");
    $pdf->Cell(30, 10, $codifica->tratarCaracter("Movimentação", 1), 1, 1, "C");

    foreach($dados->transacoes("2020-07-05", "2020-07-07") as $result){
        $pdf->SetFont($fonte, '', 7);
        $pdf->Cell(30, 5, $result['data'], $border, 0, $alinhaC);
        $pdf->Cell(100, 5, $result['nomematerial'], $border, 0, $alinhaC);
        $pdf->Cell(15, 5, $result['quantidade'], $border, 0, $alinhaC);
        $pdf->Cell(15, 5, $result['KG'], $border, 0, $alinhaC);
        $pdf->Cell(30, 5, $result['descricao'], $border, 0, $alinhaC);
    }

    //TIPO DE ABERTURA DO ARQUIVO
    $tipo_pdf = "I";

    //SAIDA DO PDF (NOME, MODO DE ABERTURA)
    $pdf->Output($arquivo, $tipo_pdf);
?>