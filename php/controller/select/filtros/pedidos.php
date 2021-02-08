<?php
    include_once "../../../config/conexao.php";

    $idStatus = $_POST['id'];

    $sqlSelecionaPedidos = $connect->prepare("SELECT tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto, tabpedido.quantidadepedido, tabpedido.dimensaopedido, tabpedido.statuspedido, tabstatus.nomestatus, tabpedido.atividade, tabatividade.descricao AS nomeatividade, tabpedido.seguranca, tabseguranca.descricao AS nomeseguranca, tabpedido.formulariopedido, DATEDIFF (NOW(), tabpedido.datainclusao) AS quantidade_dias
                                                FROM tabpedido
                                            INNER JOIN tabcliente ON tabcliente.idcliente = tabpedido.clientepedido
                                            INNER JOIN tabproduto ON tabproduto.idproduto = tabpedido.produtopedido
                                            INNER JOIN tabstatus ON tabstatus.idtabstatus = tabpedido.statuspedido
                                            INNER JOIN tabatividade ON tabatividade.idtabatividade = tabpedido.atividade
                                            INNER JOIN tabseguranca	ON tabseguranca.idtabseguranca = tabpedido.seguranca
                                            WHERE tabpedido.statuspedido = ? AND DATEDIFF (NOW(), tabpedido.datainclusao) < 90 ORDER BY tabpedido.statuspedido, tabpedido.datainclusao");
    $sqlSelecionaPedidos->bind_param("i", $idStatus);
    $sqlSelecionaPedidos->execute();

    $resultPedidos = $sqlSelecionaPedidos->get_result();

    if($resultPedidos->num_rows > 0){

        while($resPedidos = $resultPedidos->fetch_assoc()){?>
            <tr>
                <td><?php echo $resPedidos['idpedido'] ?></td>
                <td><?php echo $resPedidos['nomecliente'] ?></td>
                <td><?php echo $resPedidos['nomeproduto'] ?></td>
                <td><?php echo $resPedidos['quantidadepedido'] ?></td>
                <td><?php echo $resPedidos['nomestatus'] ?></td>
                <td><?php echo $resPedidos['quantidade_dias'] ?> dias</td>
                <?php
                if($resPedidos['statuspedido'] == 1 || $resPedidos['statuspedido'] == 3 || $resPedidos['statuspedido'] == 6){
                    ?>
                <td>
                    <a class='dropdown-trigger btn-flat' href='#'
                        data-target='drop_completo<?php echo $resPedidos['idpedido'] ?>'><i
                            class="material-icons">more_vert</i></a>

                    <!-- Dropdown Structure -->
                    <ul id='drop_completo<?php echo $resPedidos['idpedido'] ?>' class='dropdown-content'
                        style="width: 360px !important">

                        <li><a data-target="detalhes" data-id="<?php echo $resPedidos['idpedido'] ?>"
                                class="modal-trigger detalhes blue-text text-darken-3">
                                <i class="material-icons blue-text text-darken-3">list</i>Detalhes
                            </a>
                        </li>
                        <li>
                            <a data-target="edita" data-id="<?php echo $resPedidos['idpedido'] ?>"
                                class="modal-trigger atualiza orange-text text-darken-3">
                                <i class="material-icons orange-text text-darken-3">edit</i>Editar
                            </a>
                        </li>
                        <li><a data-target="exclui" data-id="<?php echo $resPedidos['idpedido'] ?>"
                                class="modal-trigger exclui red-text text-darken-3">
                                <i class="material-icons red-text text-darken-3">delete</i>Excluir
                            </a></li>
                    </ul>
                </td>
                <?php
                }else{
                    ?>
                <td>
                    <a class='dropdown-trigger btn-flat' href='#'
                        data-target='drop_detalhes<?php echo $resPedidos['idpedido'] ?>'><i
                            class="material-icons">more_vert</i></a>

                    <!-- Dropdown Structure -->
                    <ul id='drop_detalhes<?php echo $resPedidos['idpedido'] ?>' class='dropdown-content'>
                        <li>
                            <a data-target="detalhes" data-id="<?php echo $resPedidos['idpedido'] ?>"
                                class="modal-trigger detalhes blue-text text-darken-3"><i
                                    class="material-icons blue-text text-darken-3">list</i>Detalhes</a>
                        </li>
                    </ul>
                </td>
                <?php
                }
            ?>
            </tr>
            <?php
        }
        ?>
        <div class='modal fade' id="detalhes">
            <div class='modal-content'>
                <div class='row right'><i class='material-icons modal-close'>close</i></div>
                <h4>Detalhes</h4>
                <div class='divider'></div>
                <div class="row left-align">
                    <div class="col l6">
                        <p>Cliente: <span id="nome_cliente_detalhes"></span></p>
                        <p>Produto: <span id="nome_produto_detalhes"></span></p>
                        <p>Quantidade: <span id="qtd_detalhes"></span></p>
                        <p>Dimensao: <span id="dimensao_detalhes"></span></p>
                    </div>
                    <div class="col l6">
                        <p>Atividade: <span id="atividade_detalhes"></span></p>
                        <p>Seguranca: <span id="seguranca_detalhes"></span></p>
                        <p>Formulário: <span id="form_detalhes"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class='modal fade' id="edita">
            <div class='modal-content'>
                <div class='row right'><i class='material-icons modal-close'>close</i></div>
                <h4>Editar</h4>
                <div class='divider'></div>
                <div class="row">
                    <p>Cliente: <span id="nome_cliente"></span></p>
                    <p>Produto: <span id="nome_produto"></span></p>
                </div>
                <form method='post' action='#' id='form_edita' enctype="multipart/form-data">
                    <div class="row">
                        <div class="input-field col l2">
                            <input id="qtd" type="text" class="validate" name="qtd">
                            <label for="qtd">Quantidade</label>
                        </div>
                        <div class="input-field col l2">
                            <input id="dimensao" type="text" class="validate" name="dimensao">
                            <label for="dimensao">Dimensão</label>
                        </div>
                        <div class="input-field col l3">
                            <select name="atividade" id="atividade">
                                <?php
                                $sqlAtividades = $connect->prepare("SELECT * FROM tabatividade");
                                $sqlAtividades->execute();

                                $resultAtividades = $sqlAtividades->get_result();

                                while($resAtividades = $resultAtividades->fetch_assoc()){
                            ?>
                                <option value="<?php echo $resAtividades['idtabatividade'] ?>"><?php echo $resAtividades['descricao'] ?></option>
                                <?php
                                }
                            ?>
                            </select>
                            <label>Atividade</label>
                        </div>
                        <div class="input-field col l4">
                            <select name="seguranca" id="seguranca">
                                <?php
                                $sqlSegurancas = $connect->prepare("SELECT * FROM tabseguranca");
                                $sqlSegurancas->execute();

                                $resultSegurancas = $sqlSegurancas->get_result();

                                while($resSegurancas = $resultSegurancas->fetch_assoc()){
                            ?>
                                <option value="<?php echo $resSegurancas['idtabseguranca'] ?>"><?php echo $resSegurancas['descricao'] ?></option>
                                <?php
                                }
                            ?>
                            </select>
                            <label>Segurança</label>
                        </div>
                        <div class="file-field input-field col l6" id="formPed">
                            <div class="btn small">
                                <span>Procurar<i class="material-icons right">computer</i></span>
                                <input type="file" name='formulario_pedido' id='formulario_pedido'>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder='Anexar formulário'>
                            </div>
                        </div>
                        <div class="col l6" id="formPedText">

                        </div>
                    </div>
                    <div class="row">
                        <button class="btn" id="enviar" type="submit" name="action">Atualizar
                            <i class="material-icons right">check</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EXCLUI -->
        <div id="exclui" class="modal">
            <div class="modal-content">
                <i class='material-icons right modal-close' id='fechar_modal'>close</i>
                <h5>Confirma que deseja excluir o pedido </h5>
                <p class="red-text">ATENÇÃO: Esta ação não poderá ser revertida posteriormente!</p>
                <div class="row left-align">
                    <div class="col l6">
                        <p>Cliente: <span id="nome_cliente_exclui"></span></p>
                        <p>Produto: <span id="nome_produto_exclui"></span></p>
                        <p>Quantidade: <span id="qtd_produto_exclui"></span></p>
                        <p>Dimensao: <span id="dimensao_exclui"></span></p>
                    </div>
                    <div class="col l6">
                        <p>Atividade: <span id="atividade_exclui"></span></p>
                        <p>Seguranca: <span id="seguranca_exclui"></span></p>
                        <p>Formulário: <span id="form_exclui"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat green-text"
                    id="confirma_exclui_button" data-id="">Confirma</a>
                <a href="" class="modal-close waves-effect waves-red btn-flat red-text">Cancela</a>
            </div>
        </div>
        <script src="../../js/listas/listaPedidos.js"></script>
        <?php
    }else{
        ?>
        <tr>
            <td colspan="7">Nenhum pedido encontrado...</td>
        </tr>
        <?php
    }

?>