<?php
require_once("funcoes.php");
session_start();
$page = "";
if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar'])){
    if(strlen($_POST['senha_cadastro']) <= 3){
        $_SESSION['msg'] = "A senha deve ter no mínimo 4 dígitos";
        $_SESSION['alertNivel'] = "alert-warning";
    }else if(empty($_POST['nome_cadastro'])){
        $_SESSION['msg'] = "Campo nome está vazio";
        $_SESSION['alertNivel'] = "alert-info";
    }else if(empty($_POST['email_cadastro'])){
        $_SESSION['msg'] = "Campo de email está vazio";
        $_SESSION['alertNivel'] = "alert-info";
    }else{
        $_POST['senha_cadastro'] = password_hash($_POST['senha_cadastro'], PASSWORD_DEFAULT);
        $verificaUsuario = verificaUsuario($_POST);
        
        if($verificaUsuario == false){        
            cadastrarUserApp($_POST);
            $_SESSION['msg'] = "Usuário Cadastrado Com Sucesso!";
            $_SESSION['alertNivel'] = "alert-success";
        }else{    
            $_SESSION['msg'] = "Este email já está cadastrado!";
            $_SESSION['alertNivel'] = "alert-danger";
        }
    }     
    $page = "cadastro.php";   
}
else if(isset($_POST['logar']) && !empty($_POST['logar'])){
    if(!empty($_POST['email_login']) && !empty($_POST['senha_login'])){        
        $efetuarLogin = efetuarLogin($_POST);        
        if(!empty($efetuarLogin)){
            foreach ($efetuarLogin as $key => $value) {                
                $_SESSION['email'] = $value['email'];
                $_SESSION['nome'] =$value['nome'];
                $_SESSION['user_ID'] = $value['id'];
            }
            Header("Location: view.php"); 
            exit();
        }else{            
            $_SESSION['msg'] = "Email ou Senha Incorreta!";
            $_SESSION['alertNivel'] = "alert-danger";
        }       
    }else{        
        $_SESSION['msg'] = "Email ou Senha Não Informado!";
        $_SESSION['alertNivel'] = "alert-warning";
    }
    $page = "login.php";    
}
else if(isset($_POST['deslogar']) && !empty($_POST['deslogar'])){    
    session_destroy();
    $page = "login.php";
}
else if(isset($_POST['salvar']) && !empty($_POST['salvar'])){  
    if(empty($_POST['id'])){
        $id_pergunta = insert_pergunta_respostas($_POST, $_SESSION['user_ID']);
        $_SESSION['msg'] = "Pergunta Cadastrada!<br><a href='perguntas.php?&id=$id_pergunta' class='alert-link'>Ver QR Code.</a>";
        $_SESSION['alertNivel'] = "alert-success";
        $page = "view.php?admin=admin&id_pergunta=".$id_pergunta;
    }else{
        $id_pergunta = update_pergunta_respostas($_POST, $_SESSION['user_ID']);
        $_SESSION['msg'] = "Pergunta Alterada!<br><a href='perguntas.php?&id=$id_pergunta' class='alert-link'>Ver QR Code.</a>";
        $_SESSION['alertNivel'] = "alert-success";
        $page = "view.php?admin=admin"; 
    } 
}
else if(isset($_POST['excluir']) && !empty($_POST['excluir'])){
    excluirPerguntas($_POST['id']);
    $page = "view.php?admin=admin";
}
else if($_POST['tornar_admin']){
    atualizarPermissao($_SESSION['user_ID']);
    $page = "view.php";
}else if(isset($_POST['trocarSenha']) && !empty($_POST['trocarSenha'])){
    $page="mudarSenha.php";
    if($_POST['senha_nova'] == $_POST['confirmar_senha']){
        if(strlen($_POST['senha_nova']) <= 3){
            $_SESSION['msg'] = "A senha deve ter no mínimo 4 dígitos";
            $_SESSION['alertNivel'] = "alert-warning";
        }else if(empty($_POST['email'])){
            $_SESSION['msg'] = "Campo email está vazio";
            $_SESSION['alertNivel'] = "alert-info";
        }else if(empty($_POST['senha_nova']) || empty($_POST['confirmar_senha'])){
            $_SESSION['msg'] = "Campo senha está vazio";
            $_SESSION['alertNivel'] = "alert-info";
        }else{
            $_POST['senha_nova'] = password_hash($_POST['senha_nova'], PASSWORD_DEFAULT);
            $ID = verifica_email($_POST['email']);
            if(!empty($ID)){
                atualizar_senha($ID, $_POST['senha_nova']);
                $_SESSION['msg'] = "Senha Alterada Com Sucesso!";
                $_SESSION['alertNivel'] = "alert-success";
                $page="login.php";
            }
        }    
    }
    else{        
        $_SESSION['msg'] = "Email ou Senha incompativeís";
        $_SESSION['alertNivel'] = "alert-warning";
    }
}
?>
<script>window.location.href="<?=$page?>"</script>