<?php 

    include_once "../../config/conexao.php";

    // MATEUS MARGOTTI

    //datas para os próximos SQLs
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i:s');
    date_default_timezone_set('America/Sao_Paulo');
    $date1 = date('Y-m-d');
    $hora = date('H:i:s');
    
    //atualiza os q n foram feitos para se escalonarem novamente da forma certa
    //deleta todos os pedidos, processos e turnos q já passaram de acordo com a data e hora atual
    $atualizaTabelas = $connect->prepare("UPDATE tabprocessosproduto SET idmaquina = NULL, pros_inicial = NULL, pros_final = NULL WHERE pros_inicial >= '".$date."'");
    $atualizaTabelas->execute();
    
    //JUNTAR OS SUB PROCESSOS NO ORIGINAL
    //subprocessos são os processos na tabela bem semelhantes que possuem mesmo id_sub
    //eles são seperados quando o tempo em q ele acha pra se executar n é suficiente e precisa continuar depois
    
    //sql para buscar os processos q n começaram e aux para n repetir o processo com outro sub igual
    $id_aux = 0;
    $sql_processos = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE pros_inicial > '".$date."' OR pros_inicial IS NULL ORDER BY idtabprocessosproduto");
    
    while($pross = mysqli_fetch_assoc($sql_processos)){
        
        //cria uma busca pra ver se esse dado ainda existi
        $existencia = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE idtabprocessosproduto = ".$pross['idtabprocessosproduto']);
        $rows_exist = mysqli_num_rows($existencia);

        if($rows_exist > 0){
        //sql q busca todos os subs do processo atual
            $sql_subprocessos = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE (pros_inicial > '".$date."' OR pros_inicial IS NULL) 
                AND idtabprocessosproduto != ".$pross["idtabprocessosproduto"]." AND id_sub = ".$pross["id_sub"]." AND 
                idproduto = ".$pross["idproduto"]." AND idprocesso = ".$pross["idprocesso"]." ORDER BY idtabprocessosproduto ASC");
            $rows_processos = mysqli_num_rows($sql_subprocessos);
            
            //se tiver algum...
            if($rows_processos>0){

                //variaveis q auxiliam e uma para juntar os tempos do subs
                $aux_ = 0;
                $ficou = true;
                $tempo_subs = strtotime($pross["tempo"]) - strtotime('00:00:00');

                //roda todos os subs
                while($subprocessos = mysqli_fetch_assoc($sql_subprocessos)){
                    
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

                //se ele n passou no primieiro if so while...
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
    $sql = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE pros_inicial>='".$date."' OR pros_inicial is NULL");
    while($dado = mysqli_fetch_assoc($sql)){
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
                elseif($quant==1 && strstr($dado['tempo'],':')!=':00:00'){
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

    //ENTREDA DE EMERGENCIAL
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
    $sql_turnos = mysqli_query($connect, "SELECT * FROM tabhorariodiario WHERE (fim > '".$hora."' AND data = '".$date."') OR (data > '".$date."') ORDER BY data ASC, inicio ASC");
    $continua = TRUE;
    while($turno = mysqli_fetch_assoc($sql_turnos)){
        do{

            //variaveis auxiliares
            $continua = FALSE;
            $aux_id_processo = NULL;
            

            //sql q pega os processos adequados para realizar no turno em questão
            $sql_processos_adequados = mysqli_query($connect, "SELECT * FROM 
                tabprocessosproduto as a, tabmaquinasdisponiveis as b, tabhorariodiario as c 
                WHERE a.idprocesso = b.idmaquina AND a.escalonado = 0 AND b.data = '".$turno['data']."' AND c.idtabhorariodiario = '".$turno['idtabhorariodiario']."' AND 
                c.funcionario_disponiveis>=a.funcionarios ORDER BY a.ordem ASC, a.idprocesso ASC, a.id_sub ASC, a.idtabprocessosproduto ASC");
            
            while($processo = mysqli_fetch_assoc($sql_processos_adequados)){

                //nn deixa q o processo seja escalonado novamente
                if($aux_id_processo != $processo["idtabprocessosproduto"]){
                    $aux_id_processo = $processo["idtabprocessosproduto"];

                    //sql q busca todos os processos já escalonados no turno
                    $inicio_turno = NULL;
                    $sql_processos_no_turno = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE escalonado = 1 AND
                        pros_inicial >= '".$turno["data"]." ".$turno["inicio"]."' AND pros_final <= '".$turno["data"]." ".$turno["fim"]."'
                        ORDER BY pros_final ASC");

                    if($turno["data"] == $date){
                        $sql_processos_no_turno = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE escalonado = 1 AND
                            pros_inicial >= '".$turno["data"]." ".$turno["inicio"]."' AND pros_final <= '".$turno["data"]." ".$turno["fim"]."'
                            AND pros_final >= '".$datehora."' ORDER BY pros_final ASC");
                    }
                    
                    //inicializando as variaveis como null para cada processo
                    $inicio = NULL;
                    $fim = NULL;
                    $liberada = NULL;
                    $naopara = FALSE;

                    //vai rodar até ele achar um inicio e fim de tempo em q ele é aceitado
                    do{

                        //verifica por onde deve começar a buscar se é aceitável começar o processo
                        //se n começou o turno ainda
                        //se já comecou um turno/se estam em horario de intevalo ou se esta no final de um processo
                        if($turno["data"] == $date){
                            if($inicio_turno == NULL AND $turno["inicio"] > $hora){
                                $inicio_turno = $turno["inicio"];
                            }
                            elseif($inicio_turno == NULL){
                                $fim_intervalo = gmdate('H:i:s', strtotime($turno["hora_intervalo"]) + strtotime($turno["intervalo"]) - strtotime('03:00:00'));
                                if($hora >= $turno["hora_intervalo"] AND $hora <$fim_intervalo){
                                    $inicio_turno = $fim_intervalo;
                                }
                                else{
                                    $inicio_turno = $hora;                                    
                                }
                            }
                            else{
                                $inicio_turno = gmdate('H:i:s',strtotime(strstr($final["pros_final"],' '))-strtotime('00:00:00'));
                            }
                        }
                        else{
                            if($inicio_turno == NULL){
                                $inicio_turno = $turno["inicio"];
                            }
                            else{
                                $inicio_turno = gmdate('H:i:s',strtotime(strstr($final["pros_final"],' '))-strtotime('00:00:00'));
                            }
                        }

                        //verifica se a compatível com as condições seguintes e até quando
                        //primeiro verifica se tem os funcionarios necessários
                        $sql_funcionarios_usando = mysqli_query($connect, "SELECT sum(funcionarios) FROM tabprocessosproduto 
                            WHERE pros_inicial <= '".$turno["data"]." ".$inicio_turno."' AND pros_final > '".$turno["data"]." ".$inicio_turno."'
                            AND escalonado = 1");
                        $funcionarios_usados = mysqli_fetch_array($sql_funcionarios_usando);

                        //se a quantidade for a necessária
                        if($turno["funcionario_disponiveis"] - $funcionarios_usados["sum(funcionarios)"] >= $processo["funcionarios"]){
                            
                            //depois verifica se tem a maquina necessária
                            //se estiver proucurando até onde esta liberada
                            if($liberada!=NULL){

                                //sql q verifica se tem algum processo utilizando da maquina necessaria nesse momento para dar um fim
                                $sql_verifica_uso = mysqli_query($connect, "SELECT * FROM tabprocessosproduto 
                                WHERE escalonado = 1 AND idmaquina = ".$liberada." AND pros_inicial <= '".$turno["data"]." ".$inicio_turno."' AND pros_final > '".$turno["data"]." ".$inicio_turno."'");
                                $rows_maquinas = mysqli_num_rows($sql_verifica_uso);

                                if($rows_maquinas > 0){
                                    $aux_maquina = $liberada;
                                    $liberada = NULL;
                                }
                            }

                            //se tiver procurando qual maquina esta disponivel
                            else{

                                //sql q ver quais maquinas q ele possa usar q estão disponíveis no dia
                                $sql_oferta_maquina = mysqli_query($connect, "SELECT * FROM tabmaquinasdisponiveis WHERE idmaquina = ".$processo['idprocesso']." AND data = '".$turno['data']."'");
                                while($maquina = mysqli_fetch_assoc($sql_oferta_maquina)){

                                    //sql q verifica se tem alguem usando naquele momento
                                    $sql_verifica_uso = mysqli_query($connect, "SELECT * FROM tabprocessosproduto 
                                    WHERE escalonado = 1 AND idmaquina = ".$maquina["idtabmaquinasdisponiveis"]." AND pros_inicial <= '".$turno["data"]." ".$inicio_turno."' AND pros_final > '".$turno["data"]." ".$inicio_turno."'");
                                    $rows_maquinas = mysqli_num_rows($sql_verifica_uso);

                                    //verifica entre as maquinas possiveis se alguma n esta sendo usada
                                    if($rows_maquinas == 0){
                                        $liberada = $maquina["idtabmaquinasdisponiveis"];
                                        break;
                                    }
                                }
                            }
                        }

                        //verifica se todos os processos do pedido q deveriam ser feitos antes dele já foram feito
                        $sql_verifica_preparo = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE idproduto = ".$processo["idproduto"]." AND
                            idprocesso < ".$processo["idprocesso"]." AND (escalonado = 0 or (escalonado = 1 AND pros_final > '".$turno["data"]." ".$inicio_turno."'))");

                        $verifica_preparo_rows = mysqli_num_rows($sql_verifica_preparo);
                        
                        //se ele tiver achado e foi a primeira vez e os processos necessários já foram realizados, ele declara como inicio
                        if($liberada!=NULL AND $inicio==NULL AND $inicio_turno<$turno["fim"] AND $verifica_preparo_rows==0){
                            $inicio = $inicio_turno;
                            $naopara = FALSE;
                        }
                        //se n fora primeira vez ele declara como o fim
                        else if($liberada!=NULL AND $inicio!=NULL){
                            $fim = $inicio_turno;
                            $naopara = TRUE;
                        }
                        //se ele já tiver achado um inicio e um fim ele sai do do_while
                        else if($liberada==NULL AND $inicio!=NULL){
                            $liberada = $aux_maquina;
                            $naopara = FALSE;
                            $fim = $inicio_turno;
                            break;
                        }

                    }while($final = mysqli_fetch_assoc($sql_processos_no_turno));
                    
                    
                    //se tiver encontrado um horarios mas n um final, significa q ele tem até o final do turno
                    if(($inicio != NULL AND $fim == NULL AND $inicio != $turno["fim"]) OR ($inicio != NULL AND $naopara)){
                        $fim = $turno["fim"];
                    }

                    //se ele tiver encontrado um tempo para se executar
                    if($inicio != NULL and $fim != NULL){

                        //cria variáveis para facilitar os calculos - nomes intuitivos
                        $inicio_conta = strtotime($inicio);
                        $fim_conta = strtotime($fim);
                        $intervalo = strtotime($turno["hora_intervalo"]);
                        $tempo_intervalo = strtotime($turno["intervalo"]) - strtotime('00:00:00');
                        $calculo = gmdate('H:i:s', $fim_conta-$inicio_conta);
                        $tempo_conta = strtotime($processo["tempo"]) - strtotime('00:00:00');

                        //se do inicio até o fim passa pelo intervalo então ele retira o intervalo do tempo disponível
                        if($inicio_conta<=$intervalo AND $fim_conta>$intervalo){
                            $calculo = gmdate('H:i:s', $fim_conta-$inicio_conta-$tempo_intervalo);
                        }
                        
                        //verifica se o tempo disponível encontrado é suficiente para concluir o processo
                        //echo $calculo;
                        if($calculo>=$processo["tempo"]){

                            //processo tem inicio em $inicio e fim até quando precisar
                            $final_update = gmdate('H:i:s', $inicio_conta + $tempo_conta - strtotime("00:00:00"));

                            //se o inicio e o fim passarem pelo intervalo temos q adicionar o intercalo no tempo final
                            if($final_update > $turno["hora_intervalo"] AND $inicio <= $turno["hora_intervalo"]){
                                $tempo_conta += $tempo_intervalo;
                                $final_update = gmdate('H:i:s', $inicio_conta + $tempo_conta - strtotime("00:00:00"));
                            }

                            //update do processo com seu inicio, fim, maquina utilizada e declarado como escalonado
                            $sql_update_processo = $connect->prepare("UPDATE tabprocessosproduto SET escalonado = 1, idmaquina = ".$liberada.",
                                pros_inicial = '".$turno["data"]." ".$inicio."', pros_final = '".$turno["data"]." ".$final_update."' 
                                WHERE idtabprocessosproduto = ".$processo["idtabprocessosproduto"]);
                            $sql_update_processo->execute();
                        }
                        else{

                            //dividi em dois sub processos, um com o tempo máximo e outro com restante

                            //verifica o tempo disponível q encontrou
                            $tempo_disponivel = $fim_conta - $inicio_conta;

                            //se passar pelo intervalo tira o intercalo do tempo disponível
                            if($inicio_conta<=$intervalo AND $fim_conta>$intervalo){
                                $tempo_disponivel -= $tempo_intervalo;
                            }

                            //atribui as variáveis com o tempo novo dos dois subprocessos
                            $novo_tempo_time = $tempo_conta - $tempo_disponivel;
                            $antigo_novo_time = $tempo_conta - $novo_tempo_time;
                            $antigo_novo = gmdate('H:i:s', $antigo_novo_time);
                            $novo_tempo = gmdate('H:i:s', $novo_tempo_time);

                            //da um update no processo original para dar o tempo novo, inicio, fim, idmaquina e declara escalonado
                            $sql_update_processo = $connect->prepare("UPDATE tabprocessosproduto SET escalonado = 1, idmaquina = ".$liberada.",
                                pros_inicial = '".$turno["data"]." ".$inicio."', pros_final = '".$turno["data"]." ".$fim."', tempo = '".$antigo_novo."' 
                                WHERE idtabprocessosproduto = ".$processo["idtabprocessosproduto"]);
                            $sql_update_processo->execute();
                            
                            //cria o sub processo com os mesmos valores do original porem o com o tempo q falta
                            $sql_insert_subprocesso = "INSERT INTO `tabprocessosproduto`(`idproduto`, `id_sub`, `idprocesso`, `vezes`, `funcionarios`, `tempo`, `ordem`) VALUES 
                                (?,?,?,?,?,?,?)";
                            $insert = $connect->prepare($sql_insert_subprocesso);
                            $insert->bind_param('sssssss', $processo['idproduto'], $processo['id_sub'], $processo['idprocesso'], $processo['vezes'], $processo['funcionarios'], $novo_tempo, $processo['ordem']);
                            $insert->execute();

                            $continua = TRUE;
                            break;
                        }
                    }
                }
            }
        }while($continua);
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

        //se n atualiza só o final
        else{

            //SQL q pega a maior data final entre os processos do pedido
            $sql_inicial = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE idproduto = ".$pedido['id_pedido']." ORDER BY pros_inicial ASC");
            $inicio = mysqli_fetch_array($sql_inicial);
            $sql_final = mysqli_query($connect, "SELECT * FROM tabprocessosproduto WHERE idproduto = ".$pedido['id_pedido']." ORDER BY pros_final DESC");
            $fim = mysqli_fetch_array($sql_final);

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


?>