<?php
include_once("cabecalho.php");
session_start();
if(isset($_SESSION['user_ID']) && !empty($_SESSION['user_ID'])){
    //$direciona = $_GET['pagina']."php";
    //echo $direciona;
    //include_once($_direciona);
    Header("Location: view.php");

}else{
    Header("Location: login.php");
    //include_once("login.php");
}
include_once("rodape.php");
?>      