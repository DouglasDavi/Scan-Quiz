<?php
require_once("../funcoes.php");
session_start();
if(isset($_POST['form_quiz']) && !empty($_POST['form_quiz'])){
    verificaResposta($_POST['resp'], $_SESSION['user_ID'], $_POST['id'], $_POST['autor']);
}
