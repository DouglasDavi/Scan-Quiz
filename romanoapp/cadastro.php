<?php
    include_once("cabecalho.php");
    include_once("conexao.php");
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
    <div class="card mb10">    
        <div id="cadastro">
            <h1 class="h1">Cadastro</h1>
            <div class="card-body">            
                <form action="data.php" method="POST">
                    <div class="form-group">
                        <label for="nome">Seu Nome</label>
                        <input type="text" name="nome_cadastro" class="form-control" autocomplete="off" id="nome">
                    </div>
                    <div class="form-group">
                        <label for="email">Seu e-mail</label>
                        <input type="email" name="email_cadastro" class="form-control" autocomplete="off" id="email" value="">
                    </div>
                
                    <div class="form-group">
                        <label for="senha">Sua senha</label>
                        <input type="password" autocomplete="new-password" name="senha_cadastro" class="form-control" autocomplete="off" id="senha_cadastro">
                    </div>
                    
                    <button type="submit" class="logar" value="Cadastrar" name="cadastrar" >Cadastrar</button>

                    <div class="text-center">
                        <a href="mudarSenha.php"> Esqueci minha senha </a>
                    </div>    
                </form>
            </div>
            <div class="card-footer">
                <p class="link">
                Já tem conta?
                <a href="login.php"> Ir para Login </a>
                </p>
            </div>
        </div>
    </div>
</div>    
<?php
  include_once("rodape.php");
?>