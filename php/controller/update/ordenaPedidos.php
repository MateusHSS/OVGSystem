<?php 
set_time_limit(0);
include_once "../../config/conexao.php";

// MATEUS MARGOTTI

//datas para os próximos SQLs
date_default_timezone_set('America/Sao_Paulo');
$dataHoje = date('Y-m-d H:i:s');
$diaHoje = date('Y-m-d');
$horaHoje = date('H:i:s');

//atualiza os processos q n foram feitos para se escalonarem novamente da forma certa
$atualizaTabelas = $connect->prepare(
    "UPDATE tabprocessosproduto 
    SET idmaquina = NULL, pros_inicial = NULL, pros_final = NULL 
    WHERE pros_inicial >= '".$dataHoje."' and final_real is NULL"
);
$atualizaTabelas->execute();

//JUNTAR OS SUB PROCESSOS NO ORIGINAL
//subprocessos são os processos com mesmo idproduto, idprocesso
//eles são seperados quando o tempo em q ele acha pra se executar n é suficiente e precisa continuar depois

//sql para buscar os processos q n começaram e aux para n executar um deletado
$aux = 0;
$sql_processos = $connect->prepare(
    "SELECT idtabprocessosproduto, idproduto, idprocesso FROM tabprocessosproduto 
    WHERE finalizado = 0 AND (pros_inicial > '".$dataHoje."' OR pros_inicial IS NULL) 
    ORDER BY idproduto ASC, idprocesso ASC, idtabprocessosproduto ASC"
);
$sql_processos->execute();
$result_sql_processos = $sql_processos->get_result();

// roda todos os processos
while($pross = $result_sql_processos->fetch_assoc()){
    // se houver de juntar o aux vai receber uma quantidade para que
    // n rode o else nos processos q vão ser deletados
    if($aux > 0) {
        $aux--;
    }
    else {
        // sql q busca todos os subs do processo atual e armazenar em 3 dados
        // tempo total de hora, de minutos, e quant de subs
        $sql_subprocessos = $connect->prepare(
            "SELECT sum(tempoHoras), sum(tempoMinutos), count(*) FROM tabprocessosproduto 
            WHERE finalizado = 0 AND (pros_inicial > ? OR pros_inicial IS NULL) 
            AND idproduto = ? AND idprocesso = ? 
            ORDER BY idtabprocessosproduto ASC"
        );
        $sql_subprocessos->bind_param('sii', $dateaHoje, $pross["idproduto"], $pross["idprocesso"]);
        $sql_subprocessos->execute();

        $result_sql_subprocessos = $sql_subprocessos->get_result();
        $resultSomas = $result_sql_subprocessos->fetch_array();
        $quant_subprocessos = $resultSomas[2];

        //se tiver algum...
        if($quant_subprocessos > 1){
            // faz a string do campo tempo e concerta a soma dos minutos
            $horas = $resultSomas[0] + floor($resultSomas[1]/60);
            $minutos = $resultSomas[1] % 60;
            $tempo = $horas.":".$minutos.":00";

            // atualiza a raiz com o tempo total
            $sql_update_subprocesso_raiz = $connect->prepare(
                "UPDATE tabprocessosproduto 
                SET tempo = ?, tempoHoras = ?, tempoMinutos = ? 
                WHERE idtabprocessosproduto = ?"
            );
            $sql_update_subprocesso_raiz->bind_param('siii', $tempo, $horas, $minutos, $pross["idtabprocessosproduto"]);
            $sql_update_subprocesso_raiz->execute();

            // deleta os outros
            $sql_delete_subs = $connect->prepare(
                "DELETE FROM tabprocessosproduto 
                WHERE finalizado = 0 AND (pros_inicial > ? OR pros_inicial IS NULL) 
                AND idproduto = ? AND idprocesso = ? AND idtabprocessosproduto != ?"
            );
            $sql_delete_subs->bind_param('siii', $dataHoje, $pross["idproduto"], $pross["idprocesso"], $pross["idtabprocessosproduto"]);
            $sql_delete_subs->execute();

            $aux = $quant_subprocessos - 1;
        }
    }
}

//ENTRADA DE EMERGENCIAL
//sql q verifica se tem um emergencial q acabou de chegar
$sql_emergencial_existe = mysqli_query($connect, 
    "SELECT idtabpedidos_dia FROM tabpedidos_dia 
    WHERE emergencial = 2 AND data_inicial IS NULL AND 
    ordem IS NULL LIMIT 1"
);
$emergencial_existe = mysqli_num_rows($sql_emergencial_existe);
if($emergencial_existe > 0){

    //sql q verifica se estam em um turno em andamento
    $sql_turno_andamento = mysqli_query($connect, 
        "SELECT intervalo, hora_intervalo FROM tabhorariodiario 
        WHERE data = '".$diaHoje."' AND inicio <= '".$horaHoje."' AND fim >= '".$horaHoje."'
        LIMIT 1"
    );
    $turno_andamento = mysqli_fetch_array($sql_turno_andamento);
    if($turno_andamento != NULL){

        $final_intervalo = gmdate('H:i:s', strtotime($turno_andamento["hora_intervalo"]) + strtotime($turno_andamento["intervalo"]) - strtotime('03:00:00'));
        $final_intervalo_array = explode(':', $final_intervalo);
        $inicio_intervalo_array = explode(':', $turno_andamento["hora_intervalo"]);
        $horaHoje_array = explode(':', $horaHoje);
        $pedidos_alterados = "";

        //sql q pega todos os processos n emergenciais em andamento
        $sql_andamento = mysqli_query($connect, 
            "SELECT a.idtabprocessosproduto, a.idproduto, a.tempo, a.pros_inicial, a.pros_final 
            FROM tabprocessosproduto as a, tabpedidos_dia as b 
            WHERE a.pros_inicial <= '".$dataHoje."' AND a.pros_final > '".$dataHoje."' 
            AND a.idproduto = b.id_pedido AND b.emergencial < 2"
        );
        while($processo_andamento = mysqli_fetch_assoc($sql_andamento)){
            $pedidos_alterados .= $processo_andamento["idproduto"].",";

            $pros_inicial_array = explode(':', strstr($processo_andamento["pros_inicial"], " "));
            $pros_final_array = explode(':', strstr($processo_andamento["pros_final"], " "));
            $tempo_process_array = explode(':', $processo_andamento["tempo"]);

            //condições para ver em q parte do intervalo esta durante/antes/depois
            if($turno_andamento["hora_intervalo"] <= $horaHoje AND $final_intervalo >= $horaHoje){
                $tempo_restante = $pros_final_array[1] - $final_intervalo_array[1] < 0 ?
                    ($pros_final_array[0] - 1 - $final_intervalo_array[0]).":"
                    .($pros_final_array[1] + 60 - $final_intervalo_array[1]).":0"
                    : ($pros_final_array[0] - $final_intervalo_array[0]).":"
                    .($pros_final_array[1] - $final_intervalo_array[1]).":0"
                ;
            }
            elseif($horaHoje <= $turno_andamento["hora_intervalo"]){
                $tempo_passado = $horaHoje_array[1] - $pros_inicial_array[1] < 0 ?
                    ($horaHoje_array[0] - 1 - $pros_inicial_array[0]).":"
                    .($horaHoje_array[1] + 60 - $pros_inicial_array[1]).":0"
                    : ($horaHoje_array[0] - $pros_inicial_array[0]).":"
                    .($horaHoje_array[1] - $pros_inicial_array[1]).":0"
                ;
                $tempo_passado_array = explode(':', $tempo_passado);
                $tempo_restante = $tempo_process_array[1] - $tempo_passado_array[1] < 0 ?
                    ($tempo_process_array[0] - 1 - $tempo_passado_array[0]).":"
                    .($tempo_process_array[1] + 60 - $tempo_passado_array[1]).":0"
                    : ($tempo_process_array[0] - $tempo_passado_array[0]).":"
                    .($tempo_process_array[1] - $tempo_passado_array[1]).":0"
                ;
            }
            elseif($horaHoje >= $final_intervalo){
                $tempo_restante = $pros_final_array[1] - $horaHoje_array[1] < 0 ?
                    ($pros_final_array[0] - 1 - $horaHoje_array[0]).":"
                    .($pros_final_array[1] + 60 - $horaHoje_array[1]).":0"
                    : ($pros_final_array[0] - $horaHoje_array[0]).":"
                    .($pros_final_array[1] - $horaHoje_array[1]).":0"
                ;
            }
            $tempo_restante_array = explode(':', $tempo_restante);

            //realiza update 
            //para os processos q estavam em andamento e os atualizam com o tempo restante e emergencial = 1

            $sql_update_andamento = $connect->prepare(
                "UPDATE tabprocessosproduto 
                SET tempo = '".$tempo_restante."', escalonado = 0, pros_inicial = NULL, 
                pros_final = NULL, tempoHoras = '".$tempo_restante_array[0]."', 
                tempoMinutos = '".$tempo_restante_array[1]."' 
                WHERE idtabprocessosproduto = ".$processo_andamento["idtabprocessosproduto"]
            );
            $sql_update_andamento->execute();
        }
        if($pedidos_alterados != "") {
            $pedidos_alterados = substr($pedidos_alterados, 0, -1);
            $sql_update_andamento_emer = $connect->prepare(
                "UPDATE tabpedidos_dia SET emergencial = 1 
                WHERE id_pedido in (".$pedidos_alterados.")"
            );
            $sql_update_andamento_emer->execute();
        }
        
    }
}

//ORDENAÇÃO
//ordena todos os pedidos de acordo com o peso e da a ordenação para os processos
//sql q pega todos os pedidos pelo a prioridade exigida
$aux=0;
$sql = mysqli_query($connect, 
    "SELECT * FROM tabpedidos_dia WHERE data_final > '".$dataHoje."' 
    OR data_final is null OR data_final = '0000-00-00 00:00:00' 
    order by emergencial DESC, peso DESC, data ASC"
);
while($dado = mysqli_fetch_assoc($sql)){

    //da a ordem para os pedidos e seus respectivos processos
    $aux++;
    $atualizaOrdem = $connect->prepare(
        "UPDATE tabpedidos_dia SET ordem = '".$aux."' 
        WHERE idtabpedidos_dia = ".$dado['idtabpedidos_dia']
    );
    $atualizaOrdem->execute();

    $atualizaOrdem2 = $connect->prepare(
        "UPDATE tabprocessosproduto SET ordem = '".$aux."', escalonado = 0 
        WHERE idproduto = ".$dado['id_pedido']." AND finalizado = 0 AND
        (pros_inicial > '".$dataHoje."' OR pros_inicial IS NULL)"
    );
    $atualizaOrdem2->execute();
}

// É AQUI Q ROLA O ESCALONAMENTO DOS PROCESSOS

//sql q pega todos os turnos
$sql_turnos = $connect->prepare(
    "SELECT * FROM tabhorariodiario 
    WHERE (fim > ? AND data = ?) OR (data > ?) 
    ORDER BY data ASC, inicio ASC"
);
$sql_turnos->bind_param("sss", $horaHoje, $diaHoje, $diaHoje);
$sql_turnos->execute();
$result_sql_turnos = $sql_turnos->get_result();

// saber se o processo foi dividido e buscar algum lugar no turno q ele aida caiba
$dividiu_processo = FALSE;
$escalonou = TRUE;

$cont_teste1 = 1;
$cont_teste2 = 1;

while($turno = $result_sql_turnos->fetch_assoc()){

    // se n tiver escalonado nenhum no ultimo turno, verifica se tem processo ainda
    // nao escalonado, se n tiver ele encerra
    if(!$escalonou) {
        $sql_verifica_precisa_continuar = $connect->prepare(
            "SELECT idtabprocessosproduto FROM tabprocessosproduto WHERE escalonado = 0"
        );
        $sql_verifica_precisa_continuar->execute();
        $result_sql_verifica_precisa_continuar = $sql_verifica_precisa_continuar->get_result();
        if($result_sql_verifica_precisa_continuar->num_rows == 0) break;
    }
    $escalonou = FALSE;

    // select q busca as maquinas disponiveis no dia
    $sql_maquinas_disponiveis = $connect->prepare(
        "SELECT * FROM tabmaquinasdisponiveis WHERE data = '".$turno["data"]."' 
        ORDER BY idmaquina ASC"
    );
    $sql_maquinas_disponiveis->execute();
    
    $result_sql_maquinas_disponiveis = $sql_maquinas_disponiveis->get_result();

    $maquinas_disponiveis = [];
    $maquinas_disponiveis_id = [];

    // criando array para facilitar nos selects
    while($maquina = $result_sql_maquinas_disponiveis->fetch_assoc()) {
        array_push($maquinas_disponiveis, $maquina["idmaquina"]);
        array_push($maquinas_disponiveis_id, $maquina["idtabmaquinasdisponiveis"]);
    }

    $maquinas_disponiveis_string = implode(",", $maquinas_disponiveis);

    // se tiver alguma maquina disponivel no dia
    if($maquinas_disponiveis != []) {
        // select q busca os processos n escalonados com quantidade de funcionarios <=
        // a quantidade disponivel e q é do processo a qual se tem maquina
        $sql_processos_adequados = $connect->prepare(
            "SELECT * FROM tabprocessosproduto WHERE escalonado = 0 AND finalizado = 0
            AND idprocesso IN (".$maquinas_disponiveis_string.") 
            AND funcionarios <= ".$turno["funcionario_disponiveis"]." 
            ORDER BY ordem ASC, idprocesso ASC, idtabprocessosproduto ASC"
        );
        $sql_processos_adequados->execute();
        
        $result_sql_processos_adequados = $sql_processos_adequados->get_result();
        
        // roda todos os processos em busca de escalonamento
        while($processo = $result_sql_processos_adequados->fetch_assoc()){
            do{
                // cria variaveis uteis e depende se o processo foi dividido
                $tempoHoras = $dividiu_processo ? $novoHoras : $processo["tempoHoras"];
                $tempoMinutos = $dividiu_processo ? $novoMinutos : $processo["tempoMinutos"];
                $id = $dividiu_processo ? $novoId : $processo["idtabprocessosproduto"];
                // declara falso pra n rodar o do while
                $dividiu_processo = FALSE;

                // mais uteis, podem n depende do processo ser dividido
                $pedido = $processo["idproduto"];
                $maquina = $processo["idprocesso"];
                $funcionarios = $processo["funcionarios"];
                $final_turno = $turno['data']." ".$turno['fim'];
                $inicio_turno = $turno['data']." ".$turno['inicio'];

                // select q busca os processos escalonados no inicio do turno
                // para verificar se o processo pode ser escalonado no inicio
                $sql_verifica_inicio_ocupado = $connect->prepare(
                    "SELECT sum(funcionarios), SUM(IF(idprocesso = '".$maquina."', 1, 0)) 
                    as maquinaEmUso FROM tabprocessosproduto WHERE escalonado = 1 AND
                    pros_inicial = '".$inicio_turno."'"
                );
                $sql_verifica_inicio_ocupado->execute();
                $result_sql_verifica_inicio_ocupado = $sql_verifica_inicio_ocupado->get_result();
                $verifiva_inicio = $result_sql_verifica_inicio_ocupado->fetch_array();

                // verifica se naquele tempo tem algum processo q deva ser feito antes
                $sql_busca_processos_menores = $connect->prepare(
                    "SELECT COUNT(*) FROM tabprocessosproduto 
                    WHERE (escalonado = 0 AND idproduto = ? AND idprocesso < ?)
                    OR (escalonado = 1 AND idproduto = ? AND idprocesso < ? AND pros_final > ?)"
                );
                $sql_busca_processos_menores->bind_param("iiiis",
                    $pedido, $maquina, $pedido, $maquina, $inicio_turno
                );
                $sql_busca_processos_menores->execute();
                $result_sql_busca_processos_menores = $sql_busca_processos_menores->get_result();
                $busca_menor = $result_sql_busca_processos_menores->fetch_array();

                // se puder...
                if($turno["funcionario_disponiveis"] - $verifiva_inicio[0] >= $funcionarios 
                    AND $verifiva_inicio[1] == 0 AND $busca_menor[0] == 0) {
                    $inicio = $inicio_turno;
                }
                else {
                    // select q busca os processo escalonado e verifica se no seu fim
                    // tem a maquina necessaria disponivel e quant de funcionarios tbm
                    $sql_busca_inicio = $connect->prepare(
                        "SELECT pros_final FROM tabprocessosproduto as a WHERE pros_final < ? 
                        AND pros_final > ? AND escalonado = 1
                        AND ((SELECT sum(funcionarios) FROM tabprocessosproduto as b 
                            WHERE b.pros_inicial <= a.pros_final AND b.pros_final > a.pros_final) <= ? 
                            OR (SELECT sum(funcionarios) FROM tabprocessosproduto as b 
                            WHERE b.pros_inicial <= a.pros_final AND b.pros_final > a.pros_final) IS NULL)
                        AND (SELECT COUNT(*) FROM tabprocessosproduto as c 
                            WHERE c.pros_inicial <= a.pros_final AND c.pros_final > a.pros_final 
                            AND idprocesso = ?) < 1 
                        AND (SELECT COUNT(*) FROM tabprocessosproduto as d
                             WHERE d.escalonado = 0 AND d.idproduto = ? 
                             AND d.idprocesso < ?) = 0 
                        AND (SELECT COUNT(*) FROM tabprocessosproduto as e
                             WHERE e.escalonado = 1 AND e.idproduto = ? 
                             AND e.idprocesso < ? AND pros_final > a.pros_final ) = 0
                        ORDER BY pros_final LIMIT 1"
                    );

                    
                    $limite_funcionarios = $turno['funcionario_disponiveis'] - $funcionarios;
                    $sql_busca_inicio->bind_param("ssiiiiii", 
                        $final_turno, $inicio_turno, $limite_funcionarios, $maquina,
                        $pedido, $maquina, $pedido, $maquina
                    );
                    $sql_busca_inicio->execute();
                    $result_sql_busca_inicio = $sql_busca_inicio->get_result();
                    $busca_inicio = $result_sql_busca_inicio->fetch_array();

                    // se n tiver...
                    if($busca_inicio == NULL) break;

                    $inicio = $busca_inicio[0];
                }

                // select q busca um final onde a quant de funcionarios necessaria ou
                // a maquina n estão mais disponiveis
                $sql_busca_final = $connect->prepare(
                    "SELECT pros_inicial FROM tabprocessosproduto as a WHERE pros_inicial > ? 
                    AND pros_inicial < ? AND escalonado = 1
                    AND 
                    (
                        (SELECT sum(funcionarios) FROM tabprocessosproduto as b 
                        WHERE b.pros_inicial <= a.pros_inicial AND b.pros_final > a.pros_inicial) > ?
                        OR 
                        (
                            (SELECT COUNT(*) FROM tabprocessosproduto as c 
                            WHERE c.pros_inicial <= a.pros_inicial AND c.pros_final > a.pros_inicial 
                            AND idprocesso = ?) IS NOT NULL
                            AND (SELECT COUNT(*) FROM tabprocessosproduto as c 
                            WHERE c.pros_inicial <= a.pros_inicial AND c.pros_final > a.pros_inicial 
                            AND idprocesso = ?) > 0
                        )
                    ) 
                    ORDER BY pros_final LIMIT 1"
                );

                $sql_busca_final->bind_param("ssiii", 
                    $inicio, $final_turno, $limite_funcionarios, $maquina, $maquina
                );
                $sql_busca_final->execute();
                $result_sql_busca_final = $sql_busca_final->get_result();
                $busca_final = $result_sql_busca_final->fetch_array();

                // se n tiver o fim é o final do turno
                if($busca_final == NULL) $final = $final_turno;
                else $final = $busca_final[0];

                // aqui atualiza os processos e cria novos se necessario
                if($inicio != NULL AND $final != NULL) {
                    // var autoexplicativas para facilitar
                    $vezes = $processo["vezes"];
                    $ordem = $processo["ordem"];
                    $idMaquina = $maquinas_disponiveis_id[array_search($maquina, $maquinas_disponiveis)];

                    $horaIntervalo = $turno["hora_intervalo"];
                    $horaIntervalo_array = explode(':', $turno["hora_intervalo"]);
                    $tempoIntervalo_array = explode(':', $turno["intervalo"]);
                    $horaIntervaloInt = $horaIntervalo_array[0]*60 + $horaIntervalo_array[1];
                    $horaFinalIntervaloInt = $horaIntervaloInt + ($tempoIntervalo_array[0]*60 + $tempoIntervalo_array[1]);

                    $horaInicio = strstr($inicio, ' ');
                    $horaFinal = strstr($final, ' ');
                    $inicio_array = explode(':', $horaInicio);
                    $final_array = explode(':', $horaFinal);
                    $horaInicioInt = $inicio_array[0]*60 + $inicio_array[1];
                    $horaFinalInt = $final_array[0]*60 + $final_array[1];

                    $tempo_disponivel = ($final_array[0]*60 + $final_array[1]) - 
                        ($inicio_array[0]*60 + $inicio_array[1]);

                    // verifica se o inicio e fim estão entre o intervalo
                    if($horaInicioInt < $horaIntervaloInt AND $horaFinalInt > $horaIntervaloInt)
                        $tempo_disponivel -= ($tempoIntervalo_array[0]*60 + $tempoIntervalo_array[1]); 

                    // se o tempo disponivel for exatamente oq precisa...
                    if($tempo_disponivel == ($tempoHoras*60 + $tempoMinutos)) {
                        // atualiza o processo
                        $sql_update_processo = $connect->prepare(
                            "UPDATE tabprocessosproduto SET escalonado = 1, idmaquina = ?,
                            pros_inicial = ?, pros_final = ? 
                            WHERE idtabprocessosproduto = ? "
                        );
                        $sql_update_processo->bind_param("issi", 
                            $idMaquina, $inicio, $final, $id
                        );
                        $sql_update_processo->execute();

                        $escalonou = TRUE;
                        $dividiu_processo = FALSE;
                    }
                    // se for menor...
                    else if($tempo_disponivel < ($tempoHoras*60 + $tempoMinutos)) {
                        // atualiza o processo e cria outro com o tempo restante
                        $updateHoras = floor($tempo_disponivel/60);
                        $updateMinutos = $tempo_disponivel%60;
                        $updateTempo = (floor($tempo_disponivel/60)).":".($tempo_disponivel%60).":0";
                        
                        $sql_update_processo = $connect->prepare(
                            "UPDATE tabprocessosproduto SET escalonado = 1, idmaquina = ?,
                            pros_inicial = ?, pros_final = ?, tempoHoras = ?, tempoMinutos = ?,
                            tempo = ? WHERE idtabprocessosproduto = ? "
                        );
                        $sql_update_processo->bind_param("sssssss", 
                            $idMaquina, $inicio, $final, $updateHoras, $updateMinutos,
                            $updateTempo, $id
                        );
                        $sql_update_processo->execute();


                        $novoProcessoTempo = ($tempoHoras*60 + $tempoMinutos) - $tempo_disponivel; 
                        $novoTempo = (floor($novoProcessoTempo/60)).":".($novoProcessoTempo%60).":0";
                        $novoMinutos = $novoProcessoTempo%60;
                        $novoHoras = floor($novoProcessoTempo/60);
                        $sql_insert_subprocesso = $connect->prepare(
                            "INSERT INTO `tabprocessosproduto`
                            (`idproduto`, `idprocesso`, `vezes`, `funcionarios`, `tempo`, 
                            `tempoHoras`, `tempoMinutos`, `ordem`) 
                            VALUES (?,?,?,?,?,?,?,?)"
                        );
                        $sql_insert_subprocesso->bind_param('iiiisiii', 
                            $pedido, $maquina, $vezes, $funcionarios, $novoTempo, 
                            $novoHoras, $novoMinutos, $ordem
                        );
                        $sql_insert_subprocesso->execute();
                        $novoId = $connect->insert_id;

                        // para q possa rodar o do while e verificar se o novo cabe no turno
                        $dividiu_processo = TRUE;
                        $escalonou = TRUE;
                    }
                    // se for maior...
                    else {
                        // atualiza o final até quando ele precisa e depois atualiza processo
                        $tempoProcesso = $tempoHoras*60 + $tempoMinutos;
                        $tempoAMais = $tempo_disponivel - $tempoProcesso;
                        $finalInt = ($final_array[0]*60 + $final_array[1]) - $tempoAMais;

                        // verifiva se o final do processo e menor q o final do intervalo
                        // para reduzir o tempo do intervalo
                        if($finalInt < $horaFinalIntervaloInt) {
                            $finalInt -= ($tempoIntervalo_array[0]*60 + $tempoIntervalo_array[1]);
                        }
                        
                        $finalHora = (floor($finalInt/60)).":".($finalInt%60).":0";
                        $final = $turno["data"]." ".$finalHora;


                        $sql_update_processo = $connect->prepare(
                            "UPDATE tabprocessosproduto SET escalonado = 1, idmaquina = ?,
                            pros_inicial = ?, pros_final = ? 
                            WHERE idtabprocessosproduto = ? "
                        );
                        $sql_update_processo->bind_param("ssss", 
                            $idMaquina, $inicio, $final, $id
                        );
                        $sql_update_processo->execute();

                        $escalonou = TRUE;
                        $dividiu_processo = FALSE;
                    }
                }

                $inicio = NULL;
                $final = NULL;

            }while($dividiu_processo AND $escalonou);
        }
    }
}

//ATUALIZA DATA INICIAL E FINAL DOS PEDIDOS
//pesquisar todoas os pedidos q n estao em andamento
$sql_pedidos = mysqli_query($connect, "SELECT * FROM tabpedidos_dia");

//aqui realiza a parte de atualiza os dados dos pedidos com os horários certos - inicio e fim
while($pedido = mysqli_fetch_assoc($sql_pedidos)){

    //se o pedido n tiver iniciado ele atualiza o inicio e o fim
    if($pedido["data_inicial"]>$dataHoje OR $pedido["data_inicial"]==NULL OR $pedido["data_inicial"]=="0000-00-00 00:00:00"){
        
        //SQLs q pega a menor data inicial e maior data final entre os processos do pedido
        $sql_inicial = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE idproduto = ".$pedido['id_pedido']." ORDER BY pros_inicial ASC");
        $inicio = mysqli_fetch_array($sql_inicial);
        $sql_final = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE idproduto = ".$pedido['id_pedido']." ORDER BY pros_final DESC");
        $fim = mysqli_fetch_array($sql_final);

        if($inicio != NULL){
            if($inicio['pros_inicial'] == NULL){
                $sql_update_pedido = $connect->prepare("UPDATE `tabpedidos_dia` SET `data_inicial`='0000-00-00 00:00:00',`data_final`='0000-00-00 00:00:00' WHERE id_pedido = ".$pedido['id_pedido']);
                $sql_update_previsao_tabpedido = $connect->prepare("UPDATE tabpedido SET previsao = '0000-00-00 00:00:00' WHERE idpedido = ".$pedido['id_pedido']." AND statuspedido != 1");
            }
            else{
                $sql_update_pedido = $connect->prepare("UPDATE `tabpedidos_dia` SET `data_inicial`='".$inicio['pros_inicial']."',`data_final`='".$fim['pros_final']."' WHERE id_pedido = ".$pedido['id_pedido']);
                $sql_update_previsao_tabpedido = $connect->prepare("UPDATE tabpedido SET previsao = '".$fim['pros_final']."' WHERE idpedido = ".$pedido['id_pedido']." AND statuspedido != 1");
            }

            //da um update com esse dados
            $sql_update_pedido->execute();
            $sql_update_previsao_tabpedido->execute();
        }
        
    }

    //se n atualiza só o final
    else{

        //SQL q pega a maior data final entre os processos do pedido
        $sql_inicial = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE idproduto = ".$pedido['id_pedido']." ORDER BY pros_inicial ASC");
        $inicio = mysqli_fetch_array($sql_inicial);
        $sql_final = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE idproduto = ".$pedido['id_pedido']." ORDER BY pros_final DESC");
        $fim = mysqli_fetch_array($sql_final);

        if($inicio != NULL){
            if($inicio['pros_inicial'] == NULL){
                $sql_update_pedido = $connect->prepare("UPDATE `tabpedidos_dia` SET `data_final`='0000-00-00 00:00:00' WHERE id_pedido = ".$pedido['id_pedido']);
                $sql_update_previsao_tabpedido = $connect->prepare("UPDATE tabpedido SET previsao = '0000-00-00 00:00:00' WHERE idpedido = ".$pedido['id_pedido']." AND statuspedido != 1");
            }
            else{
                $sql_update_pedido = $connect->prepare("UPDATE `tabpedidos_dia` SET `data_final`='".$fim['pros_final']."' WHERE id_pedido = ".$pedido['id_pedido']);
                $sql_update_previsao_tabpedido = $connect->prepare("UPDATE tabpedido SET previsao = '".$fim['pros_final']."' WHERE idpedido = ".$pedido['id_pedido']." AND statuspedido != 1");
            }

            //da um update com esse dado
            $sql_update_pedido->execute();
            $sql_update_previsao_tabpedido->execute();
        }
    }
}

?>