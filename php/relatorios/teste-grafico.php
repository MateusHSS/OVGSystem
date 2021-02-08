<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="chart_div"></div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
            ['Dale', 'Pedidos', { role: 'style' }],
            <?php
                include_once "../config/conexao.php";

                $sqlSelecionaEntregues = $connect->prepare("SELECT COUNT(*) AS entregues FROM tabpedido WHERE final_real >= '2020-07-01' AND final_real <= '2020-07-27'");
                $sqlSelecionaEntregues->execute();
                $resultEntregues = $sqlSelecionaEntregues->get_result();
                $resEntregues = $resultEntregues->fetch_assoc();

                $sqlSelecionaPrevistos = $connect->prepare("SELECT COUNT(*) AS previstos FROM tabpedido WHERE previsao >= '2020-07-01' AND previsao <= '2020-07-27'");
                $sqlSelecionaPrevistos->execute();
                $resultPrevistos = $sqlSelecionaPrevistos->get_result();
                $resPrevistos = $resultPrevistos->fetch_assoc();
                
                $diferenca = (int)$resPrevistos - (int)$resEntregues;
            ?>
            ['Previstos',  <?php echo $resPrevistos['previstos'] ?>, 'blue'],
            ['Entregues',  <?php echo $resEntregues['entregues'] ?>, 'green'],
            ['Diferença',  <?php echo $diferenca ?>, 'red']
            ]);

            var options = {
            title : 'Atividade grupo de pecas',
            vAxis: {title: 'Quantidade'},
            seriesType: 'bars',
            series: {5: {type: 'line'}}        };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>