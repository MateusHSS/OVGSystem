<?php 

    include_once '../../config/conexao.php';

    // MATEUS MARGOTTI

    try{
        // Select da soma do tempo dos processos q ainda n foram escalonados
        $sql_tempo_processos_nao_escalonados = $connect->prepare(
            "SELECT sum(tempoHoras*60 + tempoMinutos) FROM tabprocessosproduto WHERE escalonado = 0"
        );
        $sql_tempo_processos_nao_escalonados->execute();
        $result_tempo_processos_nao_escalonados = $sql_tempo_processos_nao_escalonados->get_result();
        $result = $result_tempo_processos_nao_escalonados->fetch_array();
        
        if($result_tempo_processos_nao_escalonados->num_rows <= 0){
            throw new Exception("Erro ao encontrar o tempo dos processos cadastrados");
        }

        // passa o resultado para o um numero de dias necessarios
        $quant_novos =  ceil(ceil($result["sum(tempoHoras*60 + tempoMinutos)"]/60)/7);

        try {

            // descobre qual o ultimo processo escalonado
            $sql_ultimo_processo = $connect->prepare(
                "SELECT * FROM tabprocessosproduto WHERE 
                finalizado = 0 and escalonado = 1 and pros_final is not NULL 
                ORDER BY pros_final DESC LIMIT 1
            ");

            $sql_ultimo_processo->execute();
            $result_sql_ultimo_processo = $sql_ultimo_processo->get_result();

            // so para saber se tem algum processo ja escalonado n finalizado
            $temProceso = $result_sql_ultimo_processo->num_rows > 0 ? true : false;

            if($result_sql_ultimo_processo->num_rows < 0){
                throw new Exception('Erro ao encontrar ultimo processo escalonado');
            }
        } catch (Exception $e) {
            throw $e;
        }
        
        $ultimo_proc_escalonado = $result_sql_ultimo_processo->fetch_array();
    
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date("Y-m-d");
    
        if($temProceso){
            $ultima_data = $ultimo_proc_escalonado["pros_final"] > $hoje 
            ? strstr($ultimo_proc_escalonado["pros_final"], " ", true) 
            : $hoje;
        }
        else{
            $ultima_data = $hoje;
        }
    
        // pega todos turnos sobrando = apartir o ultimo processo escalonado
        $sql_quant_turnos = $connect->prepare(
            "SELECT data FROM tabhorariodiario 
            WHERE data >= '".$ultima_data."' 
            ORDER BY data DESC"
        );

        $sql_quant_turnos->execute();
        $result_sql_quant_turnos = $sql_quant_turnos->get_result();

        $rows_horarios = $result_sql_quant_turnos->num_rows;

        // se houver ele é o ultimo turno, se n se torna o dia atual
        if($rows_horarios > 0){
            $ultimo_turno = $result_sql_quant_turnos->fetch_assoc();
            $ultima_data = $ultimo_turno["data"];
            $quant_turnos_sobra = $rows_horarios - 1;
        }
        else{
            $ultima_data = $hoje;
            $quant_turnos_sobra = 0;
        }

        // inicializa os strings vazias
        $dadosTurnos = "";
        $dadosMaquinas = "";

        // select com as maquinas existentes
        $sql_maquinas = $connect->prepare("SELECT * FROM tabmaquinas");
        $sql_maquinas->execute();
        $result_sql_maquinas = $sql_maquinas->get_result();

        // cria um array reutilizavel das maquinas
        $cont = 0;
        while($maquina = $result_sql_maquinas->fetch_assoc()){
            $maquinas[$cont++] = $maquina["idtabmaquinas"];
        }

        // roda o número de dias necessarios menos os q estao sobrando
        for($aux = $quant_turnos_sobra; $aux < $quant_novos; $aux++){

            // verifcação se o dia é fds
            $seguinte = date('Y-m-d', strtotime('+1 days', strtotime($ultima_data)));
            $dia_semana = date('w', strtotime($seguinte));
            
            if($dia_semana != 0 and $dia_semana != 6){

                // quantidade de vezes q o for roda, baseado em quantos dias
                // a semana ainda tem e na quantidade necesaria
                $quant_for = $quant_novos - $aux - $dia_semana + 1 < 5 
                    ? $quant_novos - $aux - $dia_semana + 1
                    : 5 - $dia_semana + 1;

                // add a quantidade q o for vai roda no principal
                $aux += $quant_for - 1;
                
                // roda de acordo com a semana gerando os values todos de uma vez
                // para rodar um insert pra cada tabela
                for($aux2 = 0; $aux2 < $quant_for; $aux2++) {
                    // values tabhorariodiario
                    $dadosTurnos .= "('09:00:00', '17:00:00', '01:00:00', '12:00:00', '07:00:00', '".$seguinte."', '1', '4'),";
                    foreach($maquinas as $maquina){
                        // values tabmaquinasdisponiveis
                        $dadosMaquinas .= "('".$seguinte."', '".$maquina."'),";
                    }

                    // atualiza o dia
                    $ultima_data = $seguinte;
                    $seguinte = date('Y-m-d', strtotime('+1 days', strtotime($ultima_data)));
                }

                // retira a virgula final da string caso n va mais add value
                if($aux+1 == $quant_novos){
                    $dadosTurnos = substr($dadosTurnos, 0, -1);
                    $dadosMaquinas = substr($dadosMaquinas, 0, -1);
                }

            }
            else{
                $aux--;
            }
            // passa para o dia seguinte para cadastrar
            $ultima_data = $seguinte;
        }
        
        // se for necessario add algum turno...
        if($dadosTurnos != ""){
            // insere todos os values de horario
            try {
                $sql_insert_horario = $connect->prepare("INSERT INTO `tabhorariodiario`(`inicio`, `fim`, `intervalo`, `hora_intervalo`, `horas`, `data`, `turno`, `funcionario_disponiveis`) VALUES ".$dadosTurnos);
                $sql_insert_horario->execute();

                if($sql_insert_horario->affected_rows <= 0){
                    throw new Exception("Erro ao cadastrar novo horario de trabalho");
                }

            } catch (Exception $e) {
                throw $e;
            }

            // e tambem insere suas máquinas
            try {
                $sql_insert_maquina = $connect->prepare("INSERT INTO `tabmaquinasdisponiveis`(data, idmaquina) VALUES ".$dadosMaquinas);
                $sql_insert_maquina->execute();

                if($sql_insert_maquina->affected_rows <= 0){
                    throw new Exception("Erro ao inserir disponibilidade de maquina cadastrada");
                }
            } catch (Exception $e) {
                throw $e;
            }
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