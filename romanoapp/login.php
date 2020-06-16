<?php
  include_once("cabecalho.php");
  include_once("conexao.php");
  

  $_SESSION["usuario"];
?>
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
<div class="container">
    <a class="links" id="paracadastro"></a>
    <a class="links" id="paralogin"></a>
    
    <div class="card mt10">
        <div id="login">
            <h1 class="h1">Conecte-se</h1>
            
            <div class="card-body">            
                <form action="data.php" method="POST">
                    
                    <div class="form-group">
                        <label for="email">Seu e-mail</label>
                        <input type="email" name="email_login"class="form-control" id="login">
                    </div>
                
                    <div class="form-group">
                        <label for="senha">Sua senha</label>
                        <input type="password" name="senha_login" class="form-control" id="senha">
                    </div>
                    <input type="submit" name="logar" class="logar" value="Logar" />
                    <div class="text-center">
                        <a href="mudarSenha.php"> Esqueci minha senha </a>
                    </div> 
                </form>
            </div>
            <div class="card-footer">
                <p class="link">
                Ainda não tem conta?
                
                <a href="cadastro.php">Cadastre-se</a>
                </p>
            </div>
        </div>
    </div>            
      
</div>
<?php
  include_once("rodape.php");
?>