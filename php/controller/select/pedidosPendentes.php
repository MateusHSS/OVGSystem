<div class="col l12">
    <table class="table centered card">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Status</th>
                <th>Incluído há</th>
                <th>Programar</th>
            </tr>
        </thead>
        <tbody>
            <?php

                include_once '../../config/conexao.php';

                $sql = $connect->prepare("SELECT tabpedido.idpedido, tabcliente.nomecliente, tabproduto.nomeproduto, tabpedido.quantidadepedido , tabstatus.nomestatus, DATEDIFF (NOW(), tabpedido.datainclusao) AS quantidade_dias
                FROM tabpedido
                INNER JOIN tabproduto on tabproduto.idproduto = tabpedido.produtopedido
                INNER JOIN tabcliente on tabcliente.idcliente = tabpedido.clientepedido
                INNER  JOIN tabstatus on tabstatus.idtabstatus = tabpedido.statuspedido
                WHERE tabpedido.statuspedido = 1");
                $sql->execute();
                $result = $sql->get_result();
                while($res= $result->fetch_assoc()){
                    ?>
            <tr>
                <td><?php echo $res['idpedido'] ?></td>
                <td><?php echo $res['nomecliente'] ?></td>
                <td><?php echo $res['nomeproduto'] ?></td>
                <td><?php echo $res['quantidadepedido'] ?></td>
                <td><?php echo $res['nomestatus'] ?></td>
                <td><?php echo $res['quantidade_dias'] ?> dias</td>
                <td><a href="#programar<?php echo $res['idpedido'] ?>" class='modal-trigger'><i
                            class="material-icons">build</i></a></td>
            </tr>

            <div class='modal fade' id="programar<?php echo $res['idpedido']?>">
                <div class='modal-content'>
                    <div class='row right'><i class='material-icons modal-close'>close</i></div>
                    <h4>Programar <?php echo $res['nomeproduto'] ?></h4>
                    <div class='divider'></div>
                    <form method='post' action='dale.php' id=''>
                        <div class="row">
                            <div class="col l6">
                                <?php
                                            include_once "../config/conexao.php";

                                            $sqlProc = $connect->prepare("SELECT idtabprocesso, descricao, tempo FROM tabprocesso");
                                            $sqlProc->execute();
                                            
                                            $resultProc = $sqlProc->get_result();

                                            while($resProc = $resultProc->fetch_assoc()){
                                                ?>
                                <div class="row">
                                    <div class="col l6">
                                        <div class="switch">
                                            <?php echo $resProc['descricao'] ?>
                                            <label>
                                                <input type="checkbox" class="processos <?php echo $res['idpedido'] ?>"
                                                    data-id-pedido="<?php echo $res['idpedido'] ?>"
                                                    data-id-processo="<?php echo $resProc['idtabprocesso'] ?>"
                                                    data-time="<?php echo $resProc['tempo'] ?>">
                                                <span class="lever"></span>
                                                (+ <?php echo $resProc['tempo'] ?>)
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col l6">
                                        <div class="input-field">
                                            <input type="text" class="qtd"
                                                id="qtd<?php echo $resProc['idtabprocesso'].''.$res['idpedido'] ?>"
                                                name="quantidade<?php echo $resProc['idtabprocesso'] ?>"
                                                data-id-pedido="<?php echo $res['idpedido'] ?>"
                                                data-id-processo="<?php echo $resProc['idtabprocesso'] ?>" value="1">
                                            <label for="quantidade<?php echo $resProc['idtabprocesso'] ?>">Nº
                                                de
                                                vezes</label>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                            }

                                        ?>
                            </div>
                            <div class="col l6">
                                <h5>Tempo final: <span id="tempo<?php echo $res['idpedido'] ?>"></span>
                                </h5>
                            </div>
                        </div>
                        <div class="row center">
                            <div class='btn light-blue darken-3 botao' type='submit' name='action'
                                id='<?php echo $res['idpedido'] ?>'>Programar
                                <i class='material-icons right'>check</i>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <?php
                }
                ?>
        </tbody>
    </table>
</div>