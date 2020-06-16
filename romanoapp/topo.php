<?php
include_once("cabecalho.php");
if(!isset($_SESSION['user_ID'])){
    Header("Location: login.php");     
}
?>
<div class="col-xs-12">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary text-center">
        <ui class="navbar-nav mr-auto">
            <li class="nav-item">
                <div onclick="window.location.href='view.php'" class="">
                    <i class="fas fa-angle-left callback"></i>                
                    <a class="navbar-brand" href="#">Quiz App</a>
                </div>
            </li>
        </ui>
        <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSite">
            <ui class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link">Ranking</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Perguntas</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Admin</a>
                </li>
            </ui>
            <form action="data.php" method="POST">
                <button class="btn btn-outline-light my-2 my-sm-0" name="deslogar" value="deslogar">SAIR</button>
            </form>
        </div>   --> 
    </nav>
</div>