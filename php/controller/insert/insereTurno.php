<?php
    include_once "../../config/conexao.php";

    $total = $_GET['prev'];
    $inicio = $_POST['hora_inicio_a'];
    $fim = $_POST['hora_fim_a'];
    $intervalo = $_POST['intervalo_a'];
    $turno = $_POST['turno'];
    $inicio_intervalo = $_POST['inicio_intervalo_a'];
    $funcionarios = $_POST['funcionarios'];
    $maquinas = $_GET['maq'];

    $maq = explode('-', $maquinas);

    $data = $_POST['data'];
    $DFm = explode("/",$data);
    $data = $DFm[2].'-'.$DFm[1].'-'.$DFm[0];

    $maqs = count($maq) - 1;

    $y = 1;

    while($y <= $maqs){
        $sqlMaquinas = $connect->prepare("INSERT INTO tabmaquinasdisponiveis(data, idmaquina) VALUES (?, ?)");
        $sqlMaquinas->bind_param("ss", $data, $maq[$y]);
        $sqlMaquinas->execute();
        
        $y++;
    }

    

    $sql = $connect->prepare("INSERT INTO tabhorariodiario (inicio, fim, intervalo, horas, data, turno, hora_intervalo, funcionario_disponiveis) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssiss", $inicio, $fim, $intervalo, $total, $data, $turno, $inicio_intervalo, $funcionarios);
    $sql->execute();

    if($sql->affected_rows > 0){
        include_once "../update/ordenaPedidos.php";
        
        $sql->close();
        echo "<script type'text/javascript'>alert('Turno cadastrado com sucesso!'); window.location.href = '../../consulta/turno.php';</script>";
    }else{
        $sql->close();
        echo $sql->error;
        echo 'oi';
        // echo "<script type'text/javascript'>alert('Erro ao cadastrar turno!'); window.location.href = '../../consulta/turno.php';</script>";
    }

?>