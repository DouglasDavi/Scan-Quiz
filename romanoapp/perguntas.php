<?php
include_once("topo.php");
require_once("funcoes.php");

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $seleciona_questao = seleciona_questao($_GET['id']);    
    $respostas = array();
    $verdadeira = array();
    foreach ($seleciona_questao as $key => $value) {
        $valor = $key +1;
        $pergunta = $value['pergunta_titulo'];        
        $respostas[$valor] = $value['respostas_opc'];
        $verdadeira[$valor] = $value['id_resposta'];  
        if(!empty($value['id_marcado'])){
            $id_marcado = $value['id_marcado'];
        }       
    }   
}else{
    $id = "";
    $respostas[] = "";
    $verdadeira[] = "";
    $id_marcado = "";
}
?>
<div class="container mt10">
    <div class="card">
        <h5 class="card-header text-center"><b>Pergunta</b></h5>
        <div class="card-body">           
            <div class="form-group col-xs-12">
                <?php
                    if(!empty($id)){?>
                        <div id="qrcode" class="qr-center"></div>
                        <h5 class="text-success text-center">Salve seu QRCode!</h5>
                        <hr><br>
                <?php
                    }
                ?>
                
                <form action="data.php" method="POST">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <label><b>Titulo da pergunta</b></label>
                    <textarea name="pergunta" id="pergunta" class="form-control" id="exampleFormControlTextarea1" rows="4" style="resize: none" placeholder="Qual a sua pergunta?" required><?=$pergunta?></textarea>
                    <?php
                        ?>
                            <div class="card border-primary mt10">
                                <div class="card-header text-white bg-primary"><h4>Minhas Respostas</h4></div>
                                <div class="card-body"> 
                                <?php 
                                    for ($i=1; $i <= 4; $i++) { ?>  
                                        <label for="resposta_<?=$i?>">Resposta <?=$i?></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" name="verdadeira" aria-label="Marcar como verdadeiro" value="<?=$i?>" <?=!empty($verdadeira[$i]) ? "checked" : ""?> required>
                                                    <?php if(!empty($verdadeira[$i])){?>
                                                        <input type="hidden" value="<?=$id_marcado?>" name="id_marcado">
                                                    <?php }?>    
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" id="resposta_<?=$i?>" name="resposta_<?=$i?>" value="<?=$respostas[$i]?>" required>                                
                                        </div>
                                <?php                                
                                    }        
                                ?>   
                                </div>
                            </div>    
                    <?php
                       
                    ?>
                    <button name="salvar" value="salvar" class="btn btn-success btn-lg btn-block mt10">Salvar</button>
                </form>
            </div>           
            
            <button name="voltar" class="btn btn-danger btn-lg btn-block" onclick="window.location.href='view.php?admin=admin'"><i class="fas fa-chevron-left"></i> Voltar</button>
        </div> 
    </div>
</div>
<script src="qrcode.min.js"></script>
<script>
 new QRCode(document.getElementById('qrcode'), "https://romanoapp.herokuapp.com/quiz.php?id=<?=$id?>")
</script>
<?php
include_once("rodape.php");
?>