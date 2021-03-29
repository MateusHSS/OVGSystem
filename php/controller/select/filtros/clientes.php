<?php
    include_once "../../../config/conexao.php";

    $filter = '%'.$_POST['filter'].'%';

    $sqlSelecionaClientes = $connect->prepare("SELECT tabcliente.corredorcliente, tabcliente.idsetorcliente, tabcliente.ativo, tabcliente.idcliente, tabcliente.nomecliente, tabcliente.telefonecliente, tabsetor.nomesetor, tabcorredor.nomecorredor
                                                FROM tabcliente
                                            INNER JOIN tabsetor ON tabcliente.idsetorcliente = tabsetor.idsetor
                                            INNER JOIN tabcorredor ON tabcorredor.idcorredor = tabcliente.corredorcliente
                                            WHERE tabcliente.nomecliente LIKE ? OR tabcliente.idcliente LIKE ?
                                            ORDER BY tabcliente.datacadastrocliente DESC");
    $sqlSelecionaClientes->bind_param("ss", $filter, $filter);
    $sqlSelecionaClientes->execute();

    $resultClientes = $sqlSelecionaClientes->get_result();

    if ($resultClientes->num_rows == 0) {
    ?>
        <tr>
            <td colspan='7'>Nenhum registro encontrado...</td>
        </tr>
        <?php
    } else {
        while ($resClientes = $resultClientes->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $resClientes['idcliente'] ?></td>
                <td><?= $resClientes['nomecliente'] ?></td>
                <td><?= $resClientes['telefonecliente'] ?></td>
                <td><?= $resClientes['nomesetor'] ?></td>
                <td><?= $resClientes['nomecorredor'] ?></td>
                <td>
                    <button data-target="edita" data-id="<?= $resClientes['idcliente'] ?>" class="btn-small white orange-text text-darken-3 modal-trigger edita">
                        <i class="material-icons">create</i>
                    </button>
                    <button data-target="exclui" data-id="<?= $resClientes['idcliente'] ?>" class="btn-small white red-text text-darken-3 modal-trigger exclui">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
            </tr>
        <?php
        }
    }
    ?>
    <!-- MODAL EDITA -->
    <div class='modal fade' id='edita'>
        <div class='modal-content'>
            <div class='row right'><i class='material-icons modal-close'>close</i></div>
            <h4>Editar informações</h4>
            <div class='divider'></div>
            <form method='post' action='#' id='form_edita'>
                <div class="row">
                    <div class="input-field col l6">
                        <input id="nome_cliente" type="text" class="validate" name='nome_cliente' onkeyup="this.value = this.value.toUpperCase();">
                        <label for="nome_cliente">Nome completo</label>
                    </div>
                    <div class="input-field col l6">
                        <input id="telefone_cliente" type="text" class="validate" name='telefone_cliente'>
                        <label for="telefone_cliente">Telefone</label>
                    </div>
                    <div class="input-field col l3">
                        <select name='setor_cliente' id='setor_cliente'>
                            <?php
                            $sqlSetor = $connect->prepare('SELECT * FROM tabsetor');
                            $sqlSetor->execute();

                            $resultSetor = $sqlSetor->get_result();

                            while ($resSetor = $resultSetor->fetch_assoc()) {
                            ?>
                                <option value="<?= $resSetor['idsetor'] ?>"><?= $resSetor['nomesetor'] ?></option>
                            <?php
                            }


                            ?>
                        </select>
                        <label>Setor</label>
                    </div>
                    <div class="input-field col l3">
                        <select name='corredor_cliente' id='corredor_cliente'>
                            <?php
                            $sqlUnid = $connect->prepare('SELECT * FROM tabcorredor');
                            $sqlUnid->execute();

                            $resultUnid = $sqlUnid->get_result();

                            while ($resUnid = $resultUnid->fetch_assoc()) {
                            ?>
                                <option value="<?= $resUnid['idcorredor'] ?>"><?= $resUnid['nomecorredor'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <label>Corredor</label>
                    </div>
                    <div class='col l3'>
                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" name='ativo' id="ativo" />
                                <span>Ativo</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row center">
                    <button class='btn light-blue darken-3 botao' type='submit' name='action' data-id="" id="enviar">
                        Atualizar
                        <i class='material-icons right'>check</i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EXCLUI -->
    <div id="exclui" class="modal">
        <div class="modal-content">
            <i class='material-icons right modal-close' id='fechar_modal'>close</i>
            <h5>Confirma que deseja excluir <span id="nome_exclui"></span></h5>
            <p class="red-text">ATENÇÃO: Esta ação não poderá ser revertida posteriormente!</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat green-text" id="confirma_exclui_button" data-id="">Confirma</a>
            <a href="" class="modal-close waves-effect waves-red btn-flat red-text">Cancela</a>
        </div>
    </div>
    <div class="fixed-action-btn" id='top'>
        <a class="btn-floating btn-large orange darken-3">
            <i class="large material-icons">keyboard_arrow_up</i>
        </a>
    </div>
    <script src="../../js/listas/listaClientes.js"></script>
<?
?>