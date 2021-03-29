<?php 

    include_once '../../config/conexao.php';

    // MATEUS MARGOTTI

    $tempo_pro = 0;
    $dias = 0;

    try{
        // Select dos processos q ainda n foram escalonados
        $sql_tempo_processos = $connect->prepare("SELECT * FROM tabprocessosproduto WHERE escalonado = 0");
        $sql_tempo_processos->execute();
        $result_sql_tempo_processos = $sql_tempo_processos->get_result();

        if($result_sql_tempo_processos->num_rows <= 0){
            throw new Exception("Erro ao encontrar o tempo dos processos cadastrados");
        }

        // soma os tempos deles
        while($tempo = $result_sql_tempo_processos->fetch_assoc()){
            // Pega somente a quantidade de horas de cada pedido
            $horas = intval(strstr($tempo["tempo"], ':', true));

            // Verifica se o processo gasta 24 horas ou mais
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
        $horas_excedentes_processos = gmdate('H:i:s', $tempo_pro);
        $dias = intval(strstr($tempo_total, ' ', true));
        
        // se n somar der pelo menos 1 dia ele multiplica para dar o valor só em horas
        if($dias > 1){
            $tempo2 = $horas_excedentes_processos;
            // Calcula o tempo total em horas
            $dias_em_horas = ($dias-1) * 24;
            $total_horas = $dias_em_horas + intval(strstr($horas_excedentes_processos, ':', true));

            $horas_excedentes_processos = $total_horas.strstr($horas_excedentes_processos, ':');
        }

        // dividi esse valor em 7 para saber de quantos dias seram necessarios
        $quant_novos =  intval(intval(strstr($horas_excedentes_processos, ':', true))/7)+1;

        try {

            // descobre qual o ultimo processo realizado
            $sql_ultimo_processo = $connect->prepare("SELECT * FROM tabprocessosproduto WHERE finalizado != 1 ORDER BY pros_final DESC LIMIT 1");
            $sql_ultimo_processo->execute();
            $result_sql_ultimo_processo = $sql_ultimo_processo->get_result();

            if($result_sql_ultimo_processo->num_rows <= 0){
                throw new Exception('Erro ao encontrar ultimo processo realizado');
            }
        } catch (Exception $e) {
            throw $e;
        }
        
        $ultimo = $result_sql_ultimo_processo->fetch_assoc();
    
        $hoje = date("Y-m-d");
    
        if($ultimo != null){
            $ultima_data = strstr($ultimo["pros_final"], " ", true);
        }
        else{
            $ultima_data = $hoje;
        }
    
        // verifica se tem algum turno q seja alem do dia atual
        $sql_quant_dias = $connect->prepare("SELECT * FROM tabhorariodiario WHERE data >= '".$ultima_data."' and data > '".$hoje."' ORDER BY data DESC");
        $sql_quant_dias->execute();
        $result_sql_quant_dias = $sql_quant_dias->get_result();

        $rows_horarios = $result_sql_quant_dias->num_rows;

        $ultimo_turno = $result_sql_quant_dias->fetch_assoc();

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

                try {
                    $sql_insert_horario = $connect->prepare("INSERT INTO `tabhorariodiario`(`inicio`, `fim`, `intervalo`, `hora_intervalo`, `horas`, `data`, `turno`, `funcionario_disponiveis`) VALUES (".$dados.")");
                    $sql_insert_horario->execute();

                    if($sql_insert_horario->affected_rows <= 0){
                        throw new Exception("Erro ao cadastrar novo horario de trabalho");
                    }

                } catch (Exception $e) {
                    throw $e;
                }
                

                try {
                    $sql_maquinas = $connect->prepare("SELECT * FROM tabmaquinas");
                    $sql_maquinas->execute();
                    $result_sql_maquinas = $sql_maquinas->get_result();

                    if($result_sql_maquinas->num_rows <= 0){
                        throw new Exception("Erro ao buscar dados das maquinas disponiveis");
                    }

                    // e tambem insere suas máquinas
                    while($maquina = $result_sql_maquinas->fetch_assoc()){
                        $sql_insert_maquina = $connect->prepare("INSERT INTO `tabmaquinasdisponiveis`(data, idmaquina) VALUES (?,?)");
                        $sql_insert_maquina->bind_param('ss', $seguinte, $maquina["idtabmaquinas"]);
                        $sql_insert_maquina->execute();

                        if($sql_insert_maquina->affected_rows <= 0){
                            throw new Exception("Erro ao inserir disponibilidade de maquina cadastrada");
                        }
                    }
                } catch (Exception $e) {
                    throw $e;
                }
            }
            else{
                $aux--;
            }
            // passa para o dia seguinte para cadastrar
            $ultima_data = $seguinte;
        }

        try {
            // redireciona para a ordenação para q se ajuste as novas mudanças
            include_once '../update/ordenaPedidos.php';
        } catch (Exception $e) {
            throw $e;
        }
    }catch(Exception $e){
        throw $e;
    }

    

?>