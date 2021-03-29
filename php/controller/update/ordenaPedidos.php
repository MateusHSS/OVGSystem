<?php 
    set_time_limit(0);
    include_once "../../config/conexao.php";

    // MATEUS MARGOTTI

    //datas para os próximos SQLs
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i:s');
    date_default_timezone_set('America/Sao_Paulo');
    $date1 = date('Y-m-d');
    $hora = date('H:i:s');
    
    //atualiza os processos q n foram feitos para se escalonarem novamente da forma certa
    $atualizaTabelas = $connect->prepare("UPDATE tabprocessosproduto SET idmaquina = NULL, pros_inicial = NULL, pros_final = NULL WHERE pros_inicial >= '".$date."'");
    $atualizaTabelas->execute();
    
    //JUNTAR OS SUB PROCESSOS NO ORIGINAL
    //subprocessos são os processos na tabela bem semelhantes que possuem mesmo id_sub
    //eles são seperados quando o tempo em q ele acha pra se executar n é suficiente e precisa continuar depois
    
    //sql para buscar os processos q n começaram e aux para n repetir o processo com outro sub igual
    $id_aux = 0;
    $sql_processos = $connect->prepare("SELECT * FROM tabprocessosproduto WHERE finalizado != 1 AND (pros_inicial > ? OR pros_inicial IS NULL) ORDER BY idtabprocessosproduto");
    $sql_processos->bind_param('s', $date);
    $sql_processos->execute();
    $result_sql_processos = $sql_processos->get_result();
    
    while($pross = $result_sql_processos->fetch_assoc()){
        
        //cria uma busca pra ver se esse dado ainda existe
        $existencia = $connect->prepare("SELECT * FROM tabprocessosproduto WHERE idtabprocessosproduto = ".$pross['idtabprocessosproduto']);
        $existencia->execute();
        $result_existencia = $existencia->get_result();

        if($result_existencia->num_rows > 0){
            //sql q busca todos os subs do processo atual
            $sql_subprocessos = $connect->prepare("SELECT * FROM tabprocessosproduto WHERE (pros_inicial > ? OR pros_inicial IS NULL) 
                                                    AND idtabprocessosproduto != ? AND id_sub = ? AND  idproduto = ? AND idprocesso = ? 
                                                    ORDER BY idtabprocessosproduto ASC");
            $sql_subprocessos->bind_param('siiii', $date, $pross["idtabprocessosproduto"], $pross["id_sub"], $pross["idproduto"], $pross["idprocesso"]);
            $sql_subprocessos->execute();
            $result_sql_subprocessos = $sql_subprocessos->get_result();
            
            //se tiver algum...
            if($result_sql_subprocessos->num_rows > 0){

                //variaveis q auxiliam e uma para juntar os tempos do subs
                $aux_ = 0;
                $ficou = true;
                $tempo_subs = strtotime($pross["tempo"]) - strtotime('00:00:00');

                //roda todos os subs
                while($subprocessos = $result_sql_subprocessos->fetch_assoc()){
                    
                    //verifica se esse subprocesso já foi utilizado para junção para n realizar isso
                    if($id_aux == $subprocessos["idtabprocessosproduto"] AND $aux_ == 0){
                        $ficou = false;
                        break;
                    }

                    //se for o primeiro sub, atribui alguns valores como auxiliares
                    if($aux_ == 0){
                        $aux_ = 1;
                        $id_aux = $pross["idtabprocessosproduto"];
                    }

                    //somo o tempo da sub e da um delete nele
                    $tempo_subs += strtotime($subprocessos["tempo"]) - strtotime('00:00:00');
                    $sql_delete_sub = $connect->prepare("DELETE FROM tabprocessosproduto WHERE idtabprocessosproduto = ".$subprocessos["idtabprocessosproduto"]);
                    $sql_delete_sub->execute();
                }

                //se ele n passou no primeiro if do while...
                if($ficou){
                    //atualiza o original com o tempo certo
                    $tempo_subs_certo = gmdate('H:i:s', $tempo_subs);
                    $sql_update_original = $connect->prepare("UPDATE tabprocessosproduto SET tempo = '".$tempo_subs_certo."' WHERE idtabprocessosproduto = ".$pross["idtabprocessosproduto"]);
                    $sql_update_original->execute();
                }
            }
        }
    }
    
    //DIVIDI PROCESSOS >24H PARA ALGUNS DE ATÉ 23H
    //pega todos os processos q n estejam em andamento
    $sql = $connect->prepare("SELECT * FROM tabprocessosproduto WHERE finalizado != 1 AND (pros_inicial>='".$date."' OR pros_inicial is NULL)");
    $sql->execute();
    $result_sql = $sql->get_result();

    while($dado = $result_sql->fetch_assoc()){

        $horas_total = intval(strstr($dado['tempo'],':', true));
        $id_sub = 1;

        //verifica se o processo tem mais de 24h para dividir em subprocessos
        $quant = $horas_total/23;

        if($horas_total>=24 && $quant>0){
            //aqui ocorre a divisão em subprocessos de até 23h para fazer os calculos
            while($quant>0){
                $tempo = '23:00:00';

                if($quant<1){
                    $tempo = strval($horas_total%23).strstr($dado['tempo'],':');
                }
                elseif($quant==1 && strstr($dado['tempo'],':') != ':00:00'){
                    $tempo = '23'.strstr($dado['tempo'],':');
                }

                //inserindo os subprocessos na tabela
                $sql_insert = $connect->prepare("INSERT INTO `tabprocessosproduto`(`idproduto`, `idprocesso`, `id_sub`, `vezes`, `funcionarios`, `tempo`) VALUES (?,?,?,?,?,?)");
                $sql_insert->bind_param('ssssss', $dado['idproduto'], $dado['idprocesso'], $id_sub, $dado['vezes'], $dado['funcionarios'], $tempo);
                $sql_insert->execute();
                $id_sub++;
                $quant--;
            }

            //deletando o processo q foi dividido
            $sql_delete = $connect->prepare("DELETE FROM `tabprocessosproduto` WHERE idtabprocessosproduto = ".$dado['idtabprocessosproduto']);
            $sql_delete->execute();
        }
    }

    //ENTRADA DE EMERGENCIAL
    //sql q verifica se tem um emergencial q acabou de chegar
    $sql_emergencial = mysqli_query($connect, "SELECT * FROM tabpedidos_dia WHERE emergencial = 2 AND data_inicial IS NULL AND ordem IS NULL");
    $emergencial_rows = mysqli_num_rows($sql_emergencial);
    if($emergencial_rows > 0){

        //sql q verifica se estam em um turno em andamento
        $sql_turno_andamento = mysqli_query($connect, "SELECT * FROM tabhorariodiario WHERE data = '".$date1."' AND inicio <= '".$hora."' AND fim >= '".$hora."'");
        $turno_an = mysqli_fetch_array($sql_turno_andamento);
        if($turno_an != NULL){

            //sql q pega todos os processos n emergenciais em andamento
            $sql_andamento = mysqli_query($connect, "SELECT * FROM tabprocessosproduto as a, tabpedidos_dia as b WHERE a.pros_inicial <= '".$date."' AND a.pros_final > '".$date."' AND a.idproduto = b.id_pedido AND b.emergencial < 2");
            while($processo_an = mysqli_fetch_assoc($sql_andamento)){
                
                //cria variaveis para facilitar os calculos - nomes intuitivos
                $final_intervalo = gmdate('H:i:s', strtotime($turno_an["hora_intervalo"]) + strtotime($turno_an["intervalo"]) - strtotime('03:00:00'));
                
                $tempo_pro = strtotime($processo_an["tempo"]) - strtotime('00:00:00');
                $pros_final = strtotime(strstr($processo_an["pros_final"], " ")) - strtotime('00:00:00');
                $pros_inicial = strtotime(strstr($processo_an["pros_inicial"], " ")) - strtotime('00:00:00');
                $inter_final = strtotime($final_intervalo) - strtotime('00:00:00');
                $inter_inicio = strtotime($turno_an["hora_intervalo"]) - strtotime('00:00:00');
                $agora = strtotime($hora) - strtotime('00:00:00');
                
                //condições para ver em q parte do intervalo esta antes/durante/depois
                if($turno_an["hora_intervalo"] <= $hora AND $final_intervalo >= $hora){
                    $tempo_restante = $pros_final - $inter_final;
                }
                elseif($hora <= $turno_an["hora_intervalo"]){
                    $tempo_passado = $agora - $pros_inicial;
                    $tempo_restante = $tempo_pro - $tempo_passado;
                }
                elseif($hora >= $final_intervalo){
                    $tempo_restante = $pros_final - $agora;
                }

                //realiza update 
                //para os processos q estavam em andamento e os atualizam com o tempo restante e emergencial = 1
                $tempo_restante_certo = gmdate('H:i:s', $tempo_restante);

                $sql_update_andamento = $connect->prepare("UPDATE tabprocessosproduto SET tempo = '".$tempo_restante_certo."', escalonado = 0, pros_inicial = NULL WHERE idtabprocessosproduto = ".$processo_an["idtabprocessosproduto"]);
                $sql_update_andamento->execute();
                $sql_update_andamento_emer = $connect->prepare("UPDATE tabpedidos_dia SET emergencial = 1 WHERE id_pedido = ".$processo_an["idproduto"]);
                $sql_update_andamento_emer->execute();
            }
        }
    }
    
    //ORDENAÇÃO
    //ordena todos os pedidos de acordo com o peso e da a ordenação para os processos
    //sql q pega todos os pedidos pelo a prioridade exigida
    $aux=0;
    $sql = mysqli_query($connect, "select * from tabpedidos_dia where data_final > '".$date."' OR data_final is null OR data_final = '0000-00-00 00:00:00' order by emergencial DESC, peso DESC, data ASC");
    while($dado = mysqli_fetch_assoc($sql)){

        //da a ordem para os pedidos e seus respectivos processos
        $aux++;
        $atualizaOrdem = $connect->prepare("UPDATE tabpedidos_dia SET ordem = ".$aux." WHERE idtabpedidos_dia=".$dado['idtabpedidos_dia']);
        $atualizaOrdem->execute();
        $atualizaOrdem2 = $connect->prepare("UPDATE tabprocessosproduto SET ordem = ".$aux.", escalonado = 0 WHERE idproduto=".$dado['id_pedido']." AND (pros_inicial > '".$date."' OR pros_inicial IS NULL)");
        $atualizaOrdem2->execute();
    }

    //pegar dados da data de hj de diferentes formas
    date_default_timezone_set('America/Sao_Paulo');
    $datehora = date('Y-m-d H:i:s');
    $date = date('Y-m-d');
    $hora = date('H:i:s');


    // É AQUI Q ROLA O ESCALONAMENTO DOS PROCESSOS

    //sql q pega todos os turnos
    $sql_turnos = $connect->prepare("SELECT * FROM tabhorariodiario WHERE (fim > ? AND data = ?) OR (data > ?) ORDER BY data ASC, inicio ASC");
    $sql_turnos->bind_param("sss", $hora, $date, $date);
    $sql_turnos->execute();
    $result_sql_turnos = $sql_turnos->get_result();

    $continua = TRUE;

    $cont_teste1 = 1;
    $cont_teste2 = 1;
    echo json_encode(array("teste_exec_1" => $result_sql_turnos->num_rows));
    //373
    while($turno = $result_sql_turnos->fetch_assoc()){
        echo json_encode(array("teste_cont" => $cont_teste1));
        do{
            //variaveis auxiliares
            $continua = FALSE;
            $aux_id_processo = NULL;
            
            //sql q pega os processos adequados para realizar no turno em questão
            $sql_processos_adequados = $connect->prepare("SELECT * FROM tabprocessosproduto, tabmaquinasdisponiveis, tabhorariodiario 
                                            WHERE tabprocessosproduto.idprocesso = tabmaquinasdisponiveis.idmaquina AND tabprocessosproduto.escalonado = 0 
                                            AND tabmaquinasdisponiveis.data = ? AND tabhorariodiario.idtabhorariodiario = ? 
                                            AND tabhorariodiario.funcionario_disponiveis>=tabprocessosproduto.funcionarios ORDER BY tabprocessosproduto.ordem ASC, 
                                            tabprocessosproduto.idprocesso ASC, tabprocessosproduto.id_sub ASC, tabprocessosproduto.idtabprocessosproduto ASC");
            $sql_processos_adequados->bind_param("ss", $turno['data'], $turno['idtabhorariodiario']);
            $sql_processos_adequados->execute();

            $result_sql_processos_adequados = $sql_processos_adequados->get_result();
            
            // primeiro processo = 193
            // echo json_encode(array("teste_exec" => $result_sql_processos_adequados->num_rows));
            
            while($processo = $result_sql_processos_adequados->fetch_assoc()){
                echo json_encode(array("cont_teste2" => $cont_teste2));
                // nn deixa q o processo seja escalonado novamente
                if($aux_id_processo != $processo["idtabprocessosproduto"]){
                    $aux_id_processo = $processo["idtabprocessosproduto"];

                    //sql q busca todos os processos já escalonados no turno
                    $inicio_turno = NULL;
                    $inicial_teste = $turno["data"]." ".$turno["inicio"];
                    $final_teste = $turno["data"]." ".$turno["fim"];

                    $sql_processos_no_turno_code = "SELECT * FROM tabprocessosproduto WHERE escalonado = 1 AND pros_inicial >= '".$turno["data"]." ".$turno["inicio"]."' AND pros_final <= '".$turno['data']." ".$turno['fim']."' ORDER BY pros_final ASC";

                    if($turno["data"] == $date){
                        $sql_processos_no_turno_code = "SELECT * FROM tabprocessosproduto WHERE escalonado = 1 AND pros_inicial >= '".$turno["data"]." ".$turno["inicio"]."' AND pros_final <= '".$turno["data"]." ".$turno["fim"]."' AND pros_final >= '".date('Y-m-d H:i:s')."' ORDER BY pros_final ASC";
                        echo json_encode(array("teste2" => date('Y-m-d H:i:s')));
                    }

                    $sql_processos_no_turno = $connect->prepare($sql_processos_no_turno_code);
                    echo json_encode(array("teste2" => $sql_processos_no_turno));
                    $sql_processos_no_turno->execute();
                    echo json_encode(array("teste2" => $processo["idtabprocessosproduto"]));

                    $result_sql_processos_no_turno = $sql_processos_no_turno->get_result();
                    
                    //inicializando as variaveis como null para cada processo
                    $inicio = NULL;
                    $fim = NULL;
                    $liberada = NULL;
                    $naopara = FALSE;

                    //vai rodar até ele achar um inicio e fim de tempo em q ele é aceitado
                    // while($final = $result_sql_processos_no_turno->fetch_assoc()){
                    //     //verifica por onde deve começar a buscar se é aceitável começar o processo
                    //     //se n começou o turno ainda
                    //     //se já comecou um turno/se estam em horario de intevalo ou se esta no final de um processo
                    //     if($turno["data"] == $date){
                    //         if($inicio_turno == NULL AND $turno["inicio"] > $hora){
                    //             $inicio_turno = $turno["inicio"];
                    //         }
                    //         elseif($inicio_turno == NULL){
                    //             $fim_intervalo = gmdate('H:i:s', strtotime($turno["hora_intervalo"]) + strtotime($turno["intervalo"]) - strtotime('03:00:00'));
                    //             if($hora >= $turno["hora_intervalo"] AND $hora <$fim_intervalo){
                    //                 $inicio_turno = $fim_intervalo;
                    //             }
                    //             else{
                    //                 $inicio_turno = $hora;
                    //             }
                    //         }
                    //         else{
                    //             $inicio_turno = gmdate('H:i:s',strtotime(strstr($final["pros_final"],' '))-strtotime('00:00:00'));
                    //         }
                    //     }
                    //     else{
                    //         if($inicio_turno == NULL){
                    //             $inicio_turno = $turno["inicio"];
                    //         }
                    //         else{
                    //             $inicio_turno = gmdate('H:i:s',strtotime(strstr($final["pros_final"],' '))-strtotime('00:00:00'));
                    //         }
                    //     }

                    //     //verifica se a compatível com as condições seguintes e até quando
                    //     //primeiro verifica se tem os funcionarios necessários
                    //     $data_inicio_turno = $turno["data"]." ".$inicio_turno;
                    //     $sql_funcionarios_usando = $connect->prepare("SELECT sum(funcionarios) FROM tabprocessosproduto 
                    //                                                     WHERE pros_inicial <= ? AND pros_final > ? AND escalonado = 1");
                    //     $sql_funcionarios_usando->bind_param("ss", $data_inicio_turno, $data_inicio_turno);
                    //     $sql_funcionarios_usando->execute();
                    //     $result_sql_funcionarios_usando = $sql_funcionarios_usando->get_result();

                    //     $funcionarios_usados = $result_sql_funcionarios_usando->fetch_array();

                    //     //se a quantidade for a necessária
                    //     if($turno["funcionario_disponiveis"] - $funcionarios_usados["sum(funcionarios)"] >= $processo["funcionarios"]){
                            
                    //         //depois verifica se tem a maquina necessária
                    //         //se estiver proucurando até onde esta liberada
                    //         if($liberada!=NULL){

                    //             //sql q verifica se tem algum processo utilizando da maquina necessaria nesse momento para dar um fim
                    //             $data_inicio_turno = $turno["data"]." ".$inicio_turno;
                    //             $sql_verifica_uso = $connect->prepare("SELECT * FROM tabprocessosproduto WHERE escalonado = 1 AND idmaquina = ? 
                    //                                                     AND pros_inicial <= ? AND pros_final > ?");
                    //             $sql_verifica_uso->bind_param("sss", $liberada, $data_inicio_turno, $data_inicio_turno);
                    //             $sql_verifica_uso->execute();
                    //             $result_sql_verifica_uso = $sql_verifica_uso->get_result();

                    //             if($result_sql_verifica_uso->num_rows > 0){
                    //                 $aux_maquina = $liberada;
                    //                 $liberada = NULL;
                    //             }
                    //         }

                    //         //se tiver procurando qual maquina esta disponivel
                    //         else{

                    //             //sql q ver quais maquinas q ele possa usar q estão disponíveis no dia
                    //             $sql_oferta_maquina = $connect->prepare("SELECT * FROM tabmaquinasdisponiveis WHERE idmaquina = ? AND data = ?");
                    //             $sql_oferta_maquina->bind_param("is", $processo['idprocesso'], $turno['data']);
                    //             $sql_oferta_maquina->execute();
                    //             $result_sql_oferta_maquina = $sql_oferta_maquina->get_result();

                    //             while($maquina = $result_sql_oferta_maquina->fetch_assoc()){
                    //                 //sql q verifica se tem alguem usando naquele momento
                    //                 $data_inicio_turno = $turno["data"]." ".$inicio_turno;
                    //                 $sql_verifica_uso = $connect->prepare("SELECT * FROM tabprocessosproduto WHERE escalonado = 1 
                    //                                                         AND idmaquina = ? AND pros_inicial <= ? AND pros_final > ?");
                    //                 $sql_verifica_uso->bind_param("iss", $maquina["idtabmaquinasdisponiveis"], $data_inicio_turno, $data_inicio_turno);
                    //                 $result_sql_verifica_uso = $sql_verifica_uso->get_result();

                    //                 //verifica entre as maquinas possiveis se alguma n esta sendo usada
                    //                 if($result_sql_verifica_uso->num_rows == 0){
                    //                     $liberada = $maquina["idtabmaquinasdisponiveis"];
                    //                     break;
                    //                 }
                    //             }
                    //         }
                    //     }

                    //     //verifica se todos os processos do pedido q deveriam ser feitos antes dele já foram feito
                    //     $data_inicio_turno = $turno["data"]." ".$inicio_turno;
                    //     $sql_verifica_preparo = $connect->prepare("SELECT * FROM tabprocessosproduto WHERE idproduto = ? AND idprocesso < ? 
                    //                                                 AND (escalonado = 0 or (escalonado = 1 AND pros_final > ?))");
                    //     $sql_verifica_preparo->bind_param("iis", $processo["idproduto"], $processo["idprocesso"], $data_inicio_turno);
                    //     $sql_verifica_preparo->execute();
                    //     $result_sql_verifica_preparo = $sql_verifica_preparo->get_result();
                        
                    //     //se ele tiver achado e foi a primeira vez e os processos necessários já foram realizados, ele declara como inicio
                    //     if($liberada != NULL AND $inicio == NULL AND $inicio_turno < $turno["fim"] AND $result_sql_verifica_preparo->num_rows == 0){
                    //         $inicio = $inicio_turno;
                    //         $naopara = FALSE;
                    //     }
                    //     //se n fora primeira vez ele declara como o fim
                    //     else if($liberada != NULL AND $inicio != NULL){
                    //         $fim = $inicio_turno;
                    //         $naopara = TRUE;
                    //     }
                    //     //se ele já tiver achado um inicio e um fim ele sai do do_while
                    //     else if($liberada == NULL AND $inicio != NULL){
                    //         $liberada = $aux_maquina;
                    //         $naopara = FALSE;
                    //         $fim = $inicio_turno;
                    //         break;
                    //     }

                    // }
                    
                    
                    // //se tiver encontrado um horarios mas n um final, significa q ele tem até o final do turno
                    // if(($inicio != NULL AND $fim == NULL AND $inicio != $turno["fim"]) OR ($inicio != NULL AND $naopara)){
                    //     $fim = $turno["fim"];
                    // }

                    // //se ele tiver encontrado um tempo para se executar
                    // if($inicio != NULL and $fim != NULL){

                    //     //cria variáveis para facilitar os calculos - nomes intuitivos
                    //     $inicio_conta = strtotime($inicio);
                    //     $fim_conta = strtotime($fim);
                    //     $intervalo = strtotime($turno["hora_intervalo"]);
                    //     $tempo_intervalo = strtotime($turno["intervalo"]) - strtotime('00:00:00');
                    //     $calculo = gmdate('H:i:s', $fim_conta-$inicio_conta);
                    //     $tempo_conta = strtotime($processo["tempo"]) - strtotime('00:00:00');

                    //     //se do inicio até o fim passa pelo intervalo então ele retira o intervalo do tempo disponível
                    //     if($inicio_conta <= $intervalo AND $fim_conta > $intervalo){
                    //         $calculo = gmdate('H:i:s', $fim_conta-$inicio_conta-$tempo_intervalo);
                    //     }
                        
                    //     //verifica se o tempo disponível encontrado é suficiente para concluir o processo
                    //     if($calculo >= $processo["tempo"]){

                    //         //processo tem inicio em $inicio e fim até quando precisar
                    //         $final_update = gmdate('H:i:s', $inicio_conta + $tempo_conta - strtotime("00:00:00"));

                    //         //se o inicio e o fim passarem pelo intervalo temos q adicionar o intercalo no tempo final
                    //         if($final_update > $turno["hora_intervalo"] AND $inicio <= $turno["hora_intervalo"]){
                    //             $tempo_conta += $tempo_intervalo;
                    //             $final_update = gmdate('H:i:s', $inicio_conta + $tempo_conta - strtotime("00:00:00"));
                    //         }

                    //         //update do processo com seu inicio, fim, maquina utilizada e declarado como escalonado
                    //         $data_inicio_turno = $turno["data"]." ".$inicio;
                    //         $data_final_turno = $turno["data"]." ".$final_update;
                    //         $sql_update_processo = $connect->prepare("UPDATE tabprocessosproduto SET escalonado = 1, idmaquina = ?,
                    //             pros_inicial = ?, pros_final = ? WHERE idtabprocessosproduto = ? ");
                    //         $sql_update_processo->bind_param("issi", $liberada, $data_inicio_turno, $data_final_turno, $processo["idtabprocessosproduto"]);
                    //         $sql_update_processo->execute();

                    //     }
                    //     else{
                    //         //dividi em dois sub processos, um com o tempo máximo e outro com restante

                    //         //verifica o tempo disponível q encontrou
                    //         $tempo_disponivel = $fim_conta - $inicio_conta;

                    //         //se passar pelo intervalo tira o intercalo do tempo disponível
                    //         if($inicio_conta<=$intervalo AND $fim_conta>$intervalo){
                    //             $tempo_disponivel -= $tempo_intervalo;
                    //         }

                    //         //atribui as variáveis com o tempo novo dos dois subprocessos
                    //         $novo_tempo_time = $tempo_conta - $tempo_disponivel;
                    //         $antigo_novo_time = $tempo_conta - $novo_tempo_time;
                    //         $antigo_novo = gmdate('H:i:s', $antigo_novo_time);
                    //         $novo_tempo = gmdate('H:i:s', $novo_tempo_time);

                    //         //da um update no processo original para dar o tempo novo, inicio, fim, idmaquina e declara escalonado
                    //         $data_inicio_turno = $turno["data"]." ".$inicio;
                    //         $data_final_turno = $turno["data"]." ".$fim;
                    //         $sql_update_processo = $connect->prepare("UPDATE tabprocessosproduto SET escalonado = 1, idmaquina = ?,
                    //             pros_inicial = ?, pros_final = ?, tempo = ? WHERE idtabprocessosproduto = ?");
                    //         $sql_update_processo->bind_param("isssi", $liberada, $data_inicio_turno, $data_final_turno, $antigo_novo, $processo["idtabprocessosproduto"]);
                    //         $sql_update_processo->execute();
                            
                    //         //cria o sub processo com os mesmos valores do original porem o com o tempo q falta
                    //         $sql_insert_subprocesso = $connect->prepare("INSERT INTO `tabprocessosproduto`(`idproduto`, `id_sub`, `idprocesso`, `vezes`, `funcionarios`, `tempo`, `ordem`) VALUES (?,?,?,?,?,?,?)");
                    //         $sql_insert_subprocesso->bind_param('sssssss', $processo['idproduto'], $processo['id_sub'], $processo['idprocesso'], $processo['vezes'], $processo['funcionarios'], $novo_tempo, $processo['ordem']);
                    //         $sql_insert_subprocesso->execute();

                    //         $continua = TRUE;
                    //         break;
                    //     }
                    // }
                }
                $cont_teste2++;
            }
        }while($continua);
        $cont_teste1++;
    }

    //ATUALIZA DATA INICIAL E FINAL DOS PEDIDOS
    //pesquisar todoas os pedidos q n estao em andamento
    $sql_pedidos = mysqli_query($connect, "SELECT * FROM tabpedidos_dia");
    
    //aqui realiza a parte de atualiza os dados dos pedidos com os horários certos - inicio e fim
    while($pedido = mysqli_fetch_assoc($sql_pedidos)){

        //se o pedido n tiver iniciado ele atualiza o inicio e o fim
        if($pedido["data_inicial"]>$datehora OR $pedido["data_inicial"]==NULL OR $pedido["data_inicial"]=="0000-00-00 00:00:00"){
            
            //SQLs q pega a menor data inicial e maior data final entre os processos do pedido
            $sql_inicial = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE idproduto = ".$pedido['id_pedido']." ORDER BY pros_inicial ASC");
            $inicio = mysqli_fetch_array($sql_inicial);
            $sql_final = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE idproduto = ".$pedido['id_pedido']." ORDER BY pros_final DESC");
            $fim = mysqli_fetch_array($sql_final);

            if($inicio != NULL){
                if($inicio['pros_inicial'] == NULL){
                    $sql_update_pedido = $connect->prepare("UPDATE `tabpedidos_dia` SET `data_inicial`='0000-00-00 00:00:00',`data_final`='0000-00-00 00:00:00' WHERE id_pedido = ".$pedido['id_pedido']);
                    //$sql_update_previsao_tabpedido = $connect->prepare("UPDATE tabpedido SET previsao = '0000-00-00 00:00:00' WHERE idpedido = ".$pedido['id_pedido']." AND statuspedido != 1");
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
                    //$sql_update_previsao_tabpedido = $connect->prepare("UPDATE tabpedido SET previsao = '0000-00-00 00:00:00' WHERE idpedido = ".$pedido['id_pedido']." AND statuspedido != 1");
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