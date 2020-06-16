<?php
include_once("topo.php");
require_once("funcoes.php");
$minhaClassificacao = minhaClassificacao($_SESSION['user_ID']);
if(!empty($minhaClassificacao)){?>
    <div class="colunas mt-3">
        <?php
            foreach ($minhaClassificacao as $key => $value) {?>    
                <div class="col-xs-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?=$value['nome']?></h5>
                            <p class="card-text">Ver minha posição de todas as perguntas criada por <b class="text-warning"><?= $value['nome']; ?></b></p>
                            <a href="tabelaClassificacao.php?evento=<?=$value['id']?>" class="btn btn-primary" >Ver Esta Classificação</a>
                        </div>
                    </div>
                </div>    
                    
        <?php
            }?>
    </div> 
    <script>
        var j = jQuery.noConflict();    
    </script>
<?php   
}else{?>
    <div class="contCenter">        
        <h4 class="text-center">Você ainda não participou de um quiz <i class="far fa-frown" style="background-color: yellow; border-radius: 50%;"></i></h4>
    </div>
<?php        
}
include_once("rodape.php");
?>