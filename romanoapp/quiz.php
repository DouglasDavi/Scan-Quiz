<?php 
include_once("topo.php");
require_once("funcoes.php");
if(isset($_GET['id']) && !empty($_GET['id'])){
    $quizPergunta = quizPergunta($_GET['id']);
}    
if(isset($quizPergunta) && !empty($quizPergunta)){
    $respondido = selecionausuarioResposta($_GET['id'] , $_SESSION['user_ID']);
?>
<input type="hidden" id="respondido" value="<?=$respondido?>">
<div id="camera"></div>
<div id="quiz" class="container mb71 ">
    <div class="text-center pergunta">
        <?=$quizPergunta['pergunta_titulo']?> 
    </div>
    <div id="div"></div>   
    <form id="form_quiz" action="date.php" method="POST"><input type="hidden" id="minha_resposta" name="minha_resposta"></form>
    <div class="grid">
        <?php
            foreach (seleciona_questao($_GET['id']) as $key => $value) {?>
                <div class="btn btn-outline-primary textoCentral" id="btn_<?=$value['id_opc']?>" onclick="liberaEnvio(<?=$value['id_opc']?>)">
                    <?=$value['respostas_opc']?>                    
                </div>
                <?php
                    if(!empty($value['id_resposta'])){?>
                        <input type="hidden" id="id_resposta" value="<?=$value['id_resposta']?>">
                <?php    

                    }
                ?>
        <?php
            }
        ?>
    </div>
    <div name="Enviar" id="enviar" value="enviar" class="btn btn-success btn-lg btn-block mt10 dnone" onclick="formulario_resposta(<?=$_GET['id']?>, <?=$quizPergunta['user_ID']?>)">Enviar</div>
    <button id="cam" type="button" class="btn btn-outline-danger btn-lg btn-block mt10 dnone" onclick="abrirCam()">Scanear Outra Pergunta <i class="fas fa-video"></i></button>
</div>
<script>
    var j = jQuery.noConflict();
</script>
<?php
}else{?>
<script>
    alert("Essa pergunta foi desativada, volte para tela principal")
	window.location="view.php";	
</script>
<?php
}
include_once("rodape.php");
?>