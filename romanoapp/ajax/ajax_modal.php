<?php
require_once('../funcoes.php');
$detalhes_resposta = detalhes_resposta($_POST['id'], $_POST['evento']);
?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detalhes Respostas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="accordion">
                    <?php
                        foreach ($detalhes_resposta as $key => $value) {?>
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#coll<?=$key?>">
                                    <?=$value['resposta'] == $value['id_resposta'] ? "<i class='far fa-check-circle green'></i>" : "<i class='far fa-times-circle red'></i>" ?>
                                    <?=strlen($value['pergunta_titulo']) > 30 ? substr($value['pergunta_titulo'],0, 30)."..." : $value['pergunta_titulo'];?> #<?=$value['id_pergunta']?> 
                                </a>
                            </div>
                            <div id="coll<?=$key?>" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <b><?=$value['pergunta_titulo']?></b>
                                    <hr>
                                    <div>
                                        <?=$value['respostas_opc']?>
                                    </div>
                                    <?php
                                        if($value['resposta'] != $value['id_resposta']){                                            
                                            $resposta_falsa = resposta_falsa($value['resposta']);
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?=$resposta_falsa?>
                                        </div>
                                    <?php                                            
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    <?php
                        }   
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>                
            </div>
        </div>
    </div>
</div>