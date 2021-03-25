<?php 

    include_once '../../config/conexao.php';

    // MATEUS MARGOTTI

    // Select dos processos q ainda n foram escalonados
    $sql_tempo_processos = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE escalonado = 0");
    $tempo_pro = 0;
    $dias = 0;

    // soma os tempos deles
    while($tempo = mysqli_fetch_assoc($sql_tempo_processos)){

        $horas = intval(strstr($tempo["tempo"], ':', true));
        if($horas > 23){
            $dias += ($horas/24)+1;
            $soma = '+'.$dias.' days';
            $tempo_pro =  strtotime($soma, strtotime($tempo_pro));
        }else{
            $tempo_pro += strtotime($tempo["tempo"]) - strtotime('00:00:00');
        }
    }

    // variavei 1-tempo em horas mais dias 2-só em horas até 24 3-número de dias somados+1
    $tempo_total = gmdate('d H:i:s', $tempo_pro);
    $tempo1 = gmdate('H:i:s', $tempo_pro);
    $dias = intval(strstr($tempo_total, ' ', true));

    // se n somar der pelo menos 1 dia ele multiplica para dar o valor só em horas
    if($dias>1){
        $tempo2 = $tempo1;
        $hour= ($dias-1)*24 + intval(strstr($tempo1, ':', true));
        $tempo1 = $hour.strstr($tempo1, ':');
    }

    // dividi esse valor em 7 para saber de quantos dias seram necessarios
    $quant_novos =  intval(intval(strstr($tempo1, ':', true))/7)+1;

    // descobre qual o ultimo processo realizado
    $sql_ultimo_processo = mysqli_query($connect, "SELECT * FROM tabprocessosproduto ORDER BY pros_final DESC");
    $ultimo = mysqli_fetch_array($sql_ultimo_processo);
    
    $hoje = date("Y-m-d");

    if($ultimo != null){
        $ultima_data = strstr($ultimo["pros_final"], " ", true);
    }
    else{
        $ultima_data = $hoje;
    }

    // verifica se tem algum turno q seja alem do dia atual
    $sql_quant_dias = mysqli_query($connect, "SELECT * FROM tabhorariodiario WHERE data >= '".$ultima_data."' and data > '".$hoje."' ORDER BY data DESC");
    $rows_horarios = mysqli_num_rows($sql_quant_dias);
    $ultimo_turno = mysqli_fetch_array($sql_quant_dias);

    // se houver ele é o ultimo turno, se n se torna o dia atual
    if($rows_horarios > 0){
        $ultima_data = $ultimo_turno["data"];
    }
    else{
        $ultima_data = $hoje;
    }

    // roda o número de dias q falta para completar o tempo, baseado na quantidade de dias necessarios
    // por quantidade de dias alem do dia atual
    for($aux = $rows_horarios; $aux <= $quant_novos; $aux++){

        // verifcação se o dia é fds
        $seguinte = date('Y-m-d', strtotime('+1 days', strtotime($ultima_data)));
        $dia_semana = date('w', strtotime($seguinte));
        
        if($dia_semana != 0 and $dia_semana != 6){

            // insere novo turno
            $dados = "'09:00:00', '17:00:00', '01:00:00', '12:00:00', '07:00:00', '".$seguinte."', '1', '4'";
            $sql_insert_h = $connect->prepare("INSERT INTO `tabhorariodiario`(`inicio`, `fim`, `intervalo`, `hora_intervalo`, `horas`, `data`, `turno`, `funcionario_disponiveis`) VALUES (".$dados.")");
            $sql_insert_h->execute();

            $sql_maquinas = mysqli_query($connect, "SELECT * FROM tabmaquinas");
        
            // e tambem insere suas máquinas
            while($maquina = mysqli_fetch_assoc($sql_maquinas)){
                $sql_insert_m = $connect->prepare("INSERT INTO `tabmaquinasdisponiveis`(data, idmaquina) VALUES (?,?)");
                $sql_insert_m->bind_param('ss', $seguinte, $maquina["idtabmaquinas"]);
                $sql_insert_m->execute();
            }
        }
        else{
            $aux--;
        }

        // passa para o dia seguinte para cadastrar
        $ultima_data = $seguinte;
    }

    // redireciona para a ordenação para q se ajuste as novas mudanças
    include_once '../update/ordenaPedidos.php';

?>