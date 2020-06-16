<?php

include_once("cabecalho.php");
if(!isset($_SESSION['user_ID'])){
    Header("Location: login.php");     
}
require_once("funcoes.php");
// $classificacao = classificacao($_SESSION['user_ID'], $_GET['evento']);
$classificacao = classificacaoGeral($_GET['evento']);
$cor_medalha = ["gold", "dimgrey", "brown"];
?>
<div class="containert-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary text-center">
        <ui class="navbar-nav mr-auto">
            <li class="nav-item">
                <div onclick="window.location.href='minhaClassificacao.php'" class="">
                    <i class="fas fa-angle-left callback"></i>                
                    <a class="navbar-brand" href="#">Quiz App</a>
                </div>
            </li>
        </ui>
        
    </nav>
</div>
<div class="table-responsive mt-3 container-fluid">
    <h4 id="pos"><?=$_SESSION['nome']?> <i id="num_colocacao">#</i></h4>
    <hr>
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="bg-warning">
                <th>Classificação</th>
                <th>Nome</th>
                <th>Pontuação</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($classificacao as $key => $value) {?>
                    <tr <?=$_SESSION['user_ID'] == $value['id'] ? "class='text-success'" : ""?> >
                        <td scope="row"><?=$key+1?></td>
                        <td><?php if($key+1 <=3){?><i class="fas fa-medal" style="color:<?=$cor_medalha[$key]?>;"></i><?php }?></i> <?=$value['nome']?></td>
                        <td><?=$value['total']?></td>
                    </tr>
                    <?php
                        if($_SESSION['user_ID'] == $value['id']){?>
                        <input type="hidden" id="colocacao" value="<?=$key+1?>">
                    <?php
                      }
                    ?>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>    
<br> 
<script>
    var j = jQuery.noConflict();
    rank = j("#colocacao").val();
    if(typeof rank !== 'undefined'){
        j("#num_colocacao").append(rank)
    }else{
        j("#pos").html('Não houve acertos '+"<?=$_SESSION['nome']?>"+ ' mas não se desanime '+" <i class='far fa-laugh-wink' style='background-color: yellow; border-radius: 50%;'></i>")
    }
</script>
