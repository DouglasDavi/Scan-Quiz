<?php
    include_once("cabecalho.php");
    include_once("conexao.php");
?>
<div class=" text-center p-2">
    <img src="assets/android-icon-96x96.png" alt="" title="icone app">
    <p class="text-dark p-3">ESQUECEU SUA SENHA</p>
</div>
<br>
<?php 
if(isset($_SESSION['msg'])){?>
    <div class="container col-xs-12 col-md-6 text-center">
        <div class="alert <?=$_SESSION['alertNivel']?> alert-dismissible fade show" role="alert">
            <strong><?=$_SESSION['msg']?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
<?php } 
    unset($_SESSION['msg']);
    unset($_SESSION['alertNivel']);
?>
<div id="alert"></div>
<div class="card bg-light">
    <div class="card-body">
        <form action="data.php" method="POST">
            <div class="form-group">
                <label> E-mail</label>
                <input type="text"  autocomplete="username" name="email" class="form-control" onfocusout="verifica_email(this.value)" value="" placeholder="Digite seu e-mail" required>
                <label> Nova senha</label>
                <input type="password" name="senha_nova"  autocomplete="new-password" class="form-control" placeholder="Digite uma senha" required>
                <label> Confirmar senha</label>
                <input type="password" name="confirmar_senha" autocomplete="new-password" class="form-control" placeholder="Confirme sua senha" required>
            </div>
            <button type="submit" class="logar" value="trocarSenha" name="trocarSenha" >Solicitar</button>
            <div class="text-center">
                <a href="login.php"> Voltar para tela de login </a>
            </div> 
        </form>
    </div>
</div>
<script>
    var j = jQuery.noConflict();
</script>
<?php
  include_once("rodape.php");
?>